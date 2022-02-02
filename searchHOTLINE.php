<?php 
    // SOFIANE 20/01/2022
    // check pour voir si l'utilisateur est authentifié et autorisé  
    session_start();
    if($_SESSION['allow'] <> 'yes') {
     header("Location: login.php");
    } else {
     $_SESSION['allow'] = 'yes';
    } 
    include "modules/ClassConnector.php";
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Tickets</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php include "View/header.php"; ?>
    <main>
    <!-- Partie code par Charlotte le 19/01/2022 -->
    <!-- code php ; récupération et affichage de la recherche -->
        <section class="chaSectionTicket">
                <?php
                    include "modules/ClassDossierSAV.php";
                    $SAV = new DossierSAV();
                    if (isset($_POST['typeDiag'])) {                    
                        $SAV->getTypeDiag($_POST['typeDiag']);
                    }
                    /* BUG : AFFICHAGE DE TOUS LES IF */
                    else if (isset($_POST['numCmd'])) {
                        $SAV->getNumCmd($_POST['numCmd']);
                    }
                    else if (isset($_POST['nameCustomer'])) {
                        $SAV->getNameCustomer($_POST['nameCustomer']);
                    }
                    else if (isset($_POST['productName'])) {                  
                        $SAV->getProductName($_POST['productName']);
                    }
                ?>
        </section>
        <section class="chaSection">
            <form method="POST" action="">
                <fieldset class="chaFieldsetSearchPrincipal">
                    <legend class="chaLegend">Rechercher un ticket :</legend>
                    <fieldset class="chaFieldsetSearch">
                    <label for="">Par type de diagnostic : </label>
                    <input type="text" name="typeDiag">
                    <input class="btnSearch" type="submit" value="Rechercher" required>
                </fieldset>
            </form>
            <form method="POST" action="">
                <fieldset class="chaFieldsetSearch">
                    <label for="">Par numéro de commande ou facture : </label>
                    <input type="text" name="numCmd">
                    <input class="btnSearch" type="submit" value="Rechercher" required>
                </fieldset>
            </form>
            <form method="POST" action="">
                <fieldset class="chaFieldsetSearch">
                    <label for="">Par dénomination client : </label>
                    <input type="text" name="nameCustomer">
                    <input class="btnSearch" type="submit" value="Rechercher" required>
                </fieldset>
            </form>
            <form method="POST" action="">
                <fieldset class="chaFieldsetSearch">
                    <label for="">Par désignation du produit : </label>
                    <input type="text" name="productName">
                    <input class="btnSearch" type="submit" value="Rechercher" required>
                </fieldset>
            </form>
        </section>
    </main>
</body>
</html>