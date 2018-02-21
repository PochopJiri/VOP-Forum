<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Database\Context;
use Nette\Utils\DateTime;

class PostsPresenter extends BasePresenter
{
    private $database;
    /** @persistent */
    public $backlink = '';

    public function __construct(Context $database) {
        parent::__construct($database);
        $this->database = $database;
    }

    public function RenderAdd() {
        if (!$this->getUser()->isLoggedIn()) {
            $this->flashMessage('Pro přidání příspěvku se musíte přihlásit.', 'warning');
            $this->redirect('Sign:in', ['backlink' => $this->storeRequest()]);
        }
    }

    public function renderCategories() {
        $categories = $this->database->table("categories")->order('name ASC');
        $categoriesArray = [];
        foreach ($categories as $category) {
            $categoriesArray[$category->id] = [
                'db' => $category,
                'posts' => [],
                'postsCount' => $this->database->table("posts")->where('category_id', $category->id)->count()
            ];
            $posts = $this->database->table("posts")->where('category_id', $category->id)->order('updated DESC')->limit(5);
            foreach ($posts as $post) {
                $tempArray = ['db' => $post];
                $categoriesArray[$category->id]['posts'][] = $tempArray;
            }
        }
        $this->template->categories = $categoriesArray;
    }

    public function renderCategory($id) {
        $category = $this->database->table("categories")->get($id);
        if($this->getUser()->isInRole('admin'))
            $this->template->editRights = true;
        else $this->template->editRights = false;
        if ($category) {
            $this->template->category = $category;
            $this->template->posts = $this->database->table("posts")->where('category_id', $id)->order('updated DESC');
        }
        else {
            $this->flashMessage('Tato kategorie neexistuje.', 'warning');
            $this->redirect('Homepage:error');
        }
    }

    public function RenderCreateCategory() {
        if (!$this->user->isLoggedIn()) {
            $this->flashMessage('Pro přidání příspěvku se musíte přihlásit.', 'warning');
            $this->redirect('Sign:in', ['backlink' => $this->storeRequest()]);
        }
    }

    public function renderEdit($id) {
        $post = $this->database->table("posts")->get($id);
        if ($post) $this->template->post = $post;
        else {
            $this->flashMessage('Tento příspěvek neexistuje.', 'warning');
            $this->redirect('Homepage:error');
        }
        $author = $this->database->table('users')->get($post->author_id);
        if($author->id != $this->getUser()->getId() || $this->getUser()->isInRole('admin') == false) {
            $this->flashMessage('Na tuto akci nemáte dostatečná oprávnění.', 'warning');
            $this->redirect('Homepage:error');
        }
    }

    public function renderMy($id) {
        $author = $this->database->table("users")->get($id);
        if ($author) {
            $this->template->author = $author;
            $posts = $this->database->table("posts")->where('author_id', $id);
            $postsArray = [];
            foreach ($posts as $post) {
                $postsArray[$post->id] = [
                    'db' => $post,
                    'category' => $this->database->table('categories')->get($post->category_id)
                ];
            }
            $this->template->posts = $postsArray;
        }
        else {
            $this->flashMessage('Tento uživatel neexistuje.', 'warning');
            $this->redirect('Homepage:error');
        }
    }

    public function renderPost($id) {
        $post = $this->database->table("posts")->get($id);
        if ($post) {
            $this->template->post = $post;
            $this->template->category = $this->database->table('categories')->get($post->category_id);
            $comments = $this->database->table("comments")->where("article_id", $id);
            $commentsArray = [];
            $now = new DateTime();
            foreach ($comments as $comment) {
                $created = $now->diff($comment->created);
                if ($created->y > 0) $commentCreated = Datetime::from($comment->created)->format('d. m. Y');
                else if ($created->d > 1 || $created->m > 0) $commentCreated = Datetime::from($comment->created)->format('d. m.');
                else if ($created->d == 1) $commentCreated = "včera, " . Datetime::from($comment->created)->format('H:i');
                else $commentCreated = "dnes, " . Datetime::from($comment->created)->format('H:i');
                if ($comment->created == $comment->updated) $commentEdited = null;
                else {
                    $updated = $now->diff($comment->updated);
                    if ($updated->y > 0) $commentEdited = " (upraveno " . Datetime::from($comment->updated)->format('d. m. Y') . ")";
                    else if ($updated->d > 1 || $updated->m > 0) $commentEdited = " (upraveno " . Datetime::from($comment->updated)->format('d. m.') . ")";
                    else if ($updated->d == 1) $commentEdited = " (upraveno včera, " . Datetime::from($comment->updated)->format('H:i') . ")";
                    else $commentEdited = " (upraveno dnes, " . Datetime::from($comment->updated)->format('H:i') . ")";
                }
                if($comment->author_id == $this->getUser()->getId() || $this->getUser()->isInRole('admin'))
                    $editRights = true;
                else $editRights = false;
                $commentsArray[$comment->id] = [
                    'db' => $comment,
                    'created' => $commentCreated,
                    'updated' => $commentEdited,
                    'author' => $this->database->table('users')->get($comment->author_id),
                    'editRights' => $editRights
                ];
            }
            $this->template->comments = $commentsArray;
        }
        else {
            $this->flashMessage('Tento příspěvek neexistuje.', 'warning');
            $this->redirect('Homepage:error');
        }
        $author = $this->database->table('users')->get($post->author_id);
        $this->template->author = $author;
        if($author->id == $this->getUser()->getId() || $this->getUser()->isInRole('admin'))
            $this->template->editRights = true;
        else $this->template->editRights = false;
    }

