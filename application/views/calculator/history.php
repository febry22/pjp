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

            <table id="table_stnk" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Type</th>
                        <th scope="col">Service</th>
                        <th scope="col">Category</th>
                        <th scope="col">Nomor Polisi</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($logs as $l) :
                        $lid = $l['id'];
                        $ltype = $l['type'];
                        $lservice = $l['name'];
                        $lcat = $l['category'];
                        $lnopol = $l['nopol'];
                        $lcdate = date("d-m-Y", $l['created_at']);
                    ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $ltype ?></td>
                            <td><?= $lservice ?></td>
                            <td><?php if ($lcat == 'car') echo 'Car';
                                else echo 'Motorcylce';
                                ?>
                            </td>
                            <td><?= $lnopol ?></td>
                            <td><?= $lcdate ?></td>
                            <td>
                                <a href="<?= base_url('calculator/detaillog/') . $lid ?>" class="badge badge-warning"> Detail</a>
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