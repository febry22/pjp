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

            <a href="<?= base_url('document/addstnk') ?>" class="btn btn-success mb-3">Add New Document</a>

            <table id="table_stnk" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Doc Number</th>
                        <th scope="col">Behalf of</th>
                        <th scope="col">Service</th>
                        <th scope="col">Note</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Assign</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($stnks as $s) :
                        $sid = $s['id'];
                        $sdoc_id = $s['doc_id'];
                        $sbehalf = $s['behalf_of'];
                        $sservice = $s['name'];
                        $snote = $s['note'];
                        $sstatus = $s['status'];
                        $sadate = date("d-m-Y", $s['date_assign']);
                    ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $sdoc_id ?></td>
                            <td><?= $sbehalf ?></td>
                            <td><?= $sservice ?></td>
                            <td><a href="" class="badge badge-info" data-toggle="modal" data-target="#noteModal">View</a></td>
                            <td><?php if ($sstatus == 'draft') echo 'Draft';
                                else if ($sstatus == 'to_samsat') echo 'Process to Samsat';
                                // else if ($sstatus == 'from_samsat') echo 'Checking from Samsat';
                                // else if ($sstatus == 'to_bfi_branch') echo 'Process to BFI';
                                else echo 'Done to BFI';
                                ?>
                            </td>
                            <td><?= $sadate ?></td>
                            <td>
                                <a href="<?= base_url('document/detailstnk/') . $sid ?>" class="badge badge-warning"> Detail</a>
                                <a href="<?= base_url('document/editstnk/') . $sid ?>" class="badge badge-primary"> Edit</a>
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

<!-- Modal Delete -->
<?php foreach ($stnks as $s) :
    $sid = $s['id'];
?>
    <div class="modal fade" id="deleteModal<?= $sid; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete?</p>
                </div>
                <form action="<?= base_url() . 'document/delete' ?>" method="post">
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

<!-- Note Modal -->
<?php foreach ($stnks as $s) :
    $snote = $s['note'];
?>
    <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noteModalLabel">Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?= $snote ?></p>
                </div>
                <form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>