    protected function createComponentAddPost() {
        $categoriesArray = [];
        $categories = $this->database->table("categories")->order('name ASC');
        foreach($categories as $category) $categoriesArray += [$category->id => $category->name];
        $form = new Form;
        $form->addSelect('category', 'Kategorie:')
            ->setItems($categoriesArray, true);
        $form->addText('title', 'Titulek: ')
            ->setRequired('Zadejte prosím titulek');
        $form->addTextArea('content', 'Obsah:')
            ->setRequired('Zadejte prosím obsah');
        $form->addSubmit('add','Přidat příspěvek');
        $form->onSuccess[] = [$this, 'AddPostSuccess'];
        return $form;
    }

    public function AddPostSuccess($form, $values) {
        $row = $this->database->table("posts")->insert([
            'category_id' => $values->category,
            'author_id' => $this->getUser()->getId(),
            'author' => $this->getUser()->getIdentity()->username,
            'title' => $values->title,
            'content' => $values->content,
            'created' => new Nette\Utils\DateTime,
            'updated' => new Nette\Utils\DateTime
        ]);
        $form->getPresenter()->flashMessage('Příspěvek byl úspěšně přidán.', 'success');
        $form->getPresenter()->redirect('Posts:post', array('id' => $row->id));
    }

    protected function createComponentEditPost() {
        $form = new Form;
        $form->addText('title', 'Titulek: ')
            ->setRequired('Zadejte prosím titulek');
        $form->addTextArea('content', 'Obsah:')
            ->setRequired('Zadejte prosím obsah');
        $form->addSubmit('add','Uložit');
        $form->setDefaults(['content' => $this->database->table('posts')->get($this->getParameter('id'))->content]);
        $form->onSuccess[] = [$this, 'EditPostSuccess'];
        return $form;
    }

    public function EditPostSuccess($form, $values) {
        $this->database->table("posts")->where('id', $this->getParameter('id'))->update([
            'title' => $values->title,
            'content' => $values->content,
            'updated' => new Nette\Utils\DateTime
        ]);
        $form->getPresenter()->flashMessage('Příspěvek byl úspěšně aktualizován.', 'success');
        $form->getPresenter()->redirect('Posts:post', ['id' => $this->getParameter('id')]);
    }

    protected function createComponentCreateCategory() {
        $form = new Form;
        $form->addText('category', 'Kategorie: ')
            ->setRequired('Zadejte prosím titulek');
        $form->addText('title', 'Titulek: ')
            ->setRequired('Zadejte prosím titulek');
        $form->addTextArea('content', 'Obsah:')
            ->setRequired('Zadejte prosím obsah');
        $form->addSubmit('add','Přidat příspěvek');
        $form->onSuccess[] = [$this, 'CreateCategorySuccess'];
        return $form;
    }

    public function CreateCategorySuccess($form, $values) {
        $categories = $this->database->table("categories");
        if($categories->where('name', $values->category)->fetch()) {
            $category = $categories->where('name', $values->category)->fetch()->id;
            $row = $this->database->table("posts")->insert([
                'category_id' => $category,
                'author_id' => $this->getUser()->getId(),
                'author' => $this->getUser()->getIdentity()->username,
                'title' => $values->title,
                'content' => $values->content,
                'created' => new Nette\Utils\DateTime,
                'updated' => new Nette\Utils\DateTime
            ]);
        }
        else {
            $category = $this->database->table("categories")->insert(['name' => $values->category]);
            $row = $this->database->table("posts")->insert([
                'category_id' => $category->id,
                'author_id' => $this->getUser()->getId(),
                'author' => $this->getUser()->getIdentity()->username,
                'title' => $values->title,
                'content' => $values->content,
                'created' => new Nette\Utils\DateTime,
                'updated' => new Nette\Utils\DateTime
            ]);
        }
        $form->getPresenter()->flashMessage('Příspěvek byl úspěšně přidán.', 'success');
        $form->getPresenter()->redirect('Posts:post', array('id' => $row->id));
    }

    protected function createComponentAddComment() {
        $form = new Form;
        $form->addTextArea('text', 'Komentář:')
            ->setRequired('Zadejte komentář');
        $form->addSubmit('add','Přidat');
        $form->onSuccess[] = [$this, 'AddCommentSuccess'];
        return $form;
    }

    public function AddCommentSuccess($form, $values) {
        $this->database->table("comments")->insert([
            'author'=>$this->getUser()->getIdentity()->username,
            'author_id'=>$this->getUser()->id,
            'article_id'=>$this->getParameter('id'),
            'content'=>$values->text,
            'created' => new Nette\Utils\DateTime,
            'updated' => new Nette\Utils\DateTime
        ]);
        $form->getPresenter()->redirect('this');
    }

    public function actionDeletePost($id) {
        $this->database->table('comments')->where('article_id', $id)->delete();
        $this->database->table('posts')->where('id', $id)->delete();
        $this->flashMessage('Příspěvek byl smazán.', 'success');
        $this->redirect('Homepage:');
    }

    public function actionDeleteComment($id) {
        $this->database->table('comments')->where('id', $id)->delete();
        $this->flashMessage('Komentář byl smazán.', 'success');
        $this->redirect('this');
    }

    public function actionDeleteCategory($id) {
        $posts = $this->database->table('posts')->where('category_id', $id);
        foreach ($posts as $post) $this->database->table('comments')->where('article_id', $post->id)->delete();
        $posts->delete();
        $this->database->table('categories')->where('id', $id)->delete();
        $this->flashMessage('Kategorie byla odstraněna.', 'success');
        $this->redirect('Homepage:');
    }
}