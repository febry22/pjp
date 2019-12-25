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
                        <th scope="col">Branch</th>
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
                        $auc = $au['name'];
                        $aub = $au['partner_name'];
                        $austat = $au['is_active'];
                    ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $aufname ?></td>
                            <td><?= $auemail ?></td>
                            <td><?= $aurole ?></td>
                            <td><?= $auc ?></td>
                            <td><?= $aub ?></td>
                            <td>
                                <?php if ($austat == 1) {
                                    echo 'Active';
                                } else {
                                    echo 'Inactive';
                                } ?></td>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/edituser/') . $auid ?>" class="badge badge-primary"> Edit</a>
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