<?php
require_once "./mvc/core/redirect.php";

class category extends controller
{

    public $CategoryModels;
    var $template = 'category/';
    var $title = "danh mục sản phẩm";
    const type = 1;

    function __construct()
    {
        $this->CategoryModels = $this->models('CategoryModels');
    }
    public function index()
    {
        $datas = $this->CategoryModels->select_array('*', ['parentID' => 0]);
        foreach ($datas as $key => $val) {
            $children = $this->CategoryModels->select_array('*', ['parentID' => $val['id']]);
            $datas[$key]['children'] = $children;
        }
        $data = [
            'page' => $this->template . 'index',
            'title' => 'danh sách ' . $this->title,
            'template' => $this->template,
            'datas' => $datas,
        ];

        $this->view('masterlayout', $data);
    }


    public function add()
    {
        if (isset($_POST['submit'])) {
            $data_post = $_POST['data_post'];
            $data_post['publish'] ? $publish = 1 : $publish = 0;
            $data_post['publish'] = $publish;
            $data_post['type'] = self::type;
            $result = $this->CategoryModels->add($data_post);
            $return = json_decode($result, true);
            if ($return['type'] == 'sucessFully') {
                $redirect = new redirect($this->template . "index");
                $redirect->setFlash('flash', "Thêm thành công danh mục sản phẩm");
            }
        }


        //parentID
        $parent = $this->CategoryModels->select_array('*', ['parentID' => 0]);
        $data = [
            'page' => $this->template . 'add',
            'title' => 'thêm mới ' . $this->title,
            'template' => $this->template,
            'parent' => $parent,
        ];

        $this->view('masterlayout', $data);
    }

    public function edit($id)
    {
        $datas = $this->CategoryModels->select_array('*', ['id' => $id]);
        $parent = $this->CategoryModels->select_array('*', ['parentID' => 0]);


        if (isset($_POST['submit'])) {
            $data_post = $_POST['data_post'];
            if ($id == $data_post['parentID']) {
                $redirect = new redirect($this->template . "index");
                $redirect->setFlash('error', "id của danah mục này trùng với id hiện tại");
            } else {
                $data_post['publish'] ? $publish = 1 : $publish = 0;
                $data_post['publish'] = $publish;
                $data_post['updated_at'] = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
                $result = $this->CategoryModels->update($data_post, ['id' => $id]);
                $return = json_decode($result, true);
                if ($return['type'] == 'sucessFully') {
                    $redirect = new redirect($this->template . "index");
                    $redirect->setFlash('flash', "Cập nhật thành công");
                }
            }
        }

        $data = [
            'page' => $this->template . 'edit',
            'title' => 'Cập nhật ' . $this->title,
            'template' => $this->template,
            'parent' => $parent,
            'datas' => $datas,
        ];

        $this->view('masterlayout', $data);
    }

    public function checkpublish()
    {
        $id = $_POST['id'];
        $vaule = $_POST['value'];
        $dataUpdate['publish'] = $vaule;
        $result = $this->CategoryModels->update($dataUpdate, ['id' => $id]);
        $return = json_decode($result, true);
        if ($return['type'] == "sucessFully") {
            echo json_encode(
                array(
                    'type'  => 'sucessFully',
                    'Message' => 'Update data success',
                )
            );
        }
    }


    public function delete()
    {
        $id = $_POST['id'];
        $result = $this->CategoryModels->delete(['id' => $id]);

        $return = json_decode($result, true);
        if ($return['type'] == "sucessFully") {
            $this->CategoryModels->update(['parentID' => 0], ['parentID' => $id]);
            echo json_encode(
                [
                    'result' => "true",
                    'message' => $return['Message']
                ]
            );
        }
    }

    public function delAll()
    {
        $listID = $_POST["listID"];
        $arrayID = explode(",", $listID);
        foreach ($arrayID as $key => $val) {
            $this->CategoryModels->delete(['id' => $val]);
        }
        echo json_encode(
            [
                'result' => "success",
                'message' => "Delete Success"
            ]
        );
    }
}
