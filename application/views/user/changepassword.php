<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8 mt-5">
            <div class="row">
                <div class="col-lg-10">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <form action="<?= base_url('user/changepassword') ?>" method="post">
                <div class="form-group row">
                    <label for="curr_password" class="col-sm-4 col-form-label">Current Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="curr_password" class="form-control" id="curr_password">
                        <?= form_error('curr_password', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_password1" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="new_password1" class="form-control" id="new_password1">
                        <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_password2" class="col-sm-4 col-form-label">Confirm New Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="new_password2" class="form-control" id="new_password2">
                        <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

</div>