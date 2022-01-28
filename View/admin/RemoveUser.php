<?php 
// Sofiane 24/01/2022
// echo "Supprimer un utilisateur.";
?>
<div class="form-box">
    <form class="soForm" action="index.php" method="POST">
        <fieldset>
            <!-- user to delete input -->
            <legend class="form-legend"> <?php  echo "Supprimer un utilisateur."; ?></legend>
            <div class="form-group">
            <label for="delete"> Entrez l'utilisateur à supprimer. </label>
                <input type="text" name="delete" class="form-control" id="delete" placeholder="Enter username" required><br/>
                <small>This will delete the user forever from the database</small>
            </div>
            <input type="submit" class="btn-submit" value="Envoyer">
        </fieldset>
    </form>
</div>
<?php
    if(isset($_POST['delete'])){
    // include "modules/ClassAdmin.php";
    $admin = new Administrator();
    $admin->removeUser($_POST);
    }
?>
