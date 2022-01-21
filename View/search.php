<!-- Partie code par Charlotte le 19/01/2022 -->
    <main>
        <!-- code php ; récupération et affichage de la recherche -->
        <section>
            <form class="formSearch" method="POST" action="">
                <fieldset class="fieldSearch">
                    <label for="">Recherche par BL, LF, OL : </label>
                    <input type="text" name="recherche">
                </fieldset>
                <fieldset>
                    <label for="">Numéro de commande ou facture : </label>
                    <input type="text" name="recherche">
                </fieldset>
                <fieldset>
                <label for="">Dénomination Client : </label>
                    <input type="text" name="recherche">
                </fieldset>
                <fieldset class="fieldSearch">
                    <label for="">Recherche par produit : </label>
                    <input type="text" name="recherche">
                </fieldset>
                <fieldset>
                    <input class="btnSearch" type="submit" value="Rechercher" id="Envoyer">
                    <input class="btnSearch" type="reset" value="Effacer">
                </fieldset>
            </form>
        </section>
        <section>
            <div id="affichage">
                <div class="card_">
                    <div class="card_head"> Numéro de dossier :  </div>
                </div>
            </div>
        </section>
    </main>
    <!-- <script src="principal.js"></script> -->