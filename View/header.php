<!-- Partie code par Charlotte le 19/01/2022 -->
<header>
        <nav>
            <img class="logo headLogo" src="img\MenuizMan_logo.png" alt="logo">
            <h3><?php echo "Utilisateur : ".$_SESSION['LOGGED_USER']; ?> </h3>
            <a href="index.php">Accueil</a>
            <a href="view/expedition.php">Expédition</a>
            <a href="view/sav.php">SAV</a>
            <a href="logout.php">Deconnexion </a>
        </nav>
</header>