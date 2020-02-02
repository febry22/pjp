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

            <form id="addForm" action="<?= base_url() . 'document/addstnk/' ?>" method="post">
                <div class="card">
                    <div class="card-header text-white bg-primary">Service detail</div>
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
                            <div class="form-group col-lg-12 col-md-12">
                                <label for="param-stnk">Location</label>
                                <select name="param-stnk" id="param-stnk" class="form-control"></select>
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
                                        <label for="add-cost">Behalf of</label>
                                        <input type="text" class="form-control" name="behalf_of">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label for="desc-cost">Police Number (current)</label>
                                        <input type="text" class="form-control" name="desc-cost">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
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

                <div class="row mt-3">
                    <div class="form-group col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header text-white bg-primary">Additional costs</div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-lg-4 col-md-4">
                                        <label for="add-cost">Cost (Rp)</label>
                                        <input type="text" class="form-control textfield" value="" id="add-cost" name="add-cost" onkeypress="return isNumber(event)" />
                                    </div>
                                    <div class="form-group col-lg-8 col-md-8">
                                        <label for="desc-cost">Description</label>
                                        <input type="text" class="form-control" name="desc-cost">
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

                <div class="row mt-3">
                    <div class="form-group col-lg-4 col-md-4">
                        <div class="card">
                            <div class="card-header text-white bg-secondary">Service Fee (Rp)</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="total" name="total" value="" readonly>
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