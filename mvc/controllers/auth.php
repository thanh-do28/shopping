<?php

class auth extends controller
{

    var $template = 'auth/';
    function __construct()
    {
    }

    function index()
    {
        $data = [
            'page' => $this->template . 'login_page',
            'template' => $this->template,
        ];
        $this->view("login", $data);
    }

    public function register_page()
    {
        // echo "aaa";
        // die;
        $data = [
            'page' => $this->template . 'register_page',
            'template' => $this->template,
        ];
        $this->view("login", $data);
    }
}
