<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inputing.css">
    <?php
        include "lib.php";
    ?>
    <title>E.Parking - Confirmation</title>
</head>
<body>
    <div class="container">
        <div class="find">
            <i class="fas fa-parking"></i>
            <form action="" method="post">
                <h2 style="color: white" class="titre">
                Vous pouvez garrer dans l'axe <?php echo $_GET["axe"]; ?>
                    Veuillez confirmez en cliquant sur 
                    le boutons ci-dessous si vous voulez entrer dans le parking.
                </h2>
                <input type="submit" name="confirmer" value="Confirmer"> <br>
            </form>
        </div>
    </div>
</body>
</html>

<?php

include "dbconnect.php";
// require "inputing.php";

$axe = $_GET["axe"];
$taille = $_GET["taille"];
$len = $_GET["axelength"];

if (!empty($_POST["confirmer"]) AND isset($_POST["confirmer"])) {
    try {
        $upAxe = $conn->prepare("UPDATE Axes SET AxesLength = ? WHERE AxesName = ?");
        $upAxe->execute(array(($len - ($taille + 0.5)), $axe));

        header("Location:out.php?axe=$axe&taille=$taille&axelength=$len");
    } catch (Exception $e) {
        die("Erreur : ".$e->getMessage());
    }
}

?>