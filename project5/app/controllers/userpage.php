<?php

require_once '../app/core/database.php';

class UserPage extends Controller
{
    private $model;

    function __construct()
    {
        session_start();

        $this->model = $this->loadModel("user");
    }

    public function index()
    {
        $this->loadView('userpage/index');
    }

    public function logout()
    {
        $this->model->logout();
    }

    public function getConnection()
    {
        return $this->model->getDatabase()->getConnection();
    }

    public function getUserInfo($info)
    {
        return $this->model->getUserInfo($info);
    }

    public function isLoggedIn()
    {
        return $this->model->isLoggedIn();
    }
}
