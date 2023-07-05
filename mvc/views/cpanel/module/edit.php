<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data["title"] ?></h3>
            <a href="<?= $data['template'] . 'index'; ?>" class="btn btn-primary"><i class="fa fa-backward"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="x_content">
        <form class="" action="" method="post" novalidate>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">danh muc cha</label>
                        <select name="data_post[parentID]" class="form-control" id="">
                            <option value="0">chọn danh mục</option>
                            <?php if (isset($data['parent']) && $data['parent'] != NULL) { ?>
                                <?php foreach ($data['parent'] as $key => $val) { ?>
                                    <option value="<?= $val['id'] ?>" <?= $data['datas'][0]['parentID'] == $val['id'] ? "selected" : "" ?>><?= $val['name'] ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên module</label>
                        <input id="name" type="text" value="<?= $data['datas'][0]['name'] ?>" class="form-control" name="data_post[name]">
                    </div>
                    <div class="form-group">
                        <label for="link">liên kết</label>
                        <input id="link" type="text" value="<?= $data['datas'][0]['link'] ?>" class="form-control" name="data_post[link]">
                    </div>
                    <div class="form-group">
                        <label for="controller">Controller</label>
                        <input id="controller" type="text" value="<?= $data['datas'][0]['controller'] ?>" class="form-control" name="data_post[controller]">
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input id="icon" type="text" value="<?= $data['datas'][0]['icon'] ?>" class="form-control" name="data_post[icon]">
                    </div>
                    <div class="form-group">
                        <label for="publish">hiển thị</label>
                        <input id="publish" type="checkbox" <?= $data['datas'][0]['publish'] == 1 ? "checked" : "" ?> name="data_post[publish]">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" name="submit" type="submit">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>