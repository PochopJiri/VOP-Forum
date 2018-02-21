<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Context;

class ProfilePresenter extends BasePresenter
{
    private $database;
    /** @persistent */
    public $backlink = '';

    public function __construct(Context $database) {
        parent::__construct($database);
        $this->database = $database;
    }

    public function renderShow($id) {
        $shownUser = $this->database->table("users")->get($id);
        if ($shownUser) $this->template->shownUser = $shownUser;
        else {
            $this->flashMessage('Tento uživatel neexistuje.', 'warning');
            $this->redirect('Homepage:error');
        }
    }

    public function renderEdit($id) {
        $currentUser = $this->getUser();
        $shownUser = $this->database->table("users")->get($id);
        if ($shownUser) {
            if ($shownUser->id == $currentUser->getId() || $currentUser->isInRole('admin')) {
                $this->template->shownUser = $shownUser;
            }
            else {
                $this->flashMessage('Na tuto akci nemáte dostatečná oprávnění.', 'warning');
                $this->redirect('Homepage:error');
            }
        }
        else {
            $this->flashMessage('Tento uživatel neexistuje.', 'warning');
            $this->redirect('Homepage:error');
        }
    }

    protected function createComponentEditUserForm() {
        if ($this->database->table('users')->get($this->getParameter('id'))->role == "admin") {
            $roles = [
                'value1' => 'admin',
                'value2' => 'member'
            ];
        }
        else {
            $roles = [
                'value1' => 'member',
                'value2' => 'admin'
            ];
        }
        $form = new Form;
        $form->addText('username', 'Uživatelské jméno: ')
            ->setRequired('Zadejte prosím uživatelské jméno');
        $form->addText('forename', 'Jméno:')
            ->setRequired('Zadejte prosím jméno');
        $form->addText('surname', 'Příjmení:')
            ->setRequired('Zadejte prosím příjmení');
        $form->addEmail('email', 'E-mail:')
            ->setRequired('Zadejte prosím e-mail');
        if ($this->getUser()->isInRole('admin')) {
            $form->addSelect('role', 'Role:')
                ->setItems($roles, false);
        }
        $form->addSubmit('add','Uložit');
        $form->onSuccess[] = [$this, 'EditUserFormSuccess'];
        return $form;
    }

    public function EditUserFormSuccess($form, $values) {
        $shownUser = $this->database->table('users')->get($this->getParameter('id'));
        $activeUser = $this->getUser();
        if ($shownUser->username == $values->username || $this->database->table('users')->where("username", $values->username)->count() == 0) {
            if ($activeUser->isInRole('admin')) {
                $shownUser->update([
                    'username' => $values->username,
                    'forename' => $values->forename,
                    'surname' => $values->surname,
                    'email' => $values->email,
                    'role' => $values->role
                ]);
            }
            else {
                $shownUser->update([
                    'username' => $values->username,
                    'forename' => $values->forename,
                    'surname' => $values->surname,
                    'email' => $values->email,
                    'role' => "member"
                ]);
            }
            if ($shownUser->id == $activeUser->getId()) {

                if ($activeUser->getIdentity()->username == $values->username && $activeUser->isInRole($values->role)) {
                    $form->getPresenter()->flashMessage('Profil byl úspěšně aktualizován.', 'success');
                    $form->getPresenter()->redirect('Profile:show', ['id' => $activeUser->getId()]);
                }
                else {
                    $activeUser->logout();
                    $form->getPresenter()->flashMessage('Profil byl úspěšně aktualizován. Přihlaste se prosím znovu.', 'success');
                    $form->getPresenter()->redirect('Sign:in', ['editProfilebacklink' => $shownUser->id]);
                }
            }
            else {
                $form->getPresenter()->flashMessage('Profil byl úspěšně aktualizován.', 'success');
                $this->restoreRequest($this->backlink);
                $form->getPresenter()->redirect('this');
            }
        }
        else {
            $form->getPresenter()->flashMessage('Toto uživatelské jméno již někdo používá.', 'danger');
        }
    }
}