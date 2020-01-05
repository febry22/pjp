<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-8 mt-5">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= validation_errors() ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <?php endif ?>

            <?= $this->session->flashdata('message'); ?>

            <form id="editForm" action="<?= base_url() . 'master/editcost/' . $cost['id'] ?>" method="post">
                <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                        <select name="type" id="type" class="form-control">
                            <option value="stnk" <?php if ($cost['type'] == 'stnk') echo "selected"; ?>>STNK</option>
                            <option value="bpkb" <?php if ($cost['type'] == 'bpkb') echo "selected"; ?>>BPKB</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_id" class="col-sm-2 col-form-label">Service name</label>
                    <div class="col-sm-10">
                        <select name="service_id" id="service_id" class="form-control">
                            <?php foreach ($services as $s) :  ?>
                                <?php if ($s['type'] != $cost['type']) continue; ?>
                                <option value="<?= $s['id'] ?>" <?php if ($s['id'] == $cost['service_id']) echo "selected"; ?>><?= $s['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="param1" class="col-sm-2 col-form-label">Param 1</label>
                    <div class="col-sm-10">
                        <input type="text" name="param1" class="form-control" id="param1" value="<?= $cost['param1'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="param2" class="col-sm-2 col-form-label">Param 2</label>
                    <div class="col-sm-10">
                        <input type="text" name="param2" class="form-control" id="param2" value="<?= $cost['param2'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="motorcycle" class="col-sm-2 col-form-label">Motorcycle (IDR)</label>
                    <div class="col-sm-10">
                        <input type="text" name="motorcycle" class="form-control" id="motorcycle" value="<?= $cost['motorcycle'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="car" class="col-sm-2 col-form-label">Car (IDR)</label>
                    <div class="col-sm-10">
                        <input type="text" name="car" class="form-control" id="car" value="<?= $cost['car'] ?>">
                    </div>
                </div>

                <div class="form-group row justify-content-end">
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
                <h5 class="modal-title" id="saveModalLabel">Manage Cost</h5>
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