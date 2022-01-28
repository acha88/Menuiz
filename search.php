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
    
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="css/style.css">
        <title>Interface SAV</title>
    </head>
</body>

<?php include "view/header.php"; ?>

<h3> Recherche de dossiers </h3>
<div class="container">
    <div class="half-box chaFieldsetSearchPrincipal">
        <div class="form-box">
                <form action="" method="POST">
                <fieldset class="padding">
                    <legend class="form-legend"> Recherche</legend>
                    
                    <div class="form-group">
                    <label for="searchtype">Recherche par type de dossier</label>
                         <select name="searchtype">
                                 <option></option>
                                 <option value="1">En attente de recep.</option>
                                 <option value="2">Reçu</option>
                                 <option value="4">Attente de cloture</option>
                                 <option value="5">Cloturé</option>
                                 <option value="6">Annulé</option>
                         </select>
                     </div>
 
                     <div class="form-group">
                     <label for="searchord">Recherche par numero de commande</label>
                         <input type="number" class="" name="searchord" >
                     </div>
 
                     <div class="form-group">
                     <label for="searchdate">Recherche par date de commande</label>
                         <input type="text" name="searchdate" placeholder="AAAA-MM-JJ">
                     </div>
 
                     
                     <div class="form-group">
                     <label for="searchprod">Nom de produit</label>
                         <input type="text" class="" name="searchprod" >
                     
                     </div>
                     <input type="submit" class="btn-submit" value="Submit">
                </fieldset>
             </form>
        </div>
        
    </div>
    <div class="half-box chaFieldsetSearchPrincipal">
        <?php
         if(isset($_POST['searchtype']) || isset($_POST['searchord']) || isset($_POST['searchdate']) || isset($_POST['searchprod'])){
            include "modules/ClassTechSAV.php";
            $mrsav = new TechSAV();
            $mrsav->searchForMe($_POST);

            }


        ?>
    </div>



</div>


    </html>