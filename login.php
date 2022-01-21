<?php 
// SOFIANE 20/01/2022 
       session_start();   
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Login</title>
    </head>
<body>
    <nav>
        <img src="img\MenuizMan_logo.png" alt="logo">
        <h2>Connectez-vous</h2>   
        <a class="titleRegister" href="register.php">Contacter l'administrateur</a>            
    </nav>
    <!-- // SOFIANE 20/01/2022 -->
    <section class="formLogin">
        <form action="" method="POST">
                <!-- username   -->
                <label for="username">Email : </label>
                <input class="inputLogin" type="text" name="username" class="form-control" id="username" placeholder="Entrer votre email">     
                <!-- password  -->
                <label for="password">Password :</label>
                <input class="inputLogin" type="password" class="form-control" id="pwd" name="password" placeholder="Entrer votre mot de passe">
                <!-- submit -->
                <input type="submit" class="btnLogin" value="Se connecter">
                <br>
                <small class="smallLogin">Ne partagez jamais vos identifiants de connexion.</small>
        </form>
    </section>
    <div>
        <?php
    // SOFIANE 20/01/2022 
    // TO DO - PASSWORD CHECK (déjà préparé dans la classe);
    // enregistrement de l'username en session
        if (isset($_POST['username']) && isset($_POST['password'])) { 
                include "modules/classConnector.php";
                include "modules/ClassUser.php";
                $user = new User();
                $user->setUsername($_POST['username']);
                $user->setPassword($_POST['password']);
                //  print $_POST['username'];
                //  print $_POST['password'];
                $check = $user->checkName();
                $type = $user->returnType();
                //         $_SESSION['test'] = $type;
                // var_dump($_SESSION['test']);
                // $bob = $user->checkType();
                // print $bob['typ_type'];
                if ($check == 1) {
                    $_SESSION['LOGGED_USER'] = $_POST['username'];
                    $_SESSION['password'] = $_POST['password'];
                    $_SESSION['allow'] = 'yes';
                    $type = $user->returnType();
                    $_SESSION['type_user'] = $type['typ_type'];
                    // print ;
                    // print $_SESSION['usertype'];
                    header("Location: index.php");             
                } else {                        
                    print "<h4 class='btn btn-warning'>Une erreur a été omise lors de votre tentative de connexion, veuillez recommencer !</h4>";
                }
            } 
        ?>
    </div>
    <?php
    include "view/footer.php";
    ?>
</body>
</html>