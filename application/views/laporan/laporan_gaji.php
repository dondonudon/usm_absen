<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">LAPORAN GAJI</h3>
                    </div>

        <div class="box-body">
        <div style="padding-bottom: 10px;">
            <form id="form-filter" class="form-horizontal">
                        <div class="form-group">
                            <label for="country" class="col-sm-2 control-label">Karyawan</label>
                            <div class="col-sm-4">
                                <?php echo $form_country; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Tanggal Awal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tgl_a">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Tanggal Akhir</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tgl_b">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="LastName" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                                <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
        </div>
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Karyawan</th>
                    <th>Periode</th>
                    <th>Total Gaji</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>
        <script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>
        <script type="text/javascript">

        var table;

        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({

                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('laporan_gaji/ajax_list')?>",
                    "type": "POST",
                    "data": function ( data ) {
                        data.nama_karyawan = $('#nama_karyawan').val();
                        data.tgl_a = $('#tgl_a').val();
                        data.tgl_b = $('#tgl_b').val();
                    }
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                {
                    "targets": [ 0 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],

            });

            $('#btn-filter').click(function(){ //button filter event click
                table.ajax.reload();  //just reload table
            });
            $('#btn-reset').click(function(){ //button reset event click
                $('#form-filter')[0].reset();
                table.ajax.reload();  //just reload table
            });

        });

        </script>
