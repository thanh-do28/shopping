<?php

class MyController extends controller
{
    public $ModuleModels;

    public function __construct()
    {
        $this->ModuleModels = $this->models('ModuleModels');
    }
    public function getIndexAdmin()
    {
        $data['getModule'] = $this->getModule();
        return $data;
    }

    public function getModule()
    {
        $data = $this->ModuleModels->select_array('*', ['parentID' => 0, 'publish' => 1]);
        foreach ($data as $key => $val) {
            $children = $this->ModuleModels->select_array('*', ['parentID' => $val['id'], 'publish' => 1]);
            $data[$key]['children'] = $children;
        }
        return $data;
    }
}
