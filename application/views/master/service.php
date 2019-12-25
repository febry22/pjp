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

            <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Add New Service</a>

            <table id="table_master" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($services as $s) :
                        $sid = $s['id'];
                        $stype = $s['type'];
                        $sname = $s['name'];
                        $sstatus = $s['is_active'];
                    ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td>
                                <?php if ($stype == 'stnk') {
                                    echo 'STNK';
                                } elseif ($stype == 'bpkb') {
                                    echo 'BPKB';
                                } ?></td>
                            </td>
                            <td><?= $sname ?></td>
                            <td>
                                <?php if ($sstatus == 1) {
                                    echo 'Active';
                                } else {
                                    echo 'Inactive';
                                } ?></td>
                            </td>
                            <td>
                                <a href="" class="badge badge-warning" data-toggle="modal" data-target="#detailModal<?php echo $sid; ?>"> Detail</a>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editModal<?php echo $sid; ?>"> Edit</a>
                                <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?php echo $sid; ?>"> Delete</a>
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

<!-- Modal Detail -->
<?php foreach ($services as $s) :
    $sid = $s['id'];
    $stype = $s['type'];
    $sname = $s['name'];
    $sstnk_asli = $s['stnk_asli'];
    $sstnk_fc = $s['stnk_fc'];
    $sktp_asli = $s['ktp_asli'];
    $sktp_fc = $s['ktp_fc'];
    $sbpkb_asli = $s['bpkb_asli'];
    $sbpkb_fc = $s['bpkb_fc'];
    $skertas_gesek = $s['kertas_gesek'];
    $ssk_kehilangan = $s['sk_kehilangan'];
    $sktp_baru_fc = $s['ktp_baru_fc'];
    $sinvoice = $s['invoice'];
    $ssk_lising = $s['sk_lising'];
    $sstatus = $s['is_active'];
