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

            <a href="#" class="btn btn-success mb-3">Export</a>

            <table id="table_stnk" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
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
                    <?php foreach ($bpkbs as $b) :
                        $bid = $b['id'];
                        $bdoc_id = $b['doc_id'];
                        $bbehalf = $b['behalf_of'];
                        $bservice = $b['name'];
                        $bnote = $b['note'];
                        $bstatus = $b['status'];
                        $badate = date("d-m-Y", $b['date_assign']);
                    ?>
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="<?= 'cb_'.$bid ?>">
                                </div>
                            </td>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $bdoc_id ?></td>
                            <td><?= $bbehalf ?></td>
                            <td><?= $bservice ?></td>
                            <td><a href="" class="badge badge-info" data-toggle="modal" data-target="#noteModal">View</a></td>
                            <td><?php if ($bstatus == 'draft') echo 'Draft';
                                else if ($bstatus == 'to_samsat') echo 'Process to Samsat';
                                // else if ($sstatus == 'from_samsat') echo 'Checking from Samsat';
                                // else if ($sstatus == 'to_bfi_branch') echo 'Process to BFI';
                                else echo 'Done to BFI';
                                ?>
                            </td>
                            <td><?= $badate ?></td>
                            <td>
                                <a href="#" class="badge badge-warning">Detail</a>
                                <a href="#" class="badge badge-primary">Export</a>
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

<!-- Note Modal -->
<?php foreach ($bpkbs as $b) :
    $bnote = $b['note'];
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
                    <p><?= $bnote ?></p>
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