<?php

namespace App\Http\Controller;

use App\Event\RegisterEvent;
use App\Http\Middleware\RedirectMiddleware;
use App\Model\User;
use App\Facade\View;
use App\Facade\Auth;
use App\Listener\RegisterListener;
use System\App;

class AuthController
{
    private $session;

    public function __construct(
        private RedirectMiddleware $guestMid,
        private User $user,
    ) {
        $this->session = (new App)->session;
    }
    public function index()
    {
        $this->guestMid->handle();

        // $listener = new RegisterListener;
        // $event = new RegisterEvent('akash@email.com', 'akash', 'Test');
        // $event->attach($listener);
        // $event->notify();

        $registerPost = $_SERVER['REQUEST_URI'];
        return View::send('register', ['registerPost' => $registerPost]);
    }

    public function create()
    {
        $this->guestMid->handle();
        $hashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user = $this->user->insert(['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $hashed]);

        if ($user) {
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
        return View::send('login', ['loginPost' => $loginPost]);
    }

    public function postLogin()
    {
        $this->guestMid->handle();

        $userFound = Auth::attempt($_POST['email'], $_POST['password']);
        if ($userFound) {
            View::withSuccess('Successfully logged in!');
            View::redirect('/dashboard');
        } else {
            View::withError('User not found!');
            View::redirect('/login');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        View::withSuccess('Successfully logged out');
        View::redirect('/');
    }
}
