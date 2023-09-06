<?php
require_once "./config.php";


if(!isset($_SESSION))  {
    session_start();
}


$nume_prenume = $_POST["nume_prenume"];
$telefon = $_POST["telefon"];
$email = $_POST["email"];
$nr_persoane = $_POST["nr_persoane"];
$data = $_POST["data"];

// # verificare daca exista deja o rezervare cu aceleasi date
// $sql = "SELECT * FROM rezervari WHERE data = '$data'";
// $result = mysqli_query($link, $sql);
// if(mysqli_num_rows($result) > 0) {
//     echo "Exista deja o rezervare pentru aceasta data!";
//     exit();
// }

# inserare rezervare
$sql = "INSERT INTO rezervari (nume_prenume, telefon, email, nr_persoane, data) VALUES ('$nume_prenume', '$telefon', '$email', '$nr_persoane', '$data')";
$result = mysqli_query($link, $sql);
if($result) {
    echo "Rezervare efectuata cu succes!";
} else {
    echo "Eroare la efectuarea rezervarii!";
} 

# redirect to index.php
$_SESSION["lastAction"] = "rezervareTrimisa_success";
header("Location: ../index.php");

?>