<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pakar Medis</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body>
  <!-- header section start -->
  <div class="header_section">
    <div class="container-fluid">
      <div class="main">
        <div class="logo"><a href="index.html"><img src="images/logo.png" alt="Logo"></a></div>
        <div class="menu_text">
          <ul>
            <div class="togle_">
            </div>
            <div id="myNav" class="overlay">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
              <div class="overlay-content">
                <a href="/">Beranda</a>
                <a href="#fitur">Fitur</a>
                <a href="#tentang">Tentang</a>
                <a href="#ahli">Pendapat Ahli</a>
                <a href="#artikel">Artikel</a>
              </div>
            </div>
            <span onclick="openNav()"><img src="images/toogle-icon.png" class="toggle_menu" alt="Menu"></span>
          </ul>
        </div>
      </div>
    </div>
    <!-- banner section start -->
    <div class="banner_section layout_padding">
      <div class="container">
        <div id="my_slider" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-6">
                  <div class="container">
                    <h1 class="banner_taital">Diagnosa Cepat dan Akurat</h1>
                    <p class="banner_text">Gunakan Sistem Pakar untuk membantu mendiagnosis gejala penyakit secara cepat, tepat, dan efisien.</p>
                    <div class="more_bt"><a href="/login">Mulai Konsultasi</a></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="banner_img"><img src="images/banner-img.png" alt="Banner"></div>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div>
    </div>
    <!-- banner section end -->
  </div>
  <!-- header section end -->

  <!-- fitur section start -->
  <div id="fitur" class="protect_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1 class="protect_taital">Fitur Sistem Pakar Medis</h1>
          <p class="protect_text">Sistem Pakar Medis adalah aplikasi cerdas yang meniru cara kerja seorang dokter untuk membantu mendiagnosis penyakit berdasarkan gejala yang dialami pasien.</p>
        </div>
      </div>
      <div class="protect_section_2 layout_padding">
        <div class="row">
          <div class="col-md-6">
            <h1 class="hands_text"><a href="#">Diagnosa Berdasarkan Gejala</a></h1>
            <h1 class="hands_text"><a href="#">Saran Medis Otomatis</a></h1>
            <h1 class="hands_text"><a href="#">Data Rekam Medis Digital</a></h1>
          </div>
          <div class="col-md-6">
            <div class="image_2"><img src="images/img-1.webp" alt="Fitur"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- fitur section end -->

  <!-- tentang section start -->
  <div id="tentang" class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="about_img"><img src="images/img-1.png" alt="Tentang"></div>
        </div>
        <div class="col-md-6">
          <h1 class="about_taital">Bagaimana Sistem Ini Bekerja?</h1>
          <p class="about_text">Sistem ini bekerja dengan mengumpulkan gejala dari pengguna, kemudian mencocokkannya dengan basis pengetahuan medis untuk memberikan diagnosis awal dan saran tindak lanjut.</p>
          <div class="read_bt"><a href="#">Pelajari Lebih</a></div>
        </div>
      </div>
    </div>
  </div>
  <!-- tentang section end -->

  <!-- pendapat ahli section start -->
  <div id="ahli" class="doctors_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="taital_main">
            <div class="taital_left">
              <div class="play_icon"><img src="images/play-icon.png" alt="Icon"></div>
            </div>
            <div class="taital_right">
              <h1 class="doctor_taital">Apa Kata Dokter?</h1>
              <p class="doctor_text">Sistem pakar sangat membantu dalam proses skrining awal, terutama di daerah terpencil. Ini bukan pengganti dokter, tetapi alat bantu yang sangat bermanfaat.</p>
              <div class="readmore_bt"><a href="#">Baca Selengkapnya</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- pendapat ahli section end -->

  <!-- artikel section start -->
  <div id="artikel" class="news_section layout_padding">
    <div class="container">
      <div id="main_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <h1 class="news_taital">Artikel Terbaru</h1>
            <p class="news_text">Informasi terkini tentang kesehatan dan teknologi sistem pakar medis.</p>
            <div class="news_section_2 layout_padding">
              <div class="box_main">
                <div class="image_1"><img src="images/news-img.png" alt="Artikel"></div>
                <h2 class="design_text">Mengapa Diagnosa Dini Itu Penting?</h2>
                <p class="lorem_text">Deteksi dini dapat meningkatkan peluang kesembuhan dan mencegah komplikasi. Sistem pakar memungkinkan masyarakat untuk mendapatkan analisa awal dari rumah.</p>
                <div class="read_btn"><a href="#">Selengkapnya</a></div>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
          <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
          <i class="fa fa-angle-right"></i>
        </a>
      </div>
    </div>
  </div>
  <!-- artikel section end -->

  <!-- copyright -->
  <div class="copyright_section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <p class="copyright_text">© 2025 Sistem Pakar Medis. Semua Hak Dilindungi.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.0.0.min.js"></script>
  <script src="js/plugin.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/owl.carousel.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  <script>
    $(document).ready(function () {
      $(".fancybox").fancybox({ openEffect: "none", closeEffect: "none" });
      $(".zoom").hover(function () {
        $(this).addClass('transition');
      }, function () {
        $(this).removeClass('transition');
      });
    });

    function openNav() {
      document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
  </script>
</body>
</html>
