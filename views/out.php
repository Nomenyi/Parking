<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inputing.css">
    <?php
        include "lib.php";
    ?>
    <title>E-Parking - Out</title>
</head>
<body>

    <div class="container">
        <div class="find">
            <i class="fas fa-parking"></i>
            <form action="" method="post">
                <h2 style="color: white" class="titre">
                    Veuillez confirmez en cliquant sur 
                    le boutons ci-dessous si vous voulez entrer dans le parking.
                </h2>
                <input type="submit" name="sortir" value="Sortir"> <br>
            </form>
        </div>
    </div>
    
</body>
</html>

<?php

include "dbconnect.php";

$axe = $_GET["axe"];
$taille = $_GET["taille"];
$len = $_GET["axelength"];

if (!empty($_POST["sortir"]) AND isset($_POST["sortir"])) {
    try {

        $selAxe = $conn->prepare("SELECT AxesLength FROM Axes WHERE AxesName = ?");
        $selAxe->execute(array($axe));
        $resAxe = $selAxe->fetch();

        $axen = $resAxe["AxesLength"];

        $upAxe = $conn->prepare("UPDATE Axes SET AxesLength = ? WHERE AxesName = ?");
        $upAxe->execute(array(($axen + ($taille + 0.5)), $axe));

        header("Location:inputing.php");
    } catch (Exception $e) {
        die("Erreur : ".$e->getMessage());
    }
}

?>