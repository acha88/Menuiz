<!-- Partie code par Charlotte le 19/01/2022 -->
<header>
        <nav>
            <h3><?php echo "Utilisateur : ".$_SESSION['LOGGED_USER']; ?> </h3>
            <a href="index.php">Accueil</a>
            <!-- TO DO <a href="view/expedition.php">Expédition</a>
            <a href="view/sav.php">SAV</a> -->
            <?php
            // sofiane 27/01/2022
            if($_SESSION['type_user'] === 'Technicien SAV') {
                echo "<a href='search.php'>Recherche des dossiers</a>";
            }
            // fin sofiane
            if($_SESSION['type_user'] === 'Technicien HOTLINE') {
                echo "<a href='searchHOTLINE.php'>Recherche des tickets</a>";
            }
            ?>
            <a href="logout.php">Deconnexion </a>
            <img class="logo headLogo" src="img\MenuizMan_logo.png" alt="logo">
        </nav>
</header