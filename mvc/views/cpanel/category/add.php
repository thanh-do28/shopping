<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data["title"] ?></h3>
            <a href="<?= $data['template'] . 'index'; ?>" class="btn btn-primary">trở lại</a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="x_content">
        <form class="" action="" method="post" novalidate>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                    <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="ex. John f. Kennedy" required="required" />
                </div>
            </div>
            <div class="ln_solid">
                <div class="form-group">
                    <div class="col-md-6 offset-md-3">
                        <button type='submit' class="btn btn-primary">Submit</button>
                        <button type='reset' class="btn btn-success">Reset</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>