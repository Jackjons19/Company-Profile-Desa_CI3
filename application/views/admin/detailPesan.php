<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $pesan->nama; ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="progress">
                            No telepon: <?php echo $pesan->no_telepon; ?> || Email: <?php echo $pesan->email; ?>
                            <?php if (!empty($pesan->tanggal_dikirim)) : ?>
                                || Tanggal Dikirim: <?php echo date('Y-m-d H:i:s', strtotime($pesan->tanggal_dikirim)); ?>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <div class="card">
                            <?php echo $pesan->pesan; ?>
                        </div>

                        <br><br><br><br>

                        <a class="btn btn-warning" href="<?php echo base_url('admin/pesan'); ?>">Kembali</a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
