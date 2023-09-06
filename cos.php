<?php
    require_once "./php/config.php";
    require_once "./php/types.php";

    if(!isset($_SESSION))  {
        session_start();
    }

    // $sql = "CALL creare_comanda(?, @id_comanda)";
    // $stmt = mysqli_prepare($link, $sql);

    // if (!isset($_SESSION["id_user"]))
    // {
    //     header("location: index.php");
    // }
    // $id_user =  $_SESSION["id_user"];
    // mysqli_stmt_bind_param($stmt, "i", $id_user);
    // $stmt->execute();


    // $id_comanda = mysqli_fetch_row(mysqli_query($link, "SELECT @id_comanda;"))[0];
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

<body>
  
  <div class="hero_area"> 
    <div class="bg-box">
      <img src="images/backgroundhome.png" alt="">
    </div>
    <header class="header_section">
      <?php 
          $_SESSION['current_page'] = 'cos';
          require("./php/header.php")
        ?>
    </header>

    <div class="offer_section layout_padding-bottom">
    <table id="produse_cos" class="table">
        <tr class="tr">
            <th class="th">Produs</th >
            <th class="th">Preț</th>
            <th class="th">Cantitate</th>
            <th class="th"> </th>
        </tr>
          <?php
            $shoppingCartList = json_decode($_COOKIE["shoppingCart"], true);

            $totalPrice = 0;

            # for each id in shoppingCartList, get the name and price from the database
            foreach ($shoppingCartList as $key=>$value) {

              $id_produs = $value["id"];
              $cantitate = $value["cantitate"];

              $sql = "SELECT denumire, pret FROM produse WHERE id_produs = ?";
              $stmt = mysqli_prepare($link, $sql);
              mysqli_stmt_bind_param($stmt, "i", $id_produs);
              $stmt->execute();
              $result = $stmt->get_result();
              $row = mysqli_fetch_array($result);
              echo '<tr class="tr">
                      <td class="td">', $row["denumire"], '</td>
                      <td class="td">', $row["pret"], ' lei</td>
                      <td class="td"><input class="quantityInput" type="number" min=1 value=', $cantitate, ' data-id=', $id_produs, 
                                      ' onChange="quantityChange(this)" onfocus="this.oldValue = this.value"> </input></td>
                      <td class="td"><button data-id=', $id_produs, ' data-index=', $key, ' onclick="sterge_produs_button(this)">Șterge</button></td>
                    </tr>';
              $totalPrice += $row["pret"] * $cantitate;
            }


            echo '<tr>
                    <td>Total</td>
                    <td>', $totalPrice, ' lei</td>
                  </tr>';
          ?> 
      </table>
    </div>
    <div class="offer_section layout_padding-bottom" style="margin:auto;">
      <script>
        function comanda() {
          if (shoppingCartList.length == 0) {
            alert("Nu sunt produse În coș.");
            return;
          }
          window.location.href = "./php/trimiteComanda.php";
        }
      </script>
      <button id="comandaBT" onclick="comanda()" style="width:auto;">Comandă</button>        
    </div>
 </body>
 </html>
