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

            <div class="row">
                <div class="col-lg-3">
                    <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Add New Branch</a>
                </div>
            </div>

            <table id="table_partner" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Company</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Code</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($partner)) : ?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-danger" role="alert">
                                    Data not found!
                                </div>
                            </td>
                        </tr>
                    <?php endif ?>
                    <?php $i = 1 ?>
                    <?php foreach ($partner as $p) :
                        $pid = $p['id'];
                        $pname = $p['partner_name'];
                        $pcode = $p['code'];
                        $pcid = $p['name'];
                        ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $pcid ?></td>
                            <td><?= $pname ?></td>
                            <td><?= $pcode ?></td>
                            <td>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editModal<?= $pid; ?>"> Edit</a>
                                <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $pid; ?>"> Delete</a>
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
                <h5 class="modal-title" id="addModalLabel">Add New Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/addpartner') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="company_id">Company</label>
                        <select name="company_id" id="company_id" class="custom-select form-control selectpicker" data-live-search="true">
                            <option value="">-- Select Company --</option>
                            <?php foreach ($companies as $c) : ?>
                                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="partner_name">Branch</label>
                        <input type="text" class="form-control" id="partner_name" name="partner_name" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="code">Partner code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="type here...">
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
<?php foreach ($partner as $p) :
    $pid = $p['id'];
    $pname = $p['partner_name'];
    $pcode = $p['code'];
    $pcid = $p['name'];
    ?>
    <div class="modal fade" id="editModal<?= $pid; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() . 'master/editpartner' ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $pid; ?>">
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" class="custom-select form-control selectpicker" data-live-search="true">
                                <?php foreach ($companies as $c) : ?>
                                    <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $pcid) echo "selected"; ?>><?= $c['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="partner_name">Branch</label>
                            <input type="text" class="form-control" id="partner_name" name="partner_name" placeholder="type here..." value="<?php echo $pname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="code">Partner code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="type here..." value="<?php echo $pcode; ?>">
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
<?php foreach ($partner as $p) :
    $pid = $p['id'];
    $pname = $p['partner_name'];
    $pcid = $p['name'];
    ?>
    <div class="modal fade" id="deleteModal<?= $pid; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Delete branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete <strong><?= $pcid ?> - <?= $pname ?></strong> ?</p>
                </div>
                <form action="<?= base_url() . 'master/deletepartner' ?>" method="post">
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $pid; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>