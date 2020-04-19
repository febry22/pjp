<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; PJP DocTrackS <?= date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/datatables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap-select-1.13.9/dist/js/i18n/defaults-*.min.js"></script>

<!-- Datepicker -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Get partner by company_id -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#company_id').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('admin/get_partner_by_company/'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].partner_name + '</option>';
                    }
                    $('#partner_id').html(html);
                }
            });

            return false;
        });

    });
</script>

<!-- Get service by type -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#type').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('master/get_service_by_type/'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id + '>' + data[i].name + '</option>';
                    }
                    $('#service_id').html(html);
                }
            });

            return false;
        });
    });
</script>

<!-- Count Fee STNK -->
<script type="text/javascript">
    $(document).ready(function() {
        var id = 'stnk';
        $.ajax({
            url: "<?= base_url('master/get_service_by_type/'); ?>",
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id + '>' + data[i].name + '</option>';
                }
                $('#service-id-stnk').html(html);

                var serv_id = $('#service-id-stnk').val();
                $.ajax({
                    url: "<?= base_url('master/get_param_by_service/'); ?>",
                    method: "POST",
                    data: {
                        id: serv_id
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var html1 = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            if (data[i].param1 == '-') {
                                html1 += '<option value=' + data[i].id + '>' + '-' + '</option>';
                            } else if (data[i].param2 == '-') {
                                html1 += '<option value=' + data[i].id + '>' + data[i].param1 + '</option>';
                            } else {
                                html1 += '<option value=' + data[i].id + '>' + data[i].param1 + ' - ' + data[i].param2 + '</option>';
                            }

                            var _serv_id = serv_id;
                            var _param1 = data[i].param1;
                            var _param2 = data[i].param2;
                        }
                        $('#param-stnk').html(html1);

                        var category = $('#category-stnk').val();
                        $.ajax({
                            url: "<?= base_url('master/get_fee/'); ?>",
                            method: "POST",
                            data: {
                                serv_id: _serv_id,
                                param1: _param1,
                                param2: _param2,
                            },
                            async: true,
                            dataType: 'json',
                            success: function(data) {
                                if (category == 'car') {
                                    $('#total').val(data[0].car);
                                } else {
                                    $('#total').val(data[0].motorcycle);
                                }
                            }
                        });
                    }
                });
            }
        });

        $('#service-id-stnk').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('master/get_param_by_service/'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html1 = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        if (data[i].param1 == '-') {
                            html1 += '<option value=' + data[i].id + '>' + '-' + '</option>';
                        } else if (data[i].param2 == '-') {
                            html1 += '<option value=' + data[i].id + '>' + data[i].param1 + '</option>';
                        } else {
                            html1 += '<option value=' + data[i].id + '>' + data[i].param1 + ' - ' + data[i].param2 + '</option>';
                        }
                    }

                    var _serv_id = id;
                    var _param1 = data[0].param1;
                    var _param2 = data[0].param2;
                    $('#param-stnk').html(html1);

                    var category = $('#category-stnk').val();
                    $.ajax({
                        url: "<?= base_url('master/get_fee/'); ?>",
                        method: "POST",
                        data: {
                            serv_id: _serv_id,
                            param1: _param1,
                            param2: _param2,
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            if (category == 'car') {
                                $('#total').val(data[0].car);
                            } else {
                                $('#total').val(data[0].motorcycle);
                            }
                        }
                    });
                }
            });
        });

        $('#category-stnk').change(function() {
            var category = $(this).val();
            var id = $('#param-stnk').val();

            $.ajax({
                url: "<?= base_url('master/get_fee_by_id/'); ?>",
                method: "POST",
                data: {
                    id: id,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    if (category == 'car') {
                        $('#total').val(data[0].car);
                    } else {
                        $('#total').val(data[0].motorcycle);
                    }
                }
            });
        });

        $('#param-stnk').change(function() {
            var id = $(this).val();
            var category = $('#category-stnk').val();

            $.ajax({
                url: "<?= base_url('master/get_fee_by_id/'); ?>",
                method: "POST",
                data: {
                    id: id,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    if (category == 'car') {
                        $('#total').val(data[0].car);
                    } else {
                        $('#total').val(data[0].motorcycle);
                    }
                }
            });
        });
    });
</script>

