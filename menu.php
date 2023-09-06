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
          $_SESSION['current_page'] = 'menu';
          require("./php/header.php")
        ?>
    </header>
  </div>


  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Meniu
        </h2>
      </div>
            
      <ul class="filters_menu">
        <li class="active" data-filter="*">Toate</li>
        <li data-filter=".bauturi">Băuturi</li>
        <li data-filter=".burger">Burgeri</li>
        <li data-filter=".pizza">Pizza</li>
        <li data-filter=".pasta">Paste</li>
        <li data-filter=".desert">Desert</li>
        <li data-filter=".fries">Sosuri și garnituri</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">
        <?php            
                  #open "produse.json" file

                  $file = file_get_contents('produse.json');

                  # decode json to array

                  $json = json_decode($file, true);

                  foreach ($json as $product) {
                    
                    $prod_id = $product["product_id"];

                    # get product name and price from db

                    $sql = "SELECT denumire, pret FROM produse WHERE id_produs = $prod_id;";

                    $result = mysqli_query($link, $sql);

                    $row = mysqli_fetch_assoc($result);

                    $product_name = $row['denumire'];
                    $price = $row['pret'];

                    echo '<div class="col-sm-6 col-lg-4 all ', $product["product_type"], '">';
                      echo '<div class="box">';
                        echo '<div>';
                          echo '<div class="img-box">';
                          echo '<img src="', $product["picture_path"], '" alt="">';
                        echo '</div>';
                          echo '<div class="detail-box">';
                            echo '<h5>';
                             echo $product_name;
                            echo '</h5>';
                            if($product["product_type"] == 'pizza' || $product["product_type"] == 'burger' || $product["product_type"] == 'pasta'
                            || $product["product_type"] == 'desert') {
                              echo '<p>';
                                echo $product["ingredients"];
                              echo '</p>';
                            }
                            if($product["product_type"] != 'desert') {
                              echo '<p>';
                              echo nl2br(str_replace('\\n', "\n", $product["description"]));
                              echo '</p>';
                            }
                            echo '<div class="options">';
                              echo '<h6>';
                                echo $price, " lei";
                              echo '</h6>';
                              echo '<button class="adauga" data-id="', $prod_id, '" onclick="adauga_produs_button(this)">';
                                echo '<img src="images/add.png" alt="">';
                              echo '</button>';
                            echo '</div>';
                          echo '</div>';
                        echo '</div>';
                      echo '</div>';
                    echo '</div>';

                  }
          ?>


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