?>
    <div class="modal fade" id="detailModal<?= $sid; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail <?php echo ($s['type'] == 'stnk') ? 'STNK' : 'BPKB'; ?> - <?php echo $sname; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <fieldset disabled>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $sid; ?>">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="stnk" <?php if ($s['type'] == 'stnk') echo "selected"; ?>>STNK</option>
                                    <option value="bpkb" <?php if ($s['type'] == 'bpkb') echo "selected"; ?>>BPKB</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Service name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="type here..." value="<?php echo $sname; ?>">
                            </div>
                            <label for="name">Required Documents</label>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="stnk_asli" name="stnk_asli" <?php if ($sstnk_asli == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="stnk_asli">
                                            STNK Asli
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="stnk_fc" name="stnk_fc" <?php if ($sstnk_fc == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="stnk_fc">
                                            STNK Fotocopy
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="ktp_asli" name="ktp_asli" <?php if ($sktp_asli == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="ktp_asli">
                                            KTP Asli
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="ktp_fc" name="ktp_fc" <?php if ($sktp_fc == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="ktp_fc">
                                            KTP Fotocopy
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="bpkb_asli" name="bpkb_asli" <?php if ($sbpkb_asli == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="bpkb_asli">
                                            BPKB Asli
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="bpkb_fc" name="bpkb_fc" <?php if ($sbpkb_fc == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="bpkb_fc">
                                            BPKB Fotocopy
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="sk_kehilangan" name="sk_kehilangan" <?php if ($ssk_kehilangan == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="sk_kehilangan">
                                            SK Kehilangan
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="ktp_baru_fc" name="ktp_baru_fc" <?php if ($sktp_baru_fc == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="ktp_baru_fc">
                                            Fc KTP Orang Baru
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="invoice" name="invoice" <?php if ($sinvoice == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="invoice">
                                            Invoice Penjualan
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="sk_lising" name="sk_lising" <?php if ($ssk_lising == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="sk_lising">
                                            Surat Pengantar Lising
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="kertas_gesek" name="kertas_gesek" <?php if ($skertas_gesek == 1) echo "checked='checked'" ?>>
                                        <label class="form-check-label" for="kertas_gesek">
                                            Kertas Gesek
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_active">Service status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if ($sstatus == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="is_active">
                                        Active?
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/addservice') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="stnk">STNK</option>
                            <option value="bpkb">BPKB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Service name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="type here...">
                    </div>
                    <label for="name">Required Documents</label>
                    <div class="row">
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="stnk_asli" name="stnk_asli">
                                <label class="form-check-label" for="stnk_asli">
                                    STNK Asli
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="stnk_fc" name="stnk_fc">
                                <label class="form-check-label" for="stnk_fc">
                                    STNK Fotocopy
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="ktp_asli" name="ktp_asli">
                                <label class="form-check-label" for="ktp_asli">
                                    KTP Asli
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="ktp_fc" name="ktp_fc">
                                <label class="form-check-label" for="ktp_fc">
                                    KTP Fotocopy
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="bpkb_asli" name="bpkb_asli">
                                <label class="form-check-label" for="bpkb_asli">
                                    BPKB Asli
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="bpkb_fc" name="bpkb_fc">
                                <label class="form-check-label" for="bpkb_fc">
                                    BPKB Fotocopy
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="sk_kehilangan" name="sk_kehilangan">
                                <label class="form-check-label" for="sk_kehilangan">
                                    SK Kehilangan
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="ktp_baru_fc" name="ktp_baru_fc">
                                <label class="form-check-label" for="ktp_baru_fc">
                                    Fc KTP Orang Baru
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="invoice" name="invoice">
                                <label class="form-check-label" for="invoice">
                                    Invoice Penjualan
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="sk_lising" name="sk_lising">
                                <label class="form-check-label" for="sk_lising">
                                    Surat Pengantar Lising
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="kertas_gesek" name="kertas_gesek">
                                <label class="form-check-label" for="kertas_gesek">
                                    Kertas Gesek
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Service status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($services as $s) :
    $sid = $s['id'];
    $stype = $s['type'];
    $sname = $s['name'];
    $sstnk_asli = $s['stnk_asli'];
    $sstnk_fc = $s['stnk_fc'];
    $sktp_asli = $s['ktp_asli'];
    $sktp_fc = $s['ktp_fc'];
    $sbpkb_asli = $s['bpkb_asli'];
    $sbpkb_fc = $s['bpkb_fc'];
    $skertas_gesek = $s['kertas_gesek'];
    $ssk_kehilangan = $s['sk_kehilangan'];
    $sktp_baru_fc = $s['ktp_baru_fc'];
    $sinvoice = $s['invoice'];
    $ssk_lising = $s['sk_lising'];
    $sstatus = $s['is_active'];
?>
    <div class="modal fade" id="editModal<?= $sid; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() . 'master/editservice' ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $sid; ?>">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="stnk" <?php if ($s['type'] == 'stnk') echo "selected"; ?>>STNK</option>
                                <option value="bpkb" <?php if ($s['type'] == 'bpkb') echo "selected"; ?>>BPKB</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Service name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="type here..." value="<?php echo $sname; ?>">
                        </div>
                        <label for="name">Required Documents</label>
                        <div class="row">
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="stnk_asli" name="stnk_asli" <?php if ($sstnk_asli == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="stnk_asli">
                                        STNK Asli
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="stnk_fc" name="stnk_fc" <?php if ($sstnk_fc == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="stnk_fc">
                                        STNK Fotocopy
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="ktp_asli" name="ktp_asli" <?php if ($sktp_asli == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="ktp_asli">
                                        KTP Asli
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="ktp_fc" name="ktp_fc" <?php if ($sktp_fc == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="ktp_fc">
                                        KTP Fotocopy
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="bpkb_asli" name="bpkb_asli" <?php if ($sbpkb_asli == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="bpkb_asli">
                                        BPKB Asli
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="bpkb_fc" name="bpkb_fc" <?php if ($sbpkb_fc == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="bpkb_fc">
                                        BPKB Fotocopy
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="sk_kehilangan" name="sk_kehilangan" <?php if ($ssk_kehilangan == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="sk_kehilangan">
                                        SK Kehilangan
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="ktp_baru_fc" name="ktp_baru_fc" <?php if ($sktp_baru_fc == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="ktp_baru_fc">
                                        Fc KTP Orang Baru
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="invoice" name="invoice" <?php if ($sinvoice == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="invoice">
                                        Invoice Penjualan
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="sk_lising" name="sk_lising" <?php if ($ssk_lising == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="sk_lising">
                                        Surat Pengantar Lising
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="kertas_gesek" name="kertas_gesek" <?php if ($skertas_gesek == 1) echo "checked='checked'" ?>>
                                    <label class="form-check-label" for="kertas_gesek">
                                        Kertas Gesek
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Service status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if ($sstatus == 1) echo "checked='checked'" ?>>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Delete -->
<?php foreach ($services as $s) :
    $sid = $s['id'];
    $stype = $s['type'];
    $sname = $s['name'];
?>
    <div class="modal fade" id="deleteModal<?= $sid; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Delete Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete <strong><?php echo ($s['type'] == 'stnk') ? 'STNK' : 'BPKB'; ?> - <?= $sname ?></strong> ?</p>
                </div>
                <form action="<?= base_url() . 'master/deleteservice' ?>" method="post">
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $sid; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>