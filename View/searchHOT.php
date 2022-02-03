<main>
<!-- Partie code par Florent le 25/01/2022 -->
    <?php   
        include "./modules/ClassDosHot.php";
        $tech = new TechHOTLINE();
        $varFolder = $tech->getFolderNum();
        $tech->searchDos();
     
    ?>
    <section class="floSection">
        <form action="index.php" method="POST">
            <fieldset class="floFieldsetprincipal">
                <legend class="floLegend">Création de dossier : </legend>
                <fieldset class="floFieldsetDos">
                    <legend class="floLegend">Informations du dossier :</legend>  
                    <label class="floLabel" for="nomDos">Numéro de dossier : </label>
                    <input type="text" name="numDos" id="NumDossier" placeholder="<?php echo $varFolder; ?>" readonly><br>
                    <label class="flolabel" for="etat">Etat du dossier :</label>
                    <input type="text" name="etat" placeholder="En attente de récéption" readonly><br>
                    <input type="hidden" name="etatDos" value="1">
                    <label class="floLabel" for="maDate">Date &amp; Heure :</label>
                    <input type="text" name="maDate" id="maDate" value="<?php echo date('d-m-Y') . " & " . date('h:i:s') ; ?>" readonly><br>
                    <!-- <label class="floLabel" for="Objet">Objet de l'appel : </label>
                    <select name="search-type">
                        <option>Selectionner</option>
                        <option value="1">En attente de recep.</option>
                        <option value="2">Reçu</option>
                        <option value="3">Attente de Diagnostic</option>
                        <option value="4">Attente de cloture</option>
                        <option value="5">Cloturé</option>
                        <option value="6">Annulé</option>
                    </select> -->
                </fieldset>
                <fieldset class="floFieldsetDos">
                    <?php
                        // $tech->showDossier($tech->searchHot());
                    ?>
                    <legend class="floLegend">Coordonnées client : </legend>
                    <label class="floLabel" for="nom">Nom : </label>
                    <input type="text" name="nom" id="nom" placeholder="<?php
                        if(isset($_POST['query'])) {
                            $search = new TechHOTLINE();
                            $tableau = $search->searchDog($_POST['query']);    
                            echo $tableau[0]['ADR_DENOMINATION'];   
                        }
                    ?>" readonly><br>
                    <label class="floLabel" for="NumCommande">Numéro de commande : </label>
                    <input type="text" name="numCom" id="NumCommande" placeholder="<?php
                        if(isset($_POST['query'])) {
                            $search = new TechHOTLINE();
                            $tableau = $search->searchDog($_POST['query']);    
                            echo $tableau[0]['OHR_ORDERNUMBER'];   
                        }
                    ?>" readonly><br>
                    <input type="hidden" name="idCom" id="idCom" value="<?php
                        if(isset($_POST['query'])) {
                            $search = new TechHOTLINE();
                            $tableau = $search->searchDog($_POST['query']);    
                            echo $tableau[0]['OHR_ID'];   
                        }
                    ?>" readonly><br>
<!-- Partie code par Florent le 26/01/2022 -->
    <!-- <select name="NumCom" onchange=""><br>
        <option value="" >Sélectionner</option> -->
    <?php
    // $tech->getOrderNum(); 
    ?>
    <!-- <label class="floLabel" for="maCiv">Civilité :</label>
    <input type="radio" name="civ" id="mr" value="0">
    <label class="floLabel" for="maCiv">Mr</label>
    <input type="radio" name="civ" id="mme" value="1">
    <label class="floLabel" for="mme">Mme</label>
    <label class="floLabel" for="prenom">Prénom : </label>
    <input type="text" name="prenom" id="prenom"><br>
    <label class="floLabel" for="email">Email : </label>
    <input type="email" name="email" id="email" placeholder="exemple@exemple.fr"> -->
                </fieldset>
                <fieldset class="floFieldsetDos">
                    <legend class="floLegend">Produit : </legend>
                    <!-- <label class="floLabel" for="nom">Nom : </label> -->
                    <!-- <input type="text" name="tdsid" id="NomProduit" placeholder="TDS_ID"><br> -->
                    <?php 
                    if(isset($_POST['query'])) {
                        $search = new TechHOTLINE();
                        // var_dump('query');
                        $search->searchHot($_POST['query']);            
                    }
                    ?>
                    <br>
                    <label class="floLabel">Diagnostic : </label><br>
                    <textarea name="comDiag" id="" cols="70" rows="10" placeholder="Détail de l'appel du client" required></textarea>
                </fieldset>
                <div>
                    <input class="floButton" type="reset" value="Remise à zéro" />
                    <button class="floButton" type="submit">Créer le dossier</button>
                        <?php 
                            if(isset($_POST['etatDos']) && isset($_POST['produit']) && isset($_POST['idCom']) && isset($_POST['comDiag'])) {
                            $hot = new TechHOTLINE();
                            $hot->postForm($_POST);
                            if (count($_POST)>0) echo "<script type='text/javascript'>alert('Le dossier a bien été créé');</script>";
                        }
                        ?>
                </div>
            </fieldset>    
        </form>
    </section>
</main>