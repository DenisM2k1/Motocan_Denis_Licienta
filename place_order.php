<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["order"])) {
        $orderData = $_POST["order"];
        $orderItems = explode(';', $orderData);
        
        // Conectați-vă la baza de date
        $conn = new mysqli("localhost", "username", "password", "nume_baza_de_date");
        
        if ($conn->connect_error) {
            die("Conexiune eșuată: " . $conn->connect_error);
        }
        
        foreach ($orderItems as $item) {
            list($product, $price) = explode(':', $item);
            $sql = "INSERT INTO comenzi (produs, pret) VALUES ('$product', '$price')";
            
            if ($conn->query($sql) !== TRUE) {
                echo "Eroare la inserare: " . $conn->error;
                $conn->close();
                exit();
            }
        }
        
        echo "Comanda a fost plasată cu succes!";
        $conn->close();
    } else {
        echo "Date incomplete.";
    }
}
?>
