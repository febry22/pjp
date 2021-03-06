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
            <?= form_open_multipart('document/editstnk/' . $stnk['id'], 'id="editForm"'); ?>
            <div class="card">
                <div class="card-header text-white bg-warning">Document status</div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="doc_id">Document ID</label>
                            <input type="text" class="form-control" id="doc_id" name="doc_id" value="<?= $stnk['doc_id'] ?>" readonly />
                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="date_assign">Date Assign</label>
                            <input type="text" class="form-control" id="date_assign" name="date_assign" value="<?= date("d-m-Y", $stnk['date_assign']) ?>" />
                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="draft" <?php if ($stnk['status'] == 'draft') echo 'selected' ?>>Draft</option>
                                <option value="to_samsat" <?php if ($stnk['status'] == 'to_samsat') echo 'selected' ?>>Process to Samsat</option>
                                <!-- <option value="from_samsat" <?php if ($stnk['status'] == 'from_samsat') echo 'selected' ?>>Checking from Samsat</option>
                                <option value="to_bfi_branch" <?php if ($stnk['status'] == 'to_bfi_branch') echo 'selected' ?>>Process to BFI</option> -->
                                <option value="done" <?php if ($stnk['status'] == 'done') echo 'selected' ?>>Done to BFI</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <fieldset disabled>
                <div class="row mt-3">
                    <div class="form-group col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header text-white bg-primary">Service detail</div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="d-none form-group col-md-4">
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="stnk" selected>STNK</option>
                                            <option value="bpkb">BPKB</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-8">
                                        <label for="service-id">Service name</label>
                                        <select name="service-id" id="service-id" class="form-control">
                                            <?php foreach ($services as $s) :  ?>
                                                <option value="<?= $s['id'] ?>" <?php if ($s['id'] == $stnk['service_id']) echo "selected"; ?>><?= $s['name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="motorcycle" <?php if ($stnk['category'] == 'motorcycle') echo 'selected' ?>>Motorcycle</option>
                                            <option value="car" <?php if ($stnk['category'] == 'car') echo 'selected' ?>>Car</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-8 col-md-8">
                                        <label for="param">Location</label>
                                        <select name="param" id="param" class="form-control">
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
            </fieldset>

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
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['ktp_asli']) echo base_url('/assets/img/stnk/') . $stnk['ktp_asli'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['ktp_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ktp_asli" name="ktp_asli">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="ktp_fc">KTP Fotocopy</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['ktp_fc']) echo base_url('/assets/img/stnk/') . $stnk['ktp_fc'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['ktp_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ktp_fc" name="ktp_fc">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="stnk_asli">STNK Asli</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['stnk_asli']) echo base_url('/assets/img/stnk/') . $stnk['stnk_asli'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['stnk_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="stnk_asli" name="stnk_asli">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="stnk_fc">STNK Fotocopy</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['stnk_fc']) echo base_url('/assets/img/stnk/') . $stnk['stnk_fc'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['stnk_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="stnk_fc" name="stnk_fc">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="bpkb_asli">BPKB Asli</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['bpkb_asli']) echo base_url('/assets/img/stnk/') . $stnk['bpkb_asli'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['bpkb_asli'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="bpkb_asli" name="bpkb_asli">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="bpkb_fc">BPKB Fotocopy</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['bpkb_fc']) echo base_url('/assets/img/stnk/') . $stnk['bpkb_fc'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['bpkb_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="bpkb_fc" name="bpkb_fc">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="sk_kehilangan">SK Kehilangan</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['sk_kehilangan']) echo base_url('/assets/img/stnk/') . $stnk['sk_kehilangan'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['sk_kehilangan'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="sk_kehilangan" name="sk_kehilangan">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="ktp_baru_fc">KTP Baru Fotocopy</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['ktp_baru_fc']) echo base_url('/assets/img/stnk/') . $stnk['ktp_baru_fc'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['ktp_baru_fc'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ktp_baru_fc" name="ktp_baru_fc">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="invoice">Invoice Penjualan</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['invoice']) echo base_url('/assets/img/stnk/') . $stnk['invoice'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['invoice'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="invoice" name="invoice">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="sk_lising">SK Lising</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['sk_lising']) echo base_url('/assets/img/stnk/') . $stnk['sk_lising'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['sk_lising'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="sk_lising" name="sk_lising">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="kertas_gesek">Kertas Gesek</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['kertas_gesek']) echo base_url('/assets/img/stnk/') . $stnk['kertas_gesek'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['kertas_gesek'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="kertas_gesek" name="kertas_gesek">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="new_stnk">STNK Baru</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['new_stnk']) echo base_url('/assets/img/stnk/') . $stnk['new_stnk'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['new_stnk'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="new_stnk" name="new_stnk">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="new_bpkb">BPKB Baru</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="<?php if ($stnk['new_bpkb']) echo base_url('/assets/img/stnk/') . $stnk['new_bpkb'];
                                                        else echo base_url('/assets/img/image_404.png') ?>" target="_blank">
                                                <img src="<?= base_url('/assets/img/stnk/') . $stnk['new_bpkb'] ?>" onerror="this.src='<?= base_url('/assets/img/image_404.png') ?>'" class="img-thumbnail">
                                            </a>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="new_bpkb" name="new_bpkb">
                                                <label class="custom-file-label" for="image">Choose image</label>
                                            </div>
                                            <button style="margin-top: 10px" type="button" class="btn btn-danger btn-sm" id="clear_ktp_asli" onclick="clearImg(this.id)">Clear</button>
                                        </div>
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

            <div class="form-group row mt-2">
                <div class="col-sm-10">
                    <button type="button" data-toggle="modal" data-target="#saveModal" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>

</div>

<!-- saveModal -->
<div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saveModalLabel">Update Document</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Save data?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" form="editForm" class="btn btn-primary" href="">Save</button>
            </div>
        </div>
    </div>
</div>