<?php
namespace App\Http\Controller;

use App\Http\Middleware\RedirectMiddleware;
use App\Model\User;
use System\View;
use PDO;
use System\App;
use System\Auth;

class AuthController
{
    private $session;
    private $guestMid;
    private $auth;
    private $user;

    public function __construct()
    {
        $this->session = (new App)->session;
        $this->guestMid = new RedirectMiddleware;
        $this->auth = new Auth();
        $this->user = new User();

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
        $hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user = $this->user->insert(['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $hashed]);

        if($user) {
            View::withSuccess('User has been registered successfully!');
            View::redirect('/login');
        } else {
            View::withError('Something went wrong!');
            View::redirect('/register');
        }
        
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
        
        $userFound = $this->auth->attempt($_POST['email'], $_POST['password']);
        if($userFound) {
            View::withSuccess('Successfully logged in!');
            View::redirect('/dashboard');
        } else {
            View::withError('User not found!');
            View::redirect('/login');
        }
        

    }

    public function logout() {
        $this->session->destroy();
        View::withSuccess('Successfully logged out');
        View::redirect('/');
    }
}