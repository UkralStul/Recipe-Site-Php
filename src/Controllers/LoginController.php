<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login');
    }
    public function login()
    {
        $email = $this->request()->input('email');
        $password = $this->request()->input('password');

        if($this->auth()->attempt($email, $password)){
            $this->redirect('/home');
        }else {
            $this->session()->set('error', 'Неверный email или пароль');
            $this->redirect('/login');
        }
    }

    public function logout()
    {
        $this->auth()->logout();

        $this->redirect('/login');
    }
}