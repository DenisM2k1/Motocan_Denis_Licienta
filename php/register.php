<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $nr_telefon = $adresa = "";
$username_err = $password_err = $nr_telefon_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Introdu un nume de utilizator.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Numele de utilizator poate contine doar litere, cifre si underscore.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id_utilizator FROM utilizatori WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Acest nume de utilizator este deja folosit.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Eroare la executare statement MySQL.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Introdu o parola.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Parola trebuie sa aiba cel putin 6 caractere.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma parola.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Parolele nu coincid.";
        }
    } 

    //Validate nr_telefon
    if(empty(trim($_POST["nr_telefon"]))){
        $nr_telefon_err = "Introdu un numar de telefon.";
    } elseif(strlen(trim($_POST["nr_telefon"])) != 10 ){
        $nr_telefon_err = "Numarul de telefon trebuie sa contina exact 10 cifre.";
    } elseif(!preg_match('/^0/', trim($_POST["nr_telefon"]))){
        $nr_telefon_err = "Numarul de telefon trebuie sa inceapa cu cifra 0.";
    } else{
        $nr_telefon = trim($_POST["nr_telefon"]);
    }

    //Validate nr_telefon
    if(empty(trim($_POST["adresa"]))){
        $nr_telefon_err = "Introdu o adresa";
    } else{
        $adresa = trim($_POST["adresa"]);
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO utilizatori (username, parola, nr_telefon, adresa) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password,  $param_nr_telefon, $param_adresa);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_nr_telefon = $nr_telefon;
            $param_adresa = $adresa;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Eroare la executare statement MySQL.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
    