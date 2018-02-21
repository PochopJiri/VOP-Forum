<?php

namespace App\Presenters;

use Nette\Application\UI\Form;
use Nette\Database\Context;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Nette\Security\AuthenticationException;
use Nette\Security\Passwords;


class SignPresenter extends BasePresenter
{
    private $database;
    /** @persistent */
    public $backlink = '';

    public function __construct(Context $database) {
        parent::__construct($database);
        $this->database = $database;
    }

	protected function createComponentSignInForm() {
        $form = new Form;
        $form->addText('username', 'Jméno: ')
            ->setRequired('Zadejte prosím jméno');
        $form->addPassword('password','Heslo:')
            ->setRequired('Zadejte prosím heslo');
        $form->addSubmit('add','Přihlásit se');
        $form->onSuccess[] = [$this, 'SignInFormSuccess'];
        return $form;
	}

    public function SignInFormSuccess($form, $values) {
        try {
            $this->getUser()->login($values->username, $values->password);
            $this->flashMessage('Vítejte ' . $values->username . '!', 'success');
            $this->restoreRequest($this->backlink);
            $this->redirect('Homepage:');
        } catch (AuthenticationException $e) {
            $this->flashMessage($e->getMessage(), 'warning');
            $this->redirect('this');
        }

    }

	protected function createComponentSignUpForm() {
        $form = new Form;
        $form->addText('username', 'Uživatelské jméno: ')
            ->setRequired('Zadejte prosím uživatelské jméno');
        $form->addText('forename', 'Jméno:')
            ->setRequired('Zadejte prosím jméno');
        $form->addText('surname', 'Příjmení:')
            ->setRequired('Zadejte prosím příjmení');
        $form->addEmail('email', 'E-mail:')
            ->setRequired('Zadejte prosím e-mail');
        $form->addPassword('password','Heslo:')
            ->setRequired('Zadejte prosím heslo');
        $form->addUpload('picture', 'Profilový obrázek:');
        $form->addSubmit('add','Registrovat');
        $form->onSuccess[] = [$this, 'SignUpFormSuccess'];
        return $form;
	}

    public function SignUpFormSuccess($form, $values) {
        if (($this->database->table('users')->where("username", $values->username)->count() <= 0)) {
            if ($values->picture->name != null && $values->picture->isImage()) {
                $file = $values->picture;
                $file_ext = strtolower(mb_substr($file->getSanitizedName(), strrpos($file->getSanitizedName(), ".")));
                $filename = $values->username.$file_ext;
                $file->move("pictures/".$filename);
                $this->database->table("users")->insert([
                    'username' => $values->username,
                    'forename' => $values->forename,
                    'surname' => $values->surname,
                    'email' => $values->email,
                    'password' => Passwords::hash($values->password),
                    'picture' => "pictures/".$filename,
                    'role' => "member"
                ]);
                $mail = new Message;
                $mail->setFrom('ForumG6 <forumg6@email.com>')
                    ->addTo($values->email)
                    ->setSubject('Potvrzení registrace')
                    ->setBody("Dobrý den,\nvítejte na Fóru.");
                $mailer = new SendmailMailer;
                $mailer->send($mail);
                $this->getUser()->login($values->username, $values->password);
                $this->flashMessage('Vítejte ' . $values->username . '!', 'success');
                $this->redirect('Homepage:default');
            }
            elseif ($values->picture->name != null) $this->flashMessage('Nepodporovaný formát obrázku!', 'danger');
            else {
                $this->database->table("users")->insert([
                    'username' => $values->username,
                    'forename' => $values->forename,
                    'surname' => $values->surname,
                    'email' => $values->email,
                    'password' => Passwords::hash($values->password),
                    'picture' => "pictures/default.jpg",
                    'role' => "member"
                ]);
                $mail = new Message;
                $mail->setFrom('ForumG6 <forumg6@email.com>')
                    ->addTo($values->email)
                    ->setSubject('Potvrzení registrace')
                    ->setBody("Dobrý den,\nvítejte na Fóru.");
                $mailer = new SendmailMailer;
                $mailer->send($mail);
                $this->getUser()->login($values->username, $values->password);
                $this->flashMessage('Vítejte ' . $values->username . '!', 'success');
                $this->redirect('Homepage:default');
            }
        }
        else $this->flashMessage('Toto uživatelské jméno již někdo používá', 'danger');
    }

	public function actionOut(){
		$this->getUser()->logout();
		$this->redirect('Homepage:');
	}

    public function actionSendEmail () {

    }
}
