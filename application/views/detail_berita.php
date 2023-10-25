<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets') ?>/user/css/materialize.min.css"  media="screen,projection"/>

      <!-- my css -->
      <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets') ?>/user/css/style.css">

      <style type="text/css">
        .parallax-container{
          height: 400px;
        }

        .active{
          background-color: #B8860B;
          color: #fff;
        }

        .clients h3{
          text-shadow: 2px 2px 4px rgba(0,0,0,1);
        }

        .warna{
          background-color: #DAA520;
        }
      </style>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Tambahkan kode CSS dan judul halaman -->
    <title>Detail Berita | <?php echo $title; ?></title>
</head>
<body id="home" class="scrollspy">

<section id="fasilitas" class="yellow services gray lighten-3 scrollspy">
        <div class="container">
          <div class="row">
            <div class="clients">
              <h3 class="light center grey-text white-text"><?php echo $berita->judul; ?></h3>
            </div>
            <div class="col m6 s12">
            <!-- Tampilkan detail berita -->
    <a><i class="fa fa-user"></i>Admin Ciampea Udik | <?php echo $berita->created_at; ?></a>
    <img src="<?php echo base_url('assets/user/img/'.$berita->gambar); ?>" alt="Gambar Berita" width="800px" height="400px">
    <p><?php echo $berita->isi; ?></p>
            </div>       
          </div>
          <a class="btn btn-sm btn-primary" href="<?php echo base_url(''); ?>"><i class="fa fa-plus"></i>Kembali</a>
        </div>
      </section>
</body>
</html>
