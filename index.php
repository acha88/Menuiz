<?php
    session_start();
?>
<?php 
// SOFIANE 20/01/2022
// check pour voir si l'utilisateur est authentifié et autorisé     
    if  ($_SESSION['allow'] <> 'yes') {
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
   <link rel="stylesheet" href="css/style.css">
    <title>Accueil </title>
</head>
<body>
    <?php
        // HEADER
        include "View/header.php";
    ?>
    <main>
        <div class="admin">
        <?php
        // sofiane 20/01/2022
        // Vue ADMIN
                if($_SESSION['type_user'] === 'Admin') {
                    echo "<h1>Bonjour ". $_SESSION['type_user']."</h1>";
                    // include "view/adminView.php";
                    $sql = 'SELECT * FROM T_D_DOSSIER_SAV_DSV';
                    $db = Connector::getInstance();
                    $db->showQuery($sql);
                } 
        ?>
        </div>
        <div class="technicienHOTLINE">
        <?php
        // sofiane 20/01/2022
        // Vue technicien HOTLINE
                if($_SESSION['type_user'] === 'Technicien HOTLINE') {
                    echo "<h1>Bonjour ". $_SESSION['type_user']."</h1>";
                    // include "view/technicienHOTView.php";
                    include "View/search.php";
                } 
        ?>
        </div>
        <div class="technicienSAV">
        <?php
        // sofiane 20/01/2022
        // Vue technicien SAV
                if($_SESSION['type_user'] === 'Technicien SAV') {
                    echo "<h1>Bonjour ". $_SESSION['type_user']. "</h1>";
                    // include "view/technicienSAVView.php";
                } 
        ?>
        </div>
    </main>
    <?php
        // FOOTER
        include "View/footer.php";
    ?>
</body>
</html>