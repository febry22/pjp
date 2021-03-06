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
                                <div class="form-group col-lg-4 col-md-4">
                                    <label for="doc_id">Document ID</label>
                                    <input type="text" class="form-control" id="doc_id" name="doc_id" value="<?= $bpkb['doc_id'] ?>" />
                                </div>
                                <div class="form-group col-lg-4 col-md-4">
                                    <label for="date_assign">Date Assign</label>
                                    <input type="text" class="form-control" name="date_assign" value="<?= date("d-m-Y", $bpkb['date_assign']) ?>" />
                                </div>
                                <div class="form-group col-lg-4 col-md-4">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="draft" <?php if ($bpkb['status'] == 'draft') echo 'selected' ?>>Draft</option>
                                        <option value="to_samsat" <?php if ($bpkb['status'] == 'to_samsat') echo 'selected' ?>>Process to Samsat</option>
                                        <option value="from_samsat" <?php if ($bpkb['status'] == 'processing_bpkb') echo 'selected' ?>>Processing BPKB</option>
                                        <option value="to_bfi_branch" <?php if ($bpkb['status'] == 'checking_bpkb') echo 'selected' ?>>Checking BPKB</option>
                                        <option value="done" <?php if ($bpkb['status'] == 'done') echo 'selected' ?>>Done to BFI</option>
                                    </select>
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
                                            <label for="type">Type</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="stnk">STNK</option>
                                                <option value="bpkb" selected>BPKB</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8">
                                            <label for="service-id">Service name</label>
                                            <select name="service-id" id="service-id" class="form-control">
                                                <?php foreach ($services as $s) :  ?>
                                                    <option value="<?= $s['id'] ?>" <?php if ($s['id'] == $bpkb['service_id']) echo "selected"; ?>><?= $s['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4">
                                            <label for="category">Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="motorcycle" <?php if ($bpkb['category'] == 'motorcycle') echo 'selected' ?>>Motorcycle</option>
                                                <option value="car" <?php if ($bpkb['category'] == 'car') echo 'selected' ?>>Car</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-8 col-md-8">
                                            <label for="param">Location</label>
                                            <select name="param" id="param" class="form-control">
                                                <?php foreach ($costs as $c) :  ?>
                                                    <option value="<?= $c['id'] ?>" <?php if ($c['id'] == $bpkb['cost_id']) echo "selected"; ?>>
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
                                            <input type="text" class="form-control" id="total" name="total" value="<?= $bpkb['sub_total'] ?>" readonly>
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
                                            <input type="text" class="form-control" id="behalf_of" name="behalf_of" value="<?= $bpkb['behalf_of'] ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="no_bpkb">No BPKB</label>
                                            <input type="text" class="form-control" id="no_bpkb" name="no_bpkb" value="<?= $bpkb['no_bpkb'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="nama_stnk">Nama STNK</label>
                                            <input type="text" class="form-control" id="nama_stnk" name="nama_stnk" value="<?= $bpkb['nama_stnk'] ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="nama_bpkb">Nama BPKB</label>
                                            <input type="text" class="form-control" id="nama_bpkb" name="nama_bpkb" value="<?= $bpkb['nama_bpkb'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="police_num_old">Nomor Polisi Lama</label>
                                            <input type="text" class="form-control" id="police_num_old" name="police_num_old" value="<?= $bpkb['police_num_old'] ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="police_num_new">Nomor Polisi Baru</label>
                                            <input type="text" class="form-control" id="police_num_new" name="police_num_new" value="<?= $bpkb['police_num_new'] ?>">
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
                                                <a href="<?php if ($bpkb['ktp_asli']) echo base_url('/assets/img/bpkb/') . $bpkb['ktp_asli'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['ktp_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="ktp_fc">KTP Fotocopy</label>
                                            <div>
                                                <a href="<?php if ($bpkb['ktp_fc']) echo base_url('/assets/img/bpkb/') . $bpkb['ktp_fc'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['ktp_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="stnk_asli">STNK Asli</label>
                                            <div>
                                                <a href="<?php if ($bpkb['stnk_asli']) echo base_url('/assets/img/bpkb/') . $bpkb['stnk_asli'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['stnk_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="stnk_fc">STNK Fotocopy</label>
                                            <div>
                                                <a href="<?php if ($bpkb['stnk_fc']) echo base_url('/assets/img/bpkb/') . $bpkb['stnk_fc'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['stnk_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="bpkb_asli">BPKB Asli</label>
                                            <div>
                                                <a href="<?php if ($bpkb['bpkb_asli']) echo base_url('/assets/img/bpkb/') . $bpkb['bpkb_asli'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['bpkb_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="bpkb_fc">BPKB Fotocopy</label>
                                            <div>
                                                <a href="<?php if ($bpkb['bpkb_fc']) echo base_url('/assets/img/bpkb/') . $bpkb['bpkb_fc'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['bpkb_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="sk_kehilangan">SK Kehilangan</label>
                                            <div>
                                                <a href="<?php if ($bpkb['sk_kehilangan']) echo base_url('/assets/img/bpkb/') . $bpkb['sk_kehilangan'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['sk_kehilangan'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="ktp_baru_fc">KTP Baru Fotocopy</label>
                                            <div>
                                                <a href="<?php if ($bpkb['ktp_baru_fc']) echo base_url('/assets/img/bpkb/') . $bpkb['ktp_baru_fc'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['ktp_baru_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="invoice">Invoice Penjualan</label>
                                            <div>
                                                <a href="<?php if ($bpkb['invoice']) echo base_url('/assets/img/bpkb/') . $bpkb['invoice'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['invoice'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="sk_lising">SK Lising</label>
                                            <div>
                                                <a href="<?php if ($bpkb['sk_lising']) echo base_url('/assets/img/bpkb/') . $bpkb['sk_lising'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['sk_lising'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="kertas_gesek">Kertas Gesek</label>
                                            <div>
                                                <a href="<?php if ($bpkb['kertas_gesek']) echo base_url('/assets/img/bpkb/') . $bpkb['kertas_gesek'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['kertas_gesek'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="new_stnk">STNK Baru</label>
                                            <div>
                                                <a href="<?php if ($bpkb['new_stnk']) echo base_url('/assets/img/bpkb/') . $bpkb['new_stnk'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['new_stnk'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6 col-md-6">
                                            <label for="new_bpkb">BPKB Baru</label>
                                            <div>
                                                <a href="<?php if ($bpkb['new_bpkb']) echo base_url('/assets/img/bpkb/') . $bpkb['new_bpkb'];
                                                            else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                    <img src="<?= base_url('/assets/img/bpkb/') . $bpkb['new_bpkb'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" width="90%" class="rounded">
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
                                            <textarea class="form-control" id="note" name="note" rows="3"><?= $bpkb['note'] ?></textarea>
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
                                            <input type="text" class="form-control" id="add_cost" name="add_cost" value="<?= $bpkb['add_cost'] ?>" />
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8">
                                            <label for="desc_cost">Description</label>
                                            <input type="text" class="form-control" id="desc_cost" name="desc_cost" value="<?= $bpkb['desc_cost'] ?>">
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