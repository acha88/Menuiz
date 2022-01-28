<main>
<!-- Partie code par Florent le 25/01/2022 -->
    <?php   
        include "./modules/ClassDosHot.php";
        $tech = new TechHOTLINE();
        $varFolder = $tech->getFolderNum();
    ?>
    <section class="floSection">
        <form action="index.php" method="POST">
            <fieldset class="floFieldsetprincipal">
                <legend class="floLegend">Création de dossier : </legend>
                <fieldset class="floFieldsetInfo">
                    <legend class="floLegend">Informations du dossier : </legend>   
                    <label class="floLabel" class="floLabel" for="nom">Numéro de dossier : </label>
                    <input type="text" name="nom" id="NumDossier" placeholder="<?php echo $varFolder; ?>" readonly><br>
                    <label class="floLabel" for="maDate">Date &amp; Heure :</label>
                    <input type="text" name="maDate" id="maDate" value="<?php echo date('d-m-Y') . " & " . date('h:i:s') ; ?>" readonly><br>
                    <label class="floLabel" for="Objet">Objet de l'appel : </label>
                    <select id="Objet">
                        <option>Réparation</option>
                        <option>Demande d'échange</option>
                        <option>Réclamation</option>
                        <option>Autre</option>
                    </select>
                </fieldset>
            
                <fieldset class="floFieldsetCoo">
                    <legend class="floLegend">Coordonnées client : </legend>
                    <label class="floLabel" for="NumCommande">Numéro de commande : </label>
<!-- Partie code par Florent le 26/01/2022 -->
                    <select name="NumCom" onchange=""><br>
                    <option value="" >Sélectionner</option>
                        <?php
                        $tech->getOrderNum(); 
                        ?>
                    <label class="floLabel" for="maCiv">Civilité :</label>
                    <input type="radio" name="civ" id="mr" value="0">
                    <label class="floLabel" for="maCiv">Mr</label>
                    <input type="radio" name="civ" id="mme" value="1">
                    <label class="floLabel" for="mme">Mme</label>
                    <br>
                    <label class="floLabel" for="nom">Nom : </label>
                    <input type="text" name="nom" id="nom" >
                    <label class="floLabel" for="prenom">Prénom : </label>
                    <input type="text" name="prenom" id="prenom"><br>
                    <label class="floLabel" for="email">Email : </label>
                    <input type="email" name="email" id="email" placeholder="exemple@exemple.fr">
                </fieldset>
                <fieldset class="floFieldsetPro">
                    <legend class="floLegend">Produit : </legend>
                    <label class="floLabel" for="nom">Nom : </label>
                    <input type="text" name="tdsid" id="NomProduit" placeholder="TDS_ID"><br>
                    <label class="floLabel" for="nom">Type : </label>
                    <input type="text" name="prdid" id="TypeProduit" placeholder="PRD_ID"><br>
                    <label class="floLabel" for="nom">Référence : </label>
                    <input type="number" name="orhid" id="RefProduit" placeholder="ORH_ID">
                    <!-- <input type="number" name="" id="PrixProduit" placeholder="Prix"> -->
                    <br>
                    <label class="floLabel">Description : </label><br>
                    <textarea name="comdiag" id="" cols="70" rows="10" placeholder="Détail de l'appel du client"></textarea>
                </fieldset>
                <div>
                    <input class="floButton" type="reset" value="Remise à zéro" />
                    <button class="floButton" type="submit">Envoyer le formulaire</button>
                        <?php 
                            if(isset($_POST['civ']) && isset($_POST['tdsid']) && isset($_POST      ['prdid']) && isset($_POST["orhid"]) && isset($_POST['comdiag'])) {
                            $hot = new TechHOTLINE();
                            $hot->postForm($_POST);
                            }
                        ?>
                </div>
            </fieldset>    
        </form>
    </section>
<!-- Partie code par Charlotte le 19/01/2022 -->
<!-- code php ; récupération et affichage de la recherche -->
    <section class="chaSection">
        <form method="POST" action="">
                <fieldset class="chaFieldsetSearchPrincipal">
                    <legend class="chaLegend">Rechercher un dossier :</legend>
                    <fieldset class="chaFieldsetSearch">
                    <label for="">Par type de diagnostic : </label>
                    <input type="text" name="typeDiag">
                    <input class="btnSearch" type="submit" value="Rechercher">
                </fieldset>
                <fieldset class="chaFieldsetSearch">
                    <label for="">Par numéro de commande ou facture : </label>
                    <input type="text" name="numCmd">
                    <input class="btnSearch" type="submit" value="Rechercher">
                </fieldset>
                <fieldset class="chaFieldsetSearch">
                    <label for="">Par dénomination client : </label>
                    <input type="text" name="recherche">
                    <input class="btnSearch" type="submit" value="Rechercher">
                </fieldset>
                <fieldset class="chaFieldsetSearch">
                    <label for="">Par nom de produit : </label>
                    <input type="text" name="productName">
                    <input class="btnSearch" type="submit" value="Rechercher">
                </fieldset>
            </fieldset>
        </form>
    </section>
</main>