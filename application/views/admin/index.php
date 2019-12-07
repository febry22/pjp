<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <table class="table table-hover" id="table_user">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Company</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($alluser as $au) :
                        $auid = $au['id'];
                        $aufname = $au['fullname'];
                        $auemail = $au['email'];
                        $aurole = $au['role'];
                        $aucid = $au['company_id'];
                        $austat = $au['is_active'];
                        ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $aufname ?></td>
                            <td><?= $auemail ?></td>
                            <td><?= $aurole ?></td>
                            <td><?= $aucid ?></td>
                            <td>
                                <?php if ($austat == 1) {
                                        echo 'Active';
                                    } else {
                                        echo 'Inactive';
                                    } ?></td>
                            </td>
                            <td>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editModal<?php echo $auid; ?>"> Edit</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal Edit -->
<?php foreach ($alluser as $au) :
    $auid = $au['id'];
    $aufname = $au['fullname'];
    $aurole = $au['role'];
    $aurole_id = $au['role_id'];
    $austat = $au['is_active'];
    ?>
    <div class="modal fade" id="editModal<?= $auid; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() . 'admin/edituser' ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" id="id" name="id" value="<?= $auid; ?>">
                            <label for="fullname">Fullname</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="type here..." value="<?php echo $aufname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select name="role_id" id="role_id" class="custom-select form-control selectpicker" data-live-search="true">
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id'] ?>" <?php if ($r['id'] == $aurole_id) echo "selected"; ?>><?= $r['role'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="is_active">User status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if ($austat == 1) echo "checked='checked'" ?>>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>