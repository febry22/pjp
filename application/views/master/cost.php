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

            <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Add New Cost</a>

            <table id="table_cost" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Type</th>
                        <th scope="col">Service</th>
                        <th scope="col">Location 1</th>
                        <th scope="col">Location 2</th>
                        <th scope="col">Motorcycle</th>
                        <th scope="col">Car</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($costs as $c) :
                        $cid = $c['id'];
                        $ctype = $c['type'];
                        $cservice = $c['name'];
                        $cparam1 = $c['param1'];
                        $cparam2 = $c['param2'];
                        $cmotorcycle = $c['motorcycle'];
                        $ccar = $c['car'];
                    ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td>
                                <?php if ($ctype == 'stnk') {
                                    echo 'STNK';
                                } elseif ($ctype == 'bpkb') {
                                    echo 'BPKB';
                                } ?></td>
                            </td>
                            <td><?= $cservice ?></td>
                            <td><?= $cparam1 ?></td>
                            <td><?= $cparam2 ?></td>
                            <td>Rp <?= number_format($cmotorcycle, 2, ',', '.'); ?></td>
                            <td>Rp <?= number_format($ccar, 2, ',', '.'); ?></td>
                            <td>
                                <a href="<?= base_url('master/editcost/') . $cid ?>" class="badge badge-primary"> Edit</a>
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
                <h5 class="modal-title" id="addModalLabel">Add New Cost</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/addcost') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="stnk">STNK</option>
                            <option value="bpkb">BPKB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service_id">Service name</label>
                        <select name="service_id" id="service_id" class="form-control">
                            <?php foreach ($services as $s) :  ?>
                                <?php if ($s['type'] == 'bpkb') continue; ?>
                                <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="param1">Location 1</label>
                        <input type="text" class="form-control" id="param1" name="param1" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="param2">Location 2</label>
                        <input type="text" class="form-control" id="param2" name="param2" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="motorcycle">Motorcycle (IDR)</label>
                        <input type="text" class="form-control" id="motorcycle" name="motorcycle" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="car">Car (IDR)</label>
                        <input type="text" class="form-control" id="car" name="car" placeholder="type here...">
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

<!-- Modal Delete -->
<?php foreach ($costs as $c) :
    $cid = $c['id'];
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
                    <p>Are you sure delete ?</p>
                </div>
                <form action="<?= base_url() . 'master/deletecost' ?>" method="post">
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