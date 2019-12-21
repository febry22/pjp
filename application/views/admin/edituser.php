<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8 mt-5">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= validation_errors() ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <?php endif ?>

            <?= $this->session->flashdata('message'); ?>

            <form id="editForm" action="<?= base_url() . 'admin/edituser/' . $user['id'] ?>" method="post">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Fullname</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" value="<?= $user['fullname'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role_id" id="role_id" class="custom-select form-control selectpicker" data-live-search="true">
                            <?php foreach ($roles as $r) : ?>
                                <option value="<?= $r['id'] ?>" <?php if ($r['id'] == $user['role_id']) echo "selected"; ?>><?= $r['role'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="company_id" class="col-sm-2 col-form-label">Company</label>
                    <div class="col-sm-10">
                        <select name="company_id" id="company_id" class="custom-select form-control selectpicker" data-live-search="true">
                            <?php foreach ($companies as $c) : ?>
                                <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $user['company_id']) echo "selected"; ?>><?= $c['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="partner_id" class="col-sm-2 col-form-label">Branch</label>
                    <div class="col-sm-10">
                        <select name="partner_id" id="partner_id" class="form-control">
                            <?php foreach ($partners as $p) : ?>
                                <option value="<?= $p['id'] ?>" <?php if ($p['id'] == $user['partner_id']) echo "selected"; ?>><?= $p['partner_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="is_active" class="col-sm-2 col-form-label">Is Active</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if ($user['is_active'] == 1) echo "checked='checked'" ?>>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="button" data-toggle="modal" data-target="#saveModal" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

</div>

<!-- saveModal -->
<div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saveModalLabel">Manage User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Save data?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" form="editForm" class="btn btn-primary" href="">Save</button>
            </div>
        </div>
    </div>
</div>