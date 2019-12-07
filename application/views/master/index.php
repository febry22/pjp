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

            <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Add New Company</a>

            <table id="table_master" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($companies as $c) :
                        $cid = $c['id'];
                        $cname = $c['name'];
                        $cstatus = $c['is_active'];
                        ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $cname ?></td>
                            <td>
                                <?php if ($cstatus == 1) {
                                        echo 'Active';
                                    } else {
                                        echo 'Inactive';
                                    } ?></td>
                            </td>
                            <td>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editModal<?php echo $cid; ?>"> Edit</a>
                                <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?php echo $cid; ?>"> Delete</a>
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
                <h5 class="modal-title" id="addModalLabel">Add New Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Company name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Company status</label>
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
<?php foreach ($companies as $c) :
    $cid = $c['id'];
    $cname = $c['name'];
    $cstatus = $c['is_active'];
    ?>
    <div class="modal fade" id="editModal<?= $cid; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() . 'master/edit' ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $cid; ?>">
                            <label for="name">Company name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="type here..." value="<?php echo $cname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="is_active">Company status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if ($cstatus == 1) echo "checked='checked'" ?>>
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
<?php foreach ($companies as $c) :
    $cid = $c['id'];
    $cname = $c['name'];
    ?>
    <div class="modal fade" id="deleteModal<?= $cid; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Delete Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete <strong><?= $cname ?></strong> ?</p>
                </div>
                <form action="<?= base_url() . 'master/delete' ?>" method="post">
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $cid; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>