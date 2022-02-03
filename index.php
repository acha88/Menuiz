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
    <link rel="stylesheet" href="CSS/style.css">
    <title>Accueil </title>
</head>
<body>   
 <?php
 // HEADER
 include "View/header.php";
    echo "<main>";
// sofiane 20/01/2022
// Vue ADMIN
        // last update 01/02/2022 SOFIANE
        if($_SESSION['type_user'] === 'Admin') {
            echo '<div id="admin-box" class="box-container">';
            echo '<div class="adminPage">';
            echo '<div class="fold-container shadow form-admin">';
                include "modules/ClassAdmin.php";
                echo "<H1 class='form-legend'>Bienvenue ". $_SESSION['type_user']."</H1>";
                // include "view/admin/grantPriv.php";
                include "view/admin/registerUser.php";
                // include "view/admin/grantPriv.php";
                include "view/admin/RemoveUser.php"; 
            echo '</div>';
            echo '</div>'; 
            echo '<div class="adminPage">';
            echo '<div  class="fold-container shadow form-admin">';
            echo "<H1 class='form-legend'>Liste des utilisateurs</H1>";
            $adminView = new Administrator();
            $adminView->viewUsers();
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } 

    // sofiane 20/01/2022
    // Vue technicien HOTLINE
    // last update 01/02/2022 SOFIANE
        if($_SESSION['type_user'] === 'Technicien HOTLINE') {
            echo '<div id="hotline-box" class="technicienHOTLINE">';
            echo "<H1 class='form-legend'>Bienvenue ". $_SESSION['type_user']."</H1>";
            //  include "view/technicienHOTView.php";
            include "View/searchHOT.php";
            // include "modules/ClassDossierSAV.php";
            //     $SAV = new DossierSAV();
            //     if (isset($_POST['typeDiag'])) {                    
            //         $SAV->getTypeDiag($_POST['typeDiag']);
            //     }
            //     else if(isset($_POST['productName'])) {                  
            //         $SAV->getProductName($_POST['productName']);
            //     }
            //     else if(isset($_POST['numCmd'])) {                   
            //         $SAV->getNumCmd($_POST['numCmd']);
            //     }  
            echo '</div>';
        } 
    // sofiane 20/01/2022
    // LAST UPDATE 27/01/2022
    // Vue technicien SAV        
    // code d'initialisation de la page pour le Technicien SAV
        if($_SESSION['type_user'] === 'Technicien SAV') {
            echo '<div id="sav-box" class="box-container">';
            echo '<div class="chaFieldsetSearchPrincipal">';
            echo "<H1 class='form-legend'>Bienvenue ". $_SESSION['type_user']. "</H1>";                
            include "modules/ClassTechSAV.php";
                $sav = new TechSAV();
                $sav->getNotTreated();
            echo '</div>';
            if(isset($_POST['getsavid']) && isset($_POST['gettdsid']) && isset($_POST['getprdid']) && isset($_POST['getorhid'])){
                echo '<div class="chaFieldsetSearchPrincipal">';
                    $sav2 = new TechSav();
                    $sav->printSAVFolder($_POST);
                echo '</div>';
        }
        // code pour lancer l'update d'un dossier SAV
        if(isset($_POST['dossierid'])){ 
            $mrsav2 = new TechSAV();
            $mrsav2->updateFolder($_POST);
        }
        if(isset($_POST['gethistory'])){
            $mrsav3 = new TechSAV();
            $mrsav3->getStory($_POST);
        }
        echo '</div>';
    }
    echo "</main>";
    // FOOTER
    // include "View/footer.php";
?>
</body>
</html>