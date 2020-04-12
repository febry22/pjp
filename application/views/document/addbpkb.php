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

            <?= form_open_multipart('document/addbpkb/', 'id="addForm"'); ?>
            <div class="card">
                <div class="card-header text-white bg-secondary">Service detail</div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="d-none form-group col-md-4">
                            <label for="type-bpkb">Type</label>
                            <select name="type-bpkb" id="type-bpkb" class="form-control">
                                <option value="stnk">STNK</option>
                                <option value="bpkb" selected>BPKB</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-8 col-md-8">
                            <label for="service-id-bpkb">Service name</label>
                            <select name="service-id-bpkb" id="service-id-bpkb" class="form-control">
                                <option value="">-- Select service --</option>
                                <?php foreach ($services as $s) :  ?>
                                    <?php if ($s['type'] == 'bpkb') continue; ?>
                                    <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="category-bpkb">Category</label>
                            <select name="category-bpkb" id="category-bpkb" class="form-control">
                                <option value="motorcycle" selected>Motorcycle</option>
                                <option value="car">Car</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-8 col-md-8">
                            <label for="param-bpkb">Location</label>
                            <select name="param-bpkb" id="param-bpkb" class="form-control"></select>
                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="total">Service Fee (Rp)</label>
                            <input type="text" class="form-control" id="total" name="total" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="form-group col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header text-white bg-primary">User data</div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="behalf_of">Behalf of</label>
                                    <input type="text" class="form-control" id="behalf_of" name="behalf_of">
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="no_bpkb">No BPKB</label>
                                    <input type="text" class="form-control" id="no_bpkb" name="no_bpkb">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="nama_stnk">Nama STNK</label>
                                    <input type="text" class="form-control" id="nama_stnk" name="nama_stnk">
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="nama_bpkb">Nama BPKB</label>
                                    <input type="text" class="form-control" id="nama_bpkb" name="nama_bpkb">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="police_num_old">Nomor Polisi Lama</label>
                                    <input type="text" class="form-control" id="police_num_old" name="police_num_old">
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="police_num_new">Nomor Polisi Baru</label>
                                    <input type="text" class="form-control" id="police_num_new" name="police_num_new">
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
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ktp_asli" name="ktp_asli">
                                        <label class="custom-file-label" for="ktp_asli">Choose image</label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="ktp_fc">KTP Fotocopy</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ktp_fc" name="ktp_fc">
                                        <label class="custom-file-label" for="ktp_fc">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="stnk_asli">STNK Asli</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="stnk_asli" name="stnk_asli">
                                        <label class="custom-file-label" for="stnk_asli">Choose image</label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="stnk_fc">STNK Fotocopy</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="stnk_fc" name="stnk_fc">
                                        <label class="custom-file-label" for="stnk_fc">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="bpkb_asli">BPKB Asli</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="bpkb_asli" name="bpkb_asli">
                                        <label class="custom-file-label" for="bpkb_asli">Choose image</label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="bpkb_fc">BPKB Fotocopy</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="bpkb_fc" name="bpkb_fc">
                                        <label class="custom-file-label" for="bpkb_fc">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="sk_kehilangan">SK Kehilangan</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="sk_kehilangan" name="sk_kehilangan">
                                        <label class="custom-file-label" for="sk_kehilangan">Choose image</label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="ktp_baru_fc">KTP Baru Fotocopy</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="ktp_baru_fc" name="ktp_baru_fc">
                                        <label class="custom-file-label" for="ktp_baru_fc">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="invoice">Invoice Penjualan</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="invoice" name="invoice">
                                        <label class="custom-file-label" for="invoice">Choose image</label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="sk_lising">SK Lising</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="sk_lising" name="sk_lising">
                                        <label class="custom-file-label" for="sk_lising">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="kertas_gesek">Kertas Gesek</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="kertas_gesek" name="kertas_gesek">
                                        <label class="custom-file-label" for="kertas_gesek">Choose image</label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="new_stnk">STNK Baru</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="new_stnk" name="new_stnk">
                                        <label class="custom-file-label" for="new_stnk">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="new_bpkb">BPKB Baru</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="new_bpkb" name="new_bpkb">
                                        <label class="custom-file-label" for="new_bpkb">Choose image</label>
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
                                    <!-- <label for="note">Behalf of</label> -->
                                    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
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
                                    <input type="text" class="form-control textfield" value="" id="add_cost" name="add_cost" onkeypress="return isNumber(event)" />
                                </div>
                                <div class="form-group col-lg-8 col-md-8">
                                    <label for="desc_cost">Description</label>
                                    <input type="text" class="form-control" id="desc_cost" name="desc_cost">
                                </div>
                                <!-- <div class="form-group col-lg-1 col-md-1">
                                        <label>Action</label>
                                        <a href="javascript:void(0);" class="add_button"><img src="<#?= base_url('assets/'); ?>img/plus.svg" /></a>
                                    </div> -->
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
                <h5 class="modal-title" id="saveModalLabel">Add Document</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Save data?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" form="addForm" class="btn btn-primary" href="">Save</button>
            </div>
        </div>
    </div>
</div>