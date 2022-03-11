<?php

require_once '../app/core/database.php';

class HomePage extends Controller
{
    private $model;

    function __construct()
    {
        session_start();

        $this->model = $this->loadModel("user");
    }

    public function index()
    {
        $this->loadView('homepage/index');
    }

    public function register()
    {
        $data = [
            'email' => trim($_POST['email']),
            'haslo' => trim($_POST['haslo']),
        ];

        if (!$this->model->register($data)) {
            $this->index();
        }
    }

    public function login()
    {
        $data = [
            'email' => trim($_POST['email']),
            'haslo' => trim($_POST['haslo'])
        ];

        if (!$this->model->login($data)) {
            $this->index();
        }
    }

    public function printLoginErrors()
    {
        $this->model->printLoginErrors();
    }

    public function printRegisterErrors()
    {
        $this->model->printRegisterErrors();
    }
}
