<?php
namespace App\Http\Controller;

use App\Http\Middleware\RedirectMiddleware;
use App\Model\User;
use System\View;
use PDO;
use System\App;

class AuthController
{
    private $session;
    private $guestMid;

    public function __construct()
    {
        $this->session = (new App)->session;
        $this->guestMid = new RedirectMiddleware;

    }
    public function index()
    {
        $this->guestMid->handle();

        $registerPost = $_SERVER['REQUEST_URI'];
        echo View::send('register', ['registerPost' => $registerPost]);
    }

    public function create()
    {
        $this->guestMid->handle();

        $user = new User();

        $result = $user->create($_POST['name'], $_POST['email'], $_POST['password']);
        View::withSuccess('User has been registered successfully!');
        View::redirect('/login');

    }

    public function login()
    {
        $this->guestMid->handle();

        $loginPost = $_SERVER['REQUEST_URI'];
        echo View::send('login', ['loginPost' => $loginPost]);
    }

    public function postLogin()
    {
        $this->guestMid->handle();
        
        $user = new User();

        $userFound = $user->find($_POST['email'], $_POST['password']);
        $this->session->set('user_id', $userFound['id']);
        $this->session->set('user', $userFound);
        View::withSuccess('Successfully logged in!');
        View::redirect('/dashboard');

    }

    public function logout() {
        $this->session->destroy();
        View::withSuccess('Successfully logged out');
        View::redirect('/');
    }
}