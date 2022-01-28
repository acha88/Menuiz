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
    <div id="admin-box" class="box-container<?php 
                        if($_SESSION['type_user'] !== 'Admin') {
                            echo " hidden";
                        }
    ?>">     
    <?php
// sofiane 20/01/2022
// Vue ADMIN
        if($_SESSION['type_user'] === 'Admin') {
            echo '<div class="half-box shadow">';
            include "modules/ClassAdmin.php";
            echo "<H1 class='form-legend'>Bienvenue ". $_SESSION['type_user']."</H1>";
            // include "view/admin/adminView.php";
            include "view/admin/registerUser.php";
            include "view/admin/RemoveUser.php"; 
            echo '</div>'; 
            echo '<div  class="half-box shadow">';
            echo "<H1 class='form-legend'>Liste des utilisateurs</H1>";
            $adminView = new Administrator();
            $adminView->viewUsers();
            echo '</div>';
        } 
     ?>
</div>
<div id="hotline-box" class="technicienHOTLINE">
    <?php
    // sofiane 20/01/2022
    // Vue technicien HOTLINE
            if($_SESSION['type_user'] === 'Technicien HOTLINE') {
                echo "<H1 class='form-legend'>Bienvenue ". $_SESSION['type_user']."</H1>";
                //  include "view/technicienHOTView.php";
                include "View/searchHOT.php";
                include "modules/ClassDossierSAV.php";
                    $SAV = new DossierSAV();
                    if (isset($_POST['typeDiag'])) {                    
                        $SAV->getTypeDiag($_POST['typeDiag']);
                    }
                    else if(isset($_POST['productName'])) {                  
                        $SAV->getProductName($_POST['productName']);
                    }
                    else if(isset($_POST['numCmd'])) {                   
                        $SAV->getNumCmd($_POST['numCmd']);
                    }  
            } 
    ?>
</div>
    <div id="sav-box" class="box-container">
        
                <?php
    // sofiane 20/01/2022
    // LAST UPDATE 27/01/2022
    // Vue technicien SAV
                        if($_SESSION['type_user'] === 'Technicien SAV') {
                            echo '<div class="half-box shadow padding">';
                            echo "<H1 class='form-legend'>Bienvenue ". $_SESSION['type_user']. "</H1>";                
                            include "modules/ClassTechSAV.php";
                            $sav = new TechSAV();
                            $sav->getNotTreated();
                            echo '</div>';
                                            if(isset($_POST['getsavid']) && isset($_POST['gettdsid']) && isset($_POST['getprdid']) && isset($_POST['getorhid'])){
                                                echo '<div class="half-box shadow padding">';
                                                $sav2 = new TechSav();
                                                $sav->printSAVFolder($_POST);
                                                echo '</div>';
                }
            }
            ?>
</div>



<?php
    // FOOTER
    // include "View/footer.php";
?>

<script type="text/javascript" src="js/script.js"></script>
    </main>
</body>
</html>