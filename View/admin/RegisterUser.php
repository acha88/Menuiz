<!-- <div class="box-container"> -->

    <?php 
        // Sofiane 24/01/2022
            
    ?>

<div class="form-box">
        <form class="soForm" action="index.php" method="POST">
            <fieldset>
                <legend class="form-legend"><?php echo "Enregistrer un nouvel utilisateur."; ?></legend>
             <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
            <!-- username input -->
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
             </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
            <!-- password input -->
                <input type="text" class="form-control" id="pwd" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="mail">Mail</label>
            <!-- mail input2 -->
                <input type="text" class="form-control" id="mail" name="mail" placeholder="adresse mail" required>
            </div>
            <div class="form-group">
                <label for="usertype">Type de l'utilisateur.</label>
            <!-- mail input2 -->
                <select name="usertype" required>
                        <option value="4">Admin</option>
                        <option value="5">SAV</option>
                        <option value="6">HOTLINE</option>
                </select>
            </div>
            <input type="submit" class="btn-submit" value="Envoyer">
            </fieldset>
     </form>
</div>
    <?php 
         if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['mail']) && isset($_POST['usertype'])){

            $admin2 = new Administrator();
            $admin2->registerUser($_POST);
                        
        }      
        
    ?>
