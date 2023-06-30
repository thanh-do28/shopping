<?php

class home extends controller
{

    public $MyModels;
    public $table = 'todos';
    function __construct()
    {
        $this->MyModels = $this->models('MyModels');
    }
    public function index()
    {

        $kq = $this->MyModels->select_array('*', $this->table);


        $this->view('masterlayout', [
            'page' => 'users/index',
            'array' => $kq,
        ]);
    }


    public function add()
    {
        $array = array(
            "title" => "duc cowp",
            "user_id" => 13,
        );
        $kq = $this->MyModels->add($this->table, $array);
        $result = json_decode($kq, true);
        echo '<pre>';
        print_r($kq);
        echo '</pre>';
    }
}