<!-- Count Fee BPKB -->
<script type="text/javascript">
    $(document).ready(function() {
        var id = 'bpkb';
        $.ajax({
            url: "<?= base_url('master/get_service_by_type/'); ?>",
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id + '>' + data[i].name + '</option>';
                }
                $('#service-id-bpkb').html(html);

                var serv_id = $('#service-id-bpkb').val();
                $.ajax({
                    url: "<?= base_url('master/get_param_by_service/'); ?>",
                    method: "POST",
                    data: {
                        id: serv_id
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html1 = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            if (data[i].param1 == '-') {
                                html1 += '<option value=' + data[i].id + '>' + '-' + '</option>';
                            } else if (data[i].param2 == '-') {
                                html1 += '<option value=' + data[i].id + '>' + data[i].param1 + '</option>';
                            } else {
                                html1 += '<option value=' + data[i].id + '>' + data[i].param1 + ' - ' + data[i].param2 + '</option>';
                            }

                            var _serv_id = serv_id;
                            var _param1 = data[i].param1;
                            var _param2 = data[i].param2;
                        }
                        $('#param-bpkb').html(html1);

                        var category = $('#category-bpkb').val();
                        $.ajax({
                            url: "<?= base_url('master/get_fee/'); ?>",
                            method: "POST",
                            data: {
                                serv_id: _serv_id,
                                param1: _param1,
                                param2: _param2,
                            },
                            async: true,
                            dataType: 'json',
                            success: function(data) {
                                if (category == 'car') {
                                    $('#total').val(data[0].car);
                                } else {
                                    $('#total').val(data[0].motorcycle);
                                }
                            }
                        });
                    }
                });
            }
        });

        $('#service-id-bpkb').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?= base_url('master/get_param_by_service/'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html1 = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        if (data[i].param1 == '-') {
                            html1 += '<option value=' + data[i].id + '>' + '-' + '</option>';
                        } else if (data[i].param2 == '-') {
                            html1 += '<option value=' + data[i].id + '>' + data[i].param1 + '</option>';
                        } else {
                            html1 += '<option value=' + data[i].id + '>' + data[i].param1 + ' - ' + data[i].param2 + '</option>';
                        }
                    }

                    var _serv_id = id;
                    var _param1 = data[0].param1;
                    var _param2 = data[0].param2;
                    $('#param-bpkb').html(html1);

                    var category = $('#category-bpkb').val();
                    $.ajax({
                        url: "<?= base_url('master/get_fee/'); ?>",
                        method: "POST",
                        data: {
                            serv_id: _serv_id,
                            param1: _param1,
                            param2: _param2,
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            if (category == 'car') {
                                $('#total').val(data[0].car);
                            } else {
                                $('#total').val(data[0].motorcycle);
                            }
                        }
                    });
                }
            });
        });

        $('#category-bpkb').change(function() {
            var category = $(this).val();
            var id = $('#param-bpkb').val();

            $.ajax({
                url: "<?= base_url('master/get_fee_by_id/'); ?>",
                method: "POST",
                data: {
                    id: id,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    if (category == 'car') {
                        $('#total').val(data[0].car);
                    } else {
                        $('#total').val(data[0].motorcycle);
                    }
                }
            });
        });

        $('#param-bpkb').change(function() {
            var id = $(this).val();
            var category = $('#category-bpkb').val();

            $.ajax({
                url: "<?= base_url('master/get_fee_by_id/'); ?>",
                method: "POST",
                data: {
                    id: id,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    if (category == 'car') {
                        $('#total').val(data[0].car);
                    } else {
                        $('#total').val(data[0].motorcycle);
                    }
                }
            });
        });
    });
</script>

<!-- Ajax Change Access -->
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });

    $('.form-check-input').on('change', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess') ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/') ?>" + roleId;
            }
        });
    });
</script>

<!-- Datatable -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_user').DataTable();
        $('#table_user_access').DataTable();
        $('#table_menu').DataTable();
        $('#table_sub_menu').DataTable();
        $('#table_master').DataTable();
        $('#table_partner').DataTable();
        $('#table_cost').DataTable();
        $('#table_stnk').DataTable();
        $('#table_bpkb').DataTable();
    });
</script>

<!-- Dynamic Add Costs -->
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button  
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div id="add-cost" class="form-group col-lg-4 col-md-4">\
                            <input type="text" class="form-control" name="add-cost[]" value="">\
                        </div>\
                        <div id="desc-cost" class="form-group col-lg-7 col-md-7">\
                            <input type="text" class="form-control" name="desc-cost[]" value="">\
                        </div>\
                        <div id="button-cost" class="form-group col-lg-1 col-md-1">\
                            <a href="javascript:void(0);" class="remove_button"><img src="<?= base_url('assets/'); ?>img/minus.svg" /></a>\
                        </div>'; //New input field html 
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }


        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $('#add-cost').remove(); //Remove field html
            $('#desc-cost').remove(); //Remove field html
            $('#button-cost').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>

<!-- Accept only numeric -->
<script type="text/javascript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

<!-- Date Picker -->
<script>
    $('#date_assign').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy',
        modal: true, 
        header: true, 
        footer: true
    });

    $('#jatuh_tempo').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy',
        modal: true, 
        header: true, 
        footer: true
    });
</script>

<!-- Clear image -->
<script>
    function clearImg(id) {
        _id = id.slice(6);
        document.getElementById(_id).value = "";
    }
</script>

</body>

</html>