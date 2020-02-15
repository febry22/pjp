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

            <a href="<?= base_url('document/addbpkb') ?>" class="btn btn-success mb-3">Add New Document</a>

            <table id="table_bpkb" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Doc Number</th>
                        <th scope="col">Behalf of</th>
                        <th scope="col">Service</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($bpkbs as $b) :
                        $bid = $b['id'];
                        $bdoc_id = $b['doc_id'];
                        $bbehalf = $b['behalf_of'];
                        $bservice = $b['name'];
                        $bstatus = $b['status'];
                        $bcdate = date("d-m-Y", $b['date_created']);
                    ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $bdoc_id ?></td>
                            <td><?= $bbehalf ?></td>
                            <td><?= $bservice ?></td>
                            <td><?php if ($bstatus == 'draft') echo 'Draft';
                                else if ($bstatus == 'to_samsat') echo 'Process to Samsat';
                                else if ($bstatus == 'from_samsat') echo 'Checking from Samsat';
                                else if ($bstatus == 'to_bfi_branch') echo 'Process to BFI';
                                else echo 'Done';
                                ?>
                            </td>
                            <td><?= $bcdate ?></td>
                            <td>
                                <a href="<?= base_url('document/detailbpkb/') . $bid ?>" class="badge badge-warning"> Detail</a>
                                <a href="<?= base_url('document/editbpkb/') . $bid ?>" class="badge badge-primary"> Edit</a>
                                <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?php echo $bid; ?>"> Delete</a>
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
<?php foreach ($bpkbs as $b) :
    $bid = $b['id'];
?>
    <div class="modal fade" id="deleteModal<?= $bid; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                <form action="<?= base_url() . 'document/deletebpkb' ?>" method="post">
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $bid; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>