<div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.php">
            <span>
            <img src="images/logo.png" type="">
              KingMaster
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <?php 
                if(!isset($_SESSION))  {
                  session_start();
                }

                $pages = array("index", "menu", "about", "book");
                $pageNames = array("Home", "Meniu", "Despre noi", "Rezervări");
                $current_page = $_SESSION['current_page'];

                
                foreach($pages as $key => $page) {
                  if ($page == $current_page) {
                    echo '<li class="nav-item active">';
                  } else {
                    echo '<li class="nav-item">';
                  }
                  echo '<a class="nav-link" href="' . $page . '.php">' . $pageNames[$key] . '</a>';
                  echo '</li>';
                }
              
              ?>
            </ul>
            <div class="user_option">
                
                <script>
                  function cos() {
                    window.location.href = "cos.php";
                    return false;
                  }
                </script>
                <button class="carts" onclick="cos()" type="button">
                  <div id="shoppingCartItemNo" class="shoppingCartItemNo">0</div>
                  <img src="images/cos.png" type="">
                </button>
                
             
            </div>


              <?php
                // Initialize the session
                if(!isset($_SESSION))  {
                  session_start();
              }
                
                if(!isset($_SESSION["loggedin"])){
                  echo '<button onclick="document.getElementById(\'id01\').style.display=\'block\'" style="width:auto;">Logare</button>
                  <div id="id01" class="modal">
                    <form class="modal-content animate" action="php/login.php" method="post">
                      <div class="imgcontainer">
                        <span onclick="document.getElementById(\'id01\').style.display=\'none\'" class="close" title="Close Modal">&times;</span>
                      </div>
                      <div class="container">
                     
                      <h1> <img src="images/login.png" type="">  Conectează-te la cont</h1>
                      <hr>
                        <label for="uname"><b>Nume Utilizator</b></label>
                        <input type="text" placeholder="Nume Utilizator" name="username" required>
    
                        <label for="psw"><b>Parolă</b></label>
                        <input type="password" placeholder="Parolă" name="password" required>
                          
                        <button type="submit">Logare</button>
                        <label>
                          <input type="checkbox" checked="checked" name="remember">Ține-mă minte
                        </label>
                      </div>
                      <div class="container" style="background-color:#f1f1f1">
                        <button type="cancelbtn" onclick="document.getElementById(\'id01\').style.display=\'none\'" class="cancelbtn">Cancel</button>
                        
                      </div>
                    </form>
                  </div>
                  <div>
                
    
                <button onclick="document.getElementById(\'id02\').style.display=\'block\'" style="width:auto;">Creare cont</button>
                <div id="id02" class="modal">
                  <form class="modal-content animate" action="php/register.php" method="POST">
                    <div class="imgcontainer">
                      <span onclick="document.getElementById(\'id02\').style.display=\'none\'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <div class="container">
                      <h1><img src="images/create.png" type="">Crează-ți cont</h1>
                      <hr>
                      <label for="uname"><b>Nume Utilizator</b></label>
                      <input type="text" autocomplete="off" placeholder="Nume Utilizator" name="username" required>
              
                      <label for="psw"><b>Parolă</b></label>
                      <input type="password" placeholder="Parolă" name="password" required>
                
                      <label for="psw-repeat"><b>Repetă parola </b></label>
                      <input type="password" placeholder="Parolă" name="confirm_password" required>
      
                      <label for="num"><b>Număr de telefon</b></label>
                      <input type="text" autocomplete="off" placeholder="Număr de telefon" name="nr_telefon" required>
      
                      <label for="address"><b>Adresă livrare</b></label>
                      <input type="text" autocomplete="off" placeholder="Adresa" name="adresa" required>
                      
                    </div>
                    <div class="container" style="background-color:#f1f1f1">
                      <button type="submit" class="signupbtn">Crează cont</button>
                    </div>
                  </form>
                </div>';
                  } else {$_SESSION["loggedin"] = false;
                    unset($_SESSION["id"]);
                    unset($_SESSION["username"]);
                    echo '<button onclick="logout()" style="width:auto;">Deconectare</button>';
                  }
              ?>
          

          </div>
        </nav>
      </div>