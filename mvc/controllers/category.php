<?php

class category extends controller
{

    public $CategoryModels;
    var $template = 'category/';
    var $title = "danh mục sản phẩm";

    function __construct()
    {
        $this->CategoryModels = $this->models('CategoryModels');
    }
    public function index()
    {
        $data = [
            'page' => $this->template . 'index',
            'title' => 'danh sách ' . $this->title,
            'template' => $this->template,
        ];

        $this->view('masterlayout', $data);
    }


    public function add()
    {
        $data = [
            'page' => $this->template . 'add',
            'title' => 'thêm mới ' . $this->title,
            'template' => $this->template,
        ];

        $this->view('masterlayout', $data);
    }
}
