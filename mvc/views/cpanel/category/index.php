<?php
require_once "./mvc/core/redirect.php";

$redirect = new redirect();
?>


<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data["title"] ?></h3>
            <a href="<?= $data['template'] . 'add'; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="javascript:vol(0)" onclick="delAll(this)" data-control="<?= $data["template"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            <a href="<?= base_url . $data["template"] . 'index' ?>" data-control="<?= $data["template"] ?>" class="btn btn-success"><i class="fa-solid fa-rotate"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12" id="messError">

            <?php if (isset($_SESSION['flash'])) { ?>
                <h3 class="text-success"><?php echo $redirect->setFlash('flash') ?></h3>
            <?php } ?>
            <?php if (isset($_SESSION['error'])) { ?>
                <h3 class="text-danger"><?php echo $redirect->setFlash('error') ?></h3>
            <?php } ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th>
                        <input type="checkbox" onclick="allclick(this)" id="check-all">
                    </th>
                    <th class="column-title">tên danh mục </th>
                    <th class="column-title">hiển thị</th>
                    <th class="column-title">Ngày tạo </th>
                    <th class="column-title no-link last"><span class="nobr">Action</span>
                    </th>
                    <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                </tr>
            </thead>
            <?php if (isset($data['datas']) && $data['datas'] != NULL) { ?>
                <tbody>
                    <?php foreach ($data['datas'] as $key => $val) { ?>
                        <tr class="even<?= $val['id'] ?> pointer">
                            <td class="a-center ">
                                <input type="checkbox" name="foo" value="<?= $val['id'] ?>">
                            </td>
                            <td class=""><?= $val['name'] ?></td>
                            <td class=""><input type="checkbox" onclick="checkPublish(<?= $val['id'] ?>,'publish')" data-control="<?= $data["template"] ?>" id="publish<?= $val['id'] ?>" <?= $val['publish'] ? "checked" : "" ?>></td>
                            <td class=""><?= date('d/m/Y', strtotime($val['created_at']))  ?></td>
                            <td>
                                <a href="javascript:vol(0)" onclick="del(<?= $val['id'] ?> )" data-control="<?= $data["template"] ?>" id="del<?= $val['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <a href="<?= base_url . $data['template'] . 'edit/' . $val['id'] ?>" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        <?php if (isset($val['children']) && $val['children'] != NULL) { ?>
                            <?php foreach ($val['children'] as $key_child => $val_child) { ?>
                                <tr class="even<?= $val_child['id'] ?> pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" name="foo" value="<?= $val_child['id'] ?>">
                                    </td>
                                    <td class="">-----<?= $val_child['name'] ?></td>
                                    <td class=""><input type="checkbox" onclick="checkPublish(<?= $val_child['id'] ?>,'publish')" data-control="<?= $data["template"] ?>" id="publish<?= $val_child['id'] ?>" <?= $val_child['publish'] ? "checked" : "" ?>></td>
                                    <td class=""><?= date('d/m/Y', strtotime($val_child['created_at']))  ?></td>
                                    <td>
                                        <a href="javascript:vol(0)" onclick="del(<?= $val_child['id'] ?> )" data-control="<?= $data["template"] ?>" id="del<?= $val_child['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        <a href="<?= base_url . $data['template'] . 'edit/' . $val_child['id'] ?>" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    <?php } ?>
                </tbody>
            <?php } ?>
        </table>
    </div>
</div>

<script>
    function allclick(__this) {
        let isChecked = __this.checked;
        let checkbox = document.querySelectorAll('input[name="foo"]');

        for (i = 0; i < checkbox.length; i++) {
            checkbox[i].checked = isChecked
        }
    }
</script>