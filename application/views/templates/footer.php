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

            console.log(id);

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
        $('#type-stnk').change(function() {
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
                    $('#service-id-stnk').html(html);

                    serv_id = $('#service-id-stnk').val();
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
                            }
                            $('#param-stnk').html(html1);
                        }
                    });
                }
            });

            return false;
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
                    $('#param-stnk').html(html1);
                }
            });

            return false;
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
    });
</script>

</body>

</html>