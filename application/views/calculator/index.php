<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6 mt-5">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= validation_errors() ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <?php endif ?>

            <?= $this->session->flashdata('message'); ?>

            <form id="calcForm" action="<?= base_url() . 'calculator/printpdfstnk' ?>" method="post" target="_blank">
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
                                    <option value="">-- Select service --</option>
                                    <?php foreach ($services as $s) :  ?>
                                        <?php if ($s['type'] == 'bpkb') continue; ?>
                                        <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-md-4">
                                <label for="category-stnk">Category</label>
                                <select name="category-stnk" id="category-stnk" class="form-control">
                                    <option value="motorcycle" selected>Motorcycle</option>
                                    <option value="car">Car</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-8 col-md-8">
                                <label for="param-stnk">Location</label>
                                <select name="param-stnk" id="param-stnk" class="form-control"></select>
                            </div>
                            <div class="form-group col-lg-4 col-md-4">
                                <label for="total">Service Fee (Rp)</label>
                                <input type="text" class="form-control" id="total" name="total" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header text-white bg-primary">Other detail</div>
                    <div class="card-body">
                        <div class="form-row" style="padding-left:20px">
                            <div class="form-check col-lg-5 col-md-5">
                                <input type="checkbox" class="form-check-input" id="admin_skp" name="admin_skp">
                                <label class="form-check-label" for="admin_skp">Admin SKP</label>
                            </div>      
                        </div>
                        <div class="form-row mt-2">
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="nopol">Nomor Polisi</label>
                                <input type="text" class="form-control" id="nopol" name="nopol">
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="last_pajak">Pajak Tahun Lalu (Rp)</label>
                                <input type="number" class="form-control" id="last_pajak" name="last_pajak">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="jatuh_tempo">Jatuh Tempo</label>
                                <input type="text" class="form-control" id="jatuh_tempo" name="jatuh_tempo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header text-white bg-primary">Up Fee</div>
                    <div class="card-body">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="up_fee" id="up0" value="0" checked>
                            <label class="form-check-label" for="up0">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="up_fee" id="up10" value="10">
                            <label class="form-check-label" for="up10">10%</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="up_fee" id="up20" value="20">
                            <label class="form-check-label" for="up20">20%</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="up_fee" id="up30" value="30">
                            <label class="form-check-label" for="up30">30%</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-10">
                        <button type="button" data-toggle="modal" data-target="#saveModal" class="btn btn-primary">Compile</button>
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
                <h5 class="modal-title" id="saveModalLabel">Compile Document</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Compile all data?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" form="calcForm" class="btn btn-primary" href="">Yes</button>
            </div>
        </div>
    </div>
</div>