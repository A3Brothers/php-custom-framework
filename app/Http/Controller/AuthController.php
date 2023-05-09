<?php
namespace App\Http\Controller;

use App\Model\User;
use System\View;
use PDO;
use System\App;

class AuthController
{
    private $session;

    public function __construct()
    {
        $this->session = (new App)->session;
    }
    public function index()
    {
        $registerPost = $_SERVER['REQUEST_URI'];
        echo View::send('register', ['registerPost' => $registerPost]);
    }

    public function create()
    {
        $user = new User();

        $result = $user->create($_POST['name'], $_POST['email'], $_POST['password']);
        View::withSuccess('User has been registered successfully!');
        View::redirect('/login');

    }

    public function login()
    {
        $loginPost = $_SERVER['REQUEST_URI'];
        echo View::send('login', ['loginPost' => $loginPost]);
    }

    public function postLogin()
    {
        $user = new User();

        $userFound = $user->find($_POST['email'], $_POST['password']);
        $this->session->set('user_id', $userFound['id']);
        View::withSuccess('Successfully logged in!');
        View::redirect('/dashboard');

    }

    public function logout() {
        $this->session->destroy();
        View::withSuccess('Successfully logged out');
        View::redirect('/');
    }
}