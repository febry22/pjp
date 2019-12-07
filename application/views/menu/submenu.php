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
                    <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Add New Sub Menu</a>
                </div>
            </div>

            <table id="table_sub_menu" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sub Menu Name</th>
                        <th scope="col">Parent Menu</th>
                        <th scope="col">URL</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Order</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($submenu)) : ?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-danger" role="alert">
                                    Data not found!
                                </div>
                            </td>
                        </tr>
                    <?php endif ?>
                    <?php $i = 1 ?>
                    <?php foreach ($submenu as $sm) :
                        $smid = $sm['id'];
                        $smname = $sm['title'];
                        $smmenu = $sm['menu'];
                        $smurl = $sm['url'];
                        $smicon = $sm['icon'];
                        $smorder = $sm['_order'];
                        $smstat = $sm['is_active'];
                        ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $smname ?></td>
                            <td><?= $smmenu ?></td>
                            <td><?= $smurl ?></td>
                            <td><?= $smicon ?></td>
                            <td><?= $smorder ?></td>
                            <td><?php if ($smstat == 1) {
                                        echo 'Active';
                                    } else {
                                        echo 'Inactive';
                                    } ?></td>
                            <td>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editModal<?= $smid; ?>"> Edit</a>
                                <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $smid; ?>"> Delete</a>
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
                <h5 class="modal-title" id="addModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/addsubmenu') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Sub menu name</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="menu_id">Parent menu</label>
                        <select name="menu_id" id="menu_id" class="custom-select form-control selectpicker" data-live-search="true">
                            <option value="">-- Select Parent Menu --</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">Sub menu URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="icon">Sub menu icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="_order">Sub menu order</label>
                        <input type="text" class="form-control" id="_order" name="_order" placeholder="type here...">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Sub menu status</label>
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
<?php foreach ($submenu as $sm) :
    $smid = $sm['id'];
    $smname = $sm['title'];
    $smmenu_id = $sm['menu_id'];
    $smmenu = $sm['menu'];
    $smurl = $sm['url'];
    $smicon = $sm['icon'];
    $smorder = $sm['_order'];
    $smstat = $sm['is_active'];
    ?>
    <div class="modal fade" id="editModal<?= $smid; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() . 'menu/editsubmenu' ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $smid; ?>">
                        <div class="form-group">
                            <label for="title">Sub menu name</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="type here..." value="<?php echo $smname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="menu_id">Parent menu</label>
                            <select name="menu_id" id="menu_id" class="custom-select form-control selectpicker" data-live-search="true">
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id'] ?>" <?php if ($m['id'] == $smmenu_id) echo "selected"; ?>><?= $m['menu'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="url">Sub menu url</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="type here..." value="<?php echo $smurl; ?>">
                        </div>
                        <div class="form-group">
                            <label for="icon">Sub menu icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="type here..." value="<?php echo $smicon; ?>">
                        </div>
                        <div class="form-group">
                            <label for="_order">Sub menu order</label>
                            <input type="text" class="form-control" id="_order" name="_order" placeholder="type here..." value="<?php echo $smorder; ?>">
                        </div>
                        <div class="form-group">
                            <label for="is_active">Sub menu status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if ($smstat == 1) echo "checked='checked'" ?>>
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
<?php foreach ($submenu as $sm) :
    $smid = $sm['id'];
    $smname = $sm['title'];
    ?>
    <div class="modal fade" id="deleteModal<?= $smid; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Delete Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete sub menu <strong><?= $smname ?></strong> ?</p>
                </div>
                <form action="<?= base_url() . 'menu/deletesubmenu' ?>" method="post">
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $smid; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>