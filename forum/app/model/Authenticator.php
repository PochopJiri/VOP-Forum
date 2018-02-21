<?php

namespace App\Model;

use Nette\Database\Context;
use Nette\Security as NS;

class Authenticator implements NS\IAuthenticator
{
    public $database;

    function __construct(Context $database) {
        $this->database = $database;
    }

    function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        $row = $this->database->table('users')->where('username', $username)->fetch();
        if (!$row) throw new NS\AuthenticationException('Zadali jste špatné uživatelské jméno.');
        else if (!NS\Passwords::verify($password, $row->password)) throw new NS\AuthenticationException('Zadali jste špatné heslo.');
        else return new NS\Identity($row->id, $row->role, ['username' => $row->username]);
    }
}