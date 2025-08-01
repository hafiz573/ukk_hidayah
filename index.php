<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Nova Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Nova
  * Template URL: https://bootstrapmade.com/nova-bootstrap-business-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">SI-KAMPUNG JOS</h1>
      </a>

      <nav id="navmenu" class="navmenu">
          <ul>
            <li>
              <a href="index.php" class="active">Beranda<br /></a>
            </li>
            <li><a href="about.php">Tentang RT</a></li>
            <li><a href="portfolio.php">portfolio</a></li>
            <li><a href="contact.php">Hubungi</a></li>
            <li><a href="team.php">Pengurus</a></li>
            <?php 
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'Warga'): ?>

              <li>
                <a href="warga/">Warga</a>
              </li>
            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
              <li>
                <a href="admin/">Admin</a>
              </li>
          <?php endif; ?>
          </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="assets/img/kegiatan/pemilu.jpeg" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-xl-4">
            <h1 data-aos="fade-up">Warga rukun, lingkungan sehat rejeki lancar</h1>
            <blockquote data-aos="fade-up" data-aos-delay="100">
              <p>Sistem informasi kampung ini di peruntukkan untuk warga RT.4 RW.2 Desa Karang Kimpul Kecamatan Ujung Kulon Kota Malang</p>
            </blockquote>
            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
              <a href="login.php" class="btn-get-started">Login</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Hero Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section">
      <div class="container">
        <div class="row g-0">
          <div class="col-xl-5 img-bg" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/why-us-bg.jpg" alt="">
          </div>

          <div class="col-xl-7 slides position-relative" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "centeredSlides": true,
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  },
                  "navigation": {
                    "nextEl": ".swiper-button-next",
                    "prevEl": ".swiper-button-prev"
                  }
                }
              </script>
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="item">
                    <h3 class="mb-3">Let's grow your business together</h3>
                    <h4 class="mb-3">Optio reiciendis accusantium iusto architecto at quia minima maiores quidem, dolorum.</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, ipsam perferendis asperiores explicabo vel tempore velit totam, natus nesciunt accusantium dicta quod quibusdam ipsum maiores nobis non, eum.
                      Ullam reiciendis dignissimos laborum aut, magni voluptatem velit doloribus quas sapiente optio.
                    </p>
                  </div>
                </div>
                <!-- End slide item -->

                <div class="swiper-slide">
                  <div class="item">
                    <h3 class="mb-3">Unde perspiciatis ut repellat dolorem</h3>
                    <h4 class="mb-3">Amet cumque nam sed voluptas doloribus iusto. Dolorem eos aliquam quis.</h4>
                    <p>
                      Dolorem quia fuga consectetur voluptatem. Earum consequatur nulla maxime necessitatibus cum accusamus. Voluptatem dolorem ut numquam dolorum delectus autem veritatis facilis. Et ea ut repellat ea. Facere est dolores
                      fugiat dolor.
                    </p>
                  </div>
                </div>
                <!-- End slide item -->

                <div class="swiper-slide">
                  <div class="item">
                    <h3 class="mb-3">Aliquid non alias minus</h3>
                    <h4 class="mb-3">Necessitatibus voluptatibus explicabo dolores a vitae voluptatum.</h4>
                    <p>Neque voluptates aut. Soluta aut perspiciatis porro deserunt. Voluptate ut itaque velit. Aut consectetur voluptatem aspernatur sequi sit laborum. Voluptas enim dolorum fugiat aut.</p>
                  </div>
                </div>
                <!-- End slide item -->

                <div class="swiper-slide">
                  <div class="item">
                    <h3 class="mb-3">Necessitatibus suscipit non voluptatem quibusdam</h3>
                    <h4 class="mb-3">Tempora quos est ut quia adipisci ut voluptas. Deleniti laborum soluta nihil est. Eum similique neque autem ut.</h4>
                    <p>Ut rerum et autem vel. Et rerum molestiae aut sit vel incidunt sit at voluptatem. Saepe dolorem et sed voluptate impedit. Ad et qui sint at qui animi animi rerum.</p>
                  </div>
                </div>
                <!-- End slide item -->
              </div>
              <div class="swiper-pagination"></div>
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Why Us Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">
      <img src="assets/img/cta-bg.jpg" alt="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Call To Action</h3>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <a class="cta-btn" href="#">Call To Action</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Call To Action Section -->

    <!-- Features Section -->
    <section id="features" class="features section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
            <h3 class="mb-0">Powerful Features for</h3>
            <h3>Your Business</h3>

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="icon-list d-flex">
                  <i class="bi bi-eye" style="color: #ff8b2c"></i>
                  <span>Easy Cart Features</span>
                </div>
              </div>
              <!-- End Icon List Item-->

              <div class="col-md-6">
                <div class="icon-list d-flex">
                  <i class="bi bi-infinity" style="color: #5578ff"></i>
                  <span>Sit amet consectetur adipisicing</span>
                </div>
              </div>
              <!-- End Icon List Item-->

              <div class="col-md-6">
                <div class="icon-list d-flex">
                  <i class="bi bi-mortarboard" style="color: #e80368"></i>
                  <span>Ipsum Rerum Explicabo</span>
                </div>
              </div>
              <!-- End Icon List Item-->

              <div class="col-md-6">
                <div class="icon-list d-flex">
                  <i class="bi bi-star" style="color: #ffa76e"></i>
                  <span>Easy Cart Features</span>
                </div>
              </div>
              <!-- End Icon List Item-->

              <div class="col-md-6">
                <div class="icon-list d-flex">
                  <i class="bi bi-x-diamond" style="color: #11dbcf"></i>
                  <span>Easy Cart Features</span>
                </div>
              </div>
              <!-- End Icon List Item-->

              <div class="col-md-6">
                <div class="icon-list d-flex">
                  <i class="bi bi-camera-video" style="color: #4233ff"></i>
                  <span>Sit amet consectetur adipisicing</span>
                </div>
              </div>
              <!-- End Icon List Item-->

              <div class="col-md-6">
                <div class="icon-list d-flex">
                  <i class="bi bi-brightness-high" style="color: #29cc61"></i>
                  <span>Ipsum Rerum Explicabo</span>
                </div>
              </div>
              <!-- End Icon List Item-->

              <div class="col-md-6">
                <div class="icon-list d-flex">
                  <i class="bi bi-activity" style="color: #ff5828"></i>
                  <span>Easy Cart Features</span>
                </div>
              </div>
              <!-- End Icon List Item-->
            </div>
          </div>
          <div class="col-lg-5 position-relative" data-aos="zoom-out" data-aos-delay="200">
            <div class="phone-wrap">
              <img src="assets/img/iphone.png" alt="Image" class="img-fluid">
            </div>
          </div>
        </div>
      </div>

      <div class="details">
        <div class="container">
          <div class="row">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
              <h4>Labore Sdio Lidui<br />Bonde Naruto</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam nostrum molestias doloremque quae delectus odit minima corrupti blanditiis quo animi!</p>
              <a href="#about" class="btn-get-started">Get Started</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Features Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Recent Blog Posts</h2>
      </div>
      <!-- End Section Title -->

      <div class="container">
        <div class="row gy-5">
          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt=""></div>
              <div class="meta">
                <span class="post-date">Tue, December 12</span>
                <span class="post-author"> / Julia Parker</span>
              </div>
              <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>
              <p>Illum voluptas ab enim placeat. Adipisci enim velit nulla. Vel omnis laudantium. Asperiores eum ipsa est officiis. Modi qui magni est...</p>
              <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-2.jpg" class="img-fluid" alt=""></div>
              <div class="meta">
                <span class="post-date">Fri, September 05</span>
                <span class="post-author"> / Mario Douglas</span>
              </div>
              <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>
              <p>Voluptatem nesciunt omnis libero autem tempora enim ut ipsam id. Odit quia ab eum assumenda. Quisquam omnis doloribus...</p>
              <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-3.jpg" class="img-fluid" alt=""></div>
              <div class="meta">
                <span class="post-date">Tue, July 27</span>
                <span class="post-author"> / Lisa Hunter</span>
              </div>
              <h3 class="post-title">Quia assumenda est et veritati</h3>
              <p>Quia nam eaque omnis explicabo similique eum quaerat similique laboriosam. Quis omnis repellat sed quae consectetur magnam...</p>
              <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-4.jpg" class="img-fluid" alt=""></div>
              <div class="meta">
                <span class="post-date">Tue, Sep 16</span>
                <span class="post-author"> / Mario Douglas</span>
              </div>
              <h3 class="post-title">Pariatur quia facilis similique deleniti</h3>
              <p>Et consequatur eveniet nam voluptas commodi cumque ea est ex. Aut quis omnis sint ipsum earum quia eligendi...</p>
              <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Recent Posts Section -->
  </main>

  <footer id="footer" class="footer light-background">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename">SI-KAMPUNG JOS</span>
            </a>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
          </div>

          <div class="col-lg-2 col-6 footer-links">
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p>United States</p>
            <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">SMK Hidayah</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>