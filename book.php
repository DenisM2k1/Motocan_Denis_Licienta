<?php

require_once "./php/config.php";

if(!isset($_SESSION))  {
  session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> KingMaster </title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />

  <script src="js/kingmasterscript.js"> </script>
  <script>
    incarca_cos();
  </script>
</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/home.jpg" alt="">
    </div>
    <header class="header_section">
      <?php 
        $_SESSION['current_page'] = 'book';
        require("./php/header.php")
        
      ?>
    </header>
  </div>


  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Rezervă o masă
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="php/addBooking.php" metod="POST">
              <div>
                <input name="nume_prenume" type="text" class="form-control" placeholder="Nume și Prenume" />
              </div>
              <div>
                <input name="telefon" type="text" class="form-control" placeholder="Număr telefon" />
              </div>
              <div>
                <input name="email" type="email" class="form-control" placeholder="Email" />
              </div>
              <div>
                <select name="nr_persoane" class="form-control nice-select wide">
                  <option value="" disabled selected>
                    Număr persoane
                  </option>
                  <option value="">
                    1
                  </option>
                  <option value="">
                    2
                  </option>
                  <option value="">
                    3
                  </option>
                  <option value="">
                    4
                  </option>
                  <option value="">
                    5
                  </option>
                  <option value="">
                    6
                  </option>
                  <option value="">
                    7
                  </option>
                  <option value="">
                    8
                  </option>
                  <option value="">
                    9
                  </option>
                  <option value="">
                    10
                  </option>
                </select>
              </div>
              <div>
                <input name="data" type="date" class="form-control">
              </div>
              <div class="btn_box">
                <input type="submit" formmethod="POST" value="Rezervă acum" />
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1377.7350957187905!2d21.68519364250928!3d46.32035857995258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4745f33320bf4a5d%3A0x92612310c97ad878!2sStera%20srl!5e0!3m2!1sro!2sro!4v1692058638468!5m2!1sro!2sro" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Contactați- ne!
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Locația
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Telefon +40 740317487
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  kingmaster@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              KingMaster
            </a>
            <p>
              Vă mulțumim că ați ales localul nostru, pentru a fi la curent cu tot ce se întâmplă la noi, ne găsiți pe rețelele de socializare de mai jos
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Orele deschiderii
          </h4>
          <p>
            Luni - Duminică
          </p>
          <p>
            10.00 - 23.00 
          </p>
        </div>
      </div>
    </div>
    <div class="footer-info">
      <p>
        <span id="displayYear"></span>
      </p>
    </div>
  </div>
    </div>
  </footer>

  
  <script>
    function logout() {
      window.location.href = "./php/logout.php";
    }
  </script>
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>

</body>
</html>