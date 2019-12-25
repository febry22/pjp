<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= validation_errors() ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <?php endif ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Add New Service</a>

            <table id="table_master" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($services as $s) :
                        $sid = $s['id'];
                        $stype = $s['type'];
                        $sname = $s['name'];
                        $sstatus = $s['is_active'];
                    ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td>
                                <?php if ($stype == 'stnk') {
                                    echo 'STNK';
                                } elseif ($stype == 'bpkb') {
                                    echo 'BPKB';
                                } ?></td>
                            </td>
                            <td><?= $sname ?></td>
                            <td>
                                <?php if ($sstatus == 1) {
                                    echo 'Active';
                                } else {
                                    echo 'Inactive';
                                } ?></td>
                            </td>
                            <td>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editModal<?php echo $sid; ?>"> Edit</a>
                                <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?php echo $sid; ?>"> Delete</a>
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

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/addservice') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="stnk">STNK</option>
                            <option value="bpkb">BPKB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Service name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Service status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($services as $s) :
    $sid = $s['id'];
    $stype = $s['type'];
    $sname = $s['name'];
    $sstatus = $s['is_active'];
?>
    <div class="modal fade" id="editModal<?= $sid; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() . 'master/editservice' ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $sid; ?>">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="stnk" <?php if ($s['type'] == 'stnk') echo "selected"; ?>>STNK</option>
                                <option value="bpkb" <?php if ($s['type'] == 'bpkb') echo "selected"; ?>>BPKB</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Service name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="type here..." value="<?php echo $sname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="is_active">Service status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if ($sstatus == 1) echo "checked='checked'" ?>>
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

<!-- Modal Delete -->
<?php foreach ($services as $s) :
    $sid = $s['id'];
    $stype = $s['type'];
    $sname = $s['name'];
?>
    <div class="modal fade" id="deleteModal<?= $sid; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Delete Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete <strong><?= $stype ?> - <?= $sname ?></strong> ?</p>
                </div>
                <form action="<?= base_url() . 'master/deleteservice' ?>" method="post">
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $sid; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>