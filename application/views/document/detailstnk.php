<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-10 mt-5">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= validation_errors() ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <?php endif ?>

            <?= $this->session->flashdata('message'); ?>
            <form id="detailForm">
                <fieldset disabled>
                    <div class="card">
                        <div class="card-header text-white bg-warning">Document status</div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-lg-8 col-md-8">
                                    <label for="doc_id">Document ID</label>
                                    <input type="text" class="form-control" id="doc_id" name="doc_id" value="<?= $stnk['doc_id'] ?>" />
                                </div>
                                <div class="form-group col-lg-4 col-md-4">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" value="<?= $stnk['status'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="form-group col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header text-white bg-secondary">Service detail</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="d-none form-group col-md-4">
                                            <label for="type-stnk">Type</label>
                                            <select name="type-stnk" id="type-stnk" class="form-control">
                                                <option value="stnk" selected>STNK</option>
                                                <option value="bpkb">BPKB</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8">
                                            <label for="service-id-stnk">Service name</label>
                                            <select name="service-id-stnk" id="service-id-stnk" class="form-control">
                                                <?php foreach ($services as $s) :  ?>
                                                    <option value="<?= $s['id'] ?>" <?php if ($s['id'] == $stnk['service_id']) echo "selected"; ?>><?= $s['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4">
                                            <label for="category-stnk">Category</label>
                                            <select name="category-stnk" id="category-stnk" class="form-control">
                                                <option value="motorcycle" <?php if ($stnk['category'] == 'motorcycle') echo 'selected' ?>>Motorcycle</option>
                                                <option value="car" <?php if ($stnk['category'] == 'car') echo 'selected' ?>>Car</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-8 col-md-8">
                                            <label for="param-stnk">Location</label>
                                            <select name="param-stnk" id="param-stnk" class="form-control">
                                                <?php foreach ($costs as $c) :  ?>
                                                    <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $stnk['cost_id']) echo "selected"; ?>>
                                                        <?php
                                                        if ($c['param1'] == '-') echo '-';
                                                        elseif ($c['param2'] == '-') echo $c['param1'];
                                                        else echo $c['param1'] . ' - ' . $c['param2'];
                                                        ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4">
                                            <label for="total">Service Fee (Rp)</label>
                                            <input type="text" class="form-control" id="total" name="total" value="<?= $stnk['sub_total'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header text-white bg-primary">User data</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="behalf_of">Behalf of</label>
                                            <input type="text" class="form-control" id="behalf_of" name="behalf_of" value="<?= $stnk['behalf_of'] ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="no_bpkb">No BPKB</label>
                                            <input type="text" class="form-control" id="no_bpkb" name="no_bpkb" value="<?= $stnk['no_bpkb'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="nama_stnk">Nama STNK</label>
                                            <input type="text" class="form-control" id="nama_stnk" name="nama_stnk" value="<?= $stnk['nama_stnk'] ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="nama_bpkb">Nama BPKB</label>
                                            <input type="text" class="form-control" id="nama_bpkb" name="nama_bpkb" value="<?= $stnk['nama_bpkb'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="police_num_old">Nomor Polisi Lama</label>
                                            <input type="text" class="form-control" id="police_num_old" name="police_num_old" value="<?= $stnk['police_num_old'] ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="police_num_new">Nomor Polisi Baru</label>
                                            <input type="text" class="form-control" id="police_num_new" name="police_num_new" value="<?= $stnk['police_num_new'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header text-white bg-primary">User document</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="ktp_asli">KTP Asli</label>
                                            <div>
                                                <a href="<?php if ($stnk['ktp_asli']) echo base_url('/assets/img/stnk/') . $stnk['ktp_asli'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['ktp_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="ktp_fc">KTP Fotocopy</label>
                                            <div>
                                                <a href="<?php if ($stnk['ktp_fc']) echo base_url('/assets/img/stnk/') . $stnk['ktp_fc'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['ktp_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="stnk_asli">STNK Asli</label>
                                            <div>
                                                <a href="<?php if ($stnk['stnk_asli']) echo base_url('/assets/img/stnk/') . $stnk['stnk_asli'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['stnk_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="stnk_fc">STNK Fotocopy</label>
                                            <div>
                                                <a href="<?php if ($stnk['stnk_fc']) echo base_url('/assets/img/stnk/') . $stnk['stnk_fc'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['stnk_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="bpkb_asli">BPKB Asli</label>
                                            <div>
                                                <a href="<?php if ($stnk['bpkb_asli']) echo base_url('/assets/img/stnk/') . $stnk['bpkb_asli'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['bpkb_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="bpkb_fc">BPKB Fotocopy</label>
                                            <div>
                                                <a href="<?php if ($stnk['bpkb_fc']) echo base_url('/assets/img/stnk/') . $stnk['bpkb_fc'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['bpkb_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="sk_kehilangan">SK Kehilangan</label>
                                            <div>
                                                <a href="<?php if ($stnk['sk_kehilangan']) echo base_url('/assets/img/stnk/') . $stnk['sk_kehilangan'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['sk_kehilangan'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="ktp_baru_fc">KTP Baru Fotocopy</label>
                                            <div>
                                                <a href="<?php if ($stnk['ktp_baru_fc']) echo base_url('/assets/img/stnk/') . $stnk['ktp_baru_fc'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['ktp_baru_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="invoice">Invoice Penjualan</label>
                                            <div>
                                                <a href="<?php if ($stnk['invoice']) echo base_url('/assets/img/stnk/') . $stnk['invoice'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['invoice'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="sk_lising">SK Lising</label>
                                            <div>
                                                <a href="<?php if ($stnk['sk_lising']) echo base_url('/assets/img/stnk/') . $stnk['sk_lising'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['sk_lising'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="kertas_gesek">Kertas Gesek</label>
                                            <div>
                                                <a href="<?php if ($stnk['kertas_gesek']) echo base_url('/assets/img/stnk/') . $stnk['kertas_gesek'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/stnk/') . $stnk['kertas_gesek'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header text-white bg-primary">Note</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-lg-12 col-md-12">
                                            <textarea class="form-control" id="note" name="note" rows="3"><?= $stnk['note'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header text-white bg-primary">Additional costs</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-lg-4 col-md-4">
                                            <label for="add_cost">Cost (Rp)</label>
                                            <input type="text" class="form-control" id="add_cost" name="add_cost" value="<?= $stnk['add_cost'] ?>" />
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8">
                                            <label for="desc_cost">Description</label>
                                            <input type="text" class="form-control" id="desc_cost" name="desc_cost" value="<?= $stnk['desc_cost'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div>

</div>