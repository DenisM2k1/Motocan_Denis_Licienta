<?php

require_once "config.php";
require_once "types.php";

session_start();

$user_id = $_SESSION["id_user"];

$shoppingCartList = json_decode($_COOKIE["shoppingCart"], true);

# call "creare_comanda" procedure in db with $user_id; retrieve $id_comanda

# procedure call
$call = mysqli_prepare($link, 'CALL creare_comanda(?, @id_comanda)');
mysqli_stmt_bind_param($call, 'i', $user_id);
mysqli_stmt_execute($call);
mysqli_stmt_close($call);

# get $id_comanda
$select = mysqli_query($link, 'SELECT @id_comanda');
$result = mysqli_fetch_assoc($select);
$id_comanda = $result['@id_comanda'];

# set status = "1" for $id_comanda
$update = mysqli_query($link, "UPDATE comenzi SET status = 1 WHERE id_comanda = $id_comanda");

# call "adaugare_produs" procedure in db with $id_comanda, $id_produs for each item in $shoppingCartList
foreach($shoppingCartList as $key=>$item) {
    $id_produs = $item["id"];
    $cantitate = $item["cantitate"];
    # procedure call
    $call = mysqli_prepare($link, 'CALL adaugare_produs(?, ?, ?)');
    mysqli_stmt_bind_param($call, 'iii', $id_comanda, $id_produs, $cantitate);
    mysqli_stmt_execute($call);
    mysqli_stmt_close($call);
}
# set cookie "shoppingCart" to empty array
setcookie("shoppingCart", "", time() + (86400 * 30), "/");

# redirect to "index.php"

$_SESSION["lastAction"] = "comandaTrimisa_succes";
header("Location: ../index.php");

?>

