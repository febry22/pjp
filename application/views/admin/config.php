<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <fieldset disabled>
        <div class="card mb-3" style="max-width: 50%;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-body" style="padding:20px">
                        <div class="form-group">
                            <label for="admin_skp">Admin SKP/Tunggakan</label>
                            <input type="text" class="form-control" id="admin_skp" value="<?= $config['admin_skp'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-body" style="padding:20px">
                        <div class="form-group">
                            <label for="acc_bpkb_leasing">ACC BPKB Leasing</label>
                            <input type="text" class="form-control" id="acc_bpkb_leasing" value="<?= $config['acc_bpkb_leasing'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="js_motor">Jasa Raharja (Motor)</label>
                            <input type="text" class="form-control" id="js_motor" value="<?= $config['js_motor'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="js_mobil">Jasa Raharja (Mobil)</label>
                            <input type="text" class="form-control" id="js_mobil" value="<?= $config['js_mobil'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="denda_jr_motor">Denda Jasa Raharja (Motor)</label>
                            <input type="text" class="form-control" id="denda_jr_motor" value="<?= $config['denda_jr_motor'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="denda_jr_mobil">Denda Jasa Raharja (Mobil)</label>
                            <input type="text" class="form-control" id="denda_jr_mobil" value="<?= $config['denda_jr_mobil'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="adm_stnk_motor">Administrasi STNK (Motor)</label>
                            <input type="text" class="form-control" id="adm_stnk_motor" value="<?= $config['adm_stnk_motor'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="adm_stnk_mobil">Administrasi STNK (Mobil)</label>
                            <input type="text" class="form-control" id="adm_stnk_mobil" value="<?= $config['adm_stnk_mobil'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tnkb_motor">Biaya TNKB (Motor)</label>
                            <input type="text" class="form-control" id="tnkb_motor" value="<?= $config['tnkb_motor'] ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tnkb_mobil">Biaya TNKB (Mobil)</label>
                            <input type="text" class="form-control" id="tnkb_mobil" value="<?= $config['tnkb_mobil'] ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <div class="form-group row mt-2">
        <div class="col-sm-10">
            <a href="<?= base_url('admin/editconfig/'.$config['id']) ?>" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->