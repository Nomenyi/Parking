<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inputing.css">
    <?php
        include "lib.php";
    ?>
    <title>E-Parking - Finding parking</title>
</head>
<body>
    <div class="container">
        <div class="find">
            <i class="fas fa-parking"></i>
            <form action="" method="post">
                <h2 style="color: white" class="titre">TROUVER UNE PLACE</h2>
                <input type="number" min="1" name="taille" placeholder="Entrer la taille de votre voiture"> <br>
                <input type="submit" onclick="openmodal()" name="chercher" value="Chercher"> <br>
            </form>
        </div>
    </div>
</body>
</html>

<?php

include "dbconnect.php";

if (!empty($_POST["chercher"]) AND isset($_POST["chercher"])) {
    if (!empty($_POST["taille"]) AND isset($_POST["taille"])) {
        $taille = htmlspecialchars(trim($_POST["taille"]));

        try {
            $selAxeA = $conn->prepare("SELECT AxesName, AxesLength FROM Axes WHERE AxesId = 1");
            $selAxeA->execute();
            $resAxeA = $selAxeA->fetch();

            $axel = $resAxeA["AxesLength"];

            if ($axel > ($taille + 0.5)) {
                header("Location:confirm.php?axe=A&taille=$taille&axelength=$axel");
            } else {
                try {
                    $selAxeB = $conn->prepare("SELECT AxesName, AxesLength FROM Axes WHERE AxesId = 2");
                    $selAxeB->execute();
                    $resAxeB = $selAxeB->fetch();

                    $axel = $resAxeB["AxesLength"];

                    if ($axel > ($taille + 0.5)) {
                        header("Location:confirm.php?axe=B&taille=$taille&axelength=$axel");
                    } else {
                        try {
                            $selAxeC = $conn->prepare("SELECT AxesName, AxesLength FROM Axes WHERE AxesId = 3");
                            $selAxeC->execute();
                            $resAxeC = $selAxeC->fetch();

                            $axel = $resAxeC["AxesLength"];

                            if ($axel > ($taille + 0.5)) {
                                header("Location:confirm.php?axe=C&taille=$taille&axelength=$axel");
                            } else {
                                echo '
                                    <div class="container">
                                        <div class="error">
                                            <h1>Désolé ! Le parking est plein. <i class="fas fa-frown"><i></h1>
                                        </div>
                                    </div>
                                ';
                            }
                            

                        } catch (Exception $e) {
                            die("Erreur : ".$e->getMessage());
                        }
                    }
                    

                } catch (Exception $e) {
                    die("Erreur : ".$e->getMessage());
                }
            }
            

        } catch (Exception $e) {
            die("Erreur : ".$e->getMessage());
        }
    } else {
        echo '
            <div class="container">
                <div class="error">
                    <h1>Veuillez entrer la taille de votre voiture !</h1>
                </div>
            </div>
        ';
    }
    
}

?>