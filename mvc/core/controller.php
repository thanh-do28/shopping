<?php

class controller
{

    function view($view, $data = [])
    {
        require_once "./mvc/views/cpanel/" . $view . ".php";
    }

    function models($models)
    {
        require_once "./mvc/models/" . $models . ".php";
        return new $models;
    }
}
