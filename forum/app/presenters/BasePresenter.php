<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;

abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Context $database) {
        $this->database = $database;
    }

    public function beforeRender() {
        if($this->getUser()->isLoggedIn()) $this->template->User = $this->database->table("users")->get($this->getUser()->getId());
        $this->template->currentURL = $this->getHttpRequest()->getUrl()->path;
    }
}