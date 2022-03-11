<?php

require_once '../app/core/database.php';

class AdminPage extends Controller
{
    private $model;

    function __construct()
    {
        session_start();

        $this->model = $this->loadModel("admin");
    }

    public function index()
    {
        $this->loadView('adminpage/index');
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
