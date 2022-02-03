<?php
//  SOFIANE 20/01/2022
class TechSAV {
    // fonction d'affichage des mini formulaires 
    //  SOFIANE 20/01/2022
    public function showInitial($data){
        // echo "<div class='half-box'>";
        foreach($data as $dataRows){
            echo "<H4 class='folder-title'>Dossier non traité </H4>";
            echo '<form action="" method="POST">'; 
            echo " <input type='text' name='getorhnum' class='form-fold' value='".$dataRows['OHR_ORDERNUMBER']."' readonly>" ;
            echo " <input type='text' name='getorhdate' class='form-fold' value='".$dataRows['OHR_DATE']."' readonly>" ;
            echo " <input type='text' name='getdiag' class='form-fold' value='".$dataRows['DSV_COM_DIAG_INITIAL']."' readonly>" ;
            echo " <input type='text' name='getsavid' class='form-fold hidden' value='".$dataRows['DSV_ID']."' readonly>";
            echo " <input type='text' name='gettdsid' class='form-fold hidden' value='".$dataRows['DSV_TDS_ID']."' readonly>";
            echo " <input type='text' name='getprdid' class='form-fold hidden' value='".$dataRows['DSV_PRD_ID']."' readonly>";
            echo " <input type='text' name='getorhid' class='form-fold hidden' value='".$dataRows['DSV_ORH_ID']."' readonly>";
            echo "<input type='submit' class='btn-submit' value='submit'><br/>";
            echo "</form>";
            echo '<form action="" method="POST">';
            echo " <input type='text' name='gethistory' class='form-fold hidden' value='".$dataRows['DSV_ID']."' readonly>";
            echo "<input type='submit' class='btn-historic' value='Historique'><br/>";
            echo "</form>";
            // echo "</div>";      
            // echo $data[''];            
                // DSV_TDS_ID   DSV_PRD_ID	DSV_ORH_ID
        }
        // echo "</div>";
    }
    // function d'affichage de la data des mini formulaire en classant les dossier SAV qui n'ont pas été traité
    //  SOFIANE 26/01/2022
    public function getNotTreated(){
        $sql = 'SELECT * FROM T_D_dossier_sav_DSV AS DSV
                JOIN type_dossier_tds as TDS on DSV.DSV_ID = TDS.TDS_ID
                JOIN t_d_product_prd as PRD on DSV.DSV_PRD_ID = PRD.PRD_ID
                JOIN t_d_orderheader_ohr AS OHR ON DSV.DSV_ORH_ID = OHR.OHR_ID
                WHERE DSV.DSV_ETAT < 1 ORDER BY DSV.DSV_ID ASC';
        $db = Connector::getInstance();
        $query = $db->prepareQuery($sql);        
        $query->execute();
        $result = $query->fetchAll();
        return $this->showInitial($result);  
    }
    // function d'affichage ave details d'un dossier non traité allant de paire avec la function printFolders
    //  SOFIANE 21/01/2022
    public function printSAVFolder($post){
        $db = Connector::getInstance();
        $savID = intVal($post['getsavid'], 10); 
        $query = $db->prepareQuery('SELECT * from t_d_dossier_sav_dsv as DSV
                                    JOIN type_dossier_tds as TDS on DSV.DSV_ID = TDS.TDS_ID
                                    JOIN t_d_product_prd as PRD on DSV.DSV_PRD_ID = PRD.PRD_ID
                                    JOIN t_d_orderheader_ohr AS OHR ON DSV.DSV_ORH_ID = OHR.OHR_ID
                                    WHERE DSV.DSV_ID = ?');
        $query->bindValue(1, $savID, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();
        return $this->printFolders($result);
        // return var_dump($_POST);
    }
    // function d'imprimerie du code HTML
    //  SOFIANE 26/01/2022
    // last update SOFIANE 01/02/2022
    public function printFolders($data){
        // print sizeof($data);
        // echo "<div class=''>";
        foreach($data as $datas){
            echo "<div class=''>";
            echo '<form class="form-box" action="" method="POST">';
            echo '<div class="form-box padding">';
            echo "<legend class='form-legend'>Dossier Selectionné: ". $datas['OHR_ORDERNUMBER']."</legend>";
            // commentaire initial
            echo "<div class='form-group2'>";
            echo "<label for='commentaireinitial'>COMMENTAIRE INITIAL</label>";
            echo "<textarea rows='5' cols='33' name='commentaireinitial' class='form-fold' value='' readonly>".$datas['DSV_COM_DIAG_INITIAL']."</textarea><br/>";
            echo "</div>";          
            // commentaire final
            echo "<div class='form-group2'>";
            echo "<label for='commentairefinal'>COMMENTAIRE FINAL: </label>";
            echo "<textarea rows='5' cols='33' name='commentairefinal' class='form-fold dark' required></textarea><br/>";
            echo "</div>";
            //type dossier
            echo "<div class='form-group2'>";
            echo "<label for='typedossier'>TYPE DE DOSSIER: </label>";
            echo "<select name='typedossier' class='form-fold dark'>";
            echo "<option value='".$datas['TDS_ID'] ."'>".$datas['TDS_TYPE']."</option>";
            echo "<option value='1'>En attente de recep.</option>";
            echo "<option value='3'>Attente de diagnostic</option>";
            echo "<option value='4'>Attente de clôture</option>";
            echo "<option value='5'>Clôturé</option>";
            echo "<option value='6'>Annulé</option>";
            echo "</select><br/>";
            echo "</div>";
            // ref produit
            echo "<div class='form-group2'>";
            echo "<label for='referenceprd'>REFERENCE PRODUIT : </label>";
            echo "<input type='text' name='referenceprd' class='form-fold' value='".$datas['PRD_REFERENCE']."' readonly><br/>";
            echo "</div>";
            // supplier
            echo "<div class='form-group2'>";
            echo "<label for='supplierprd'>FOURNISSEUR PRODUIT : </label>";
            echo "<input type='text' name='supplierprd' class='form-fold' value='".$datas['PRD_SUPPLIER']."' readonly><br/>";
            echo "</div>";
            // DESIGNATION PRODUIT
            echo "<div class='form-group2'>";
            echo "<label for='supplierprd'>DESIGNATION PRODUIT : </label>";
            echo "<input type='text' name='designprd' class='form-fold' value='".$datas['PRD_DESIGNATION']."' readonly><br/>";
            echo "</div>";
            // FAMILLE DU PRODUIT
            echo "<div class='form-group2'>";
            echo "<label for='familleprd'> FAMILLE DU PRODUIT : </label>";
            echo "<input type='text' name='familleprd' class='form-fold' value='".$datas['PRD_FAMILY']   ."' readonly><br/>";
            echo "</div>";
            //-- TODO fix right column to call --
            echo "<div class='form-group2'>";
            echo "<label for='descprd'> DESCRIPTION DU PRODUIT : </label>";
            echo "<input type='text' name='descprd' class='form-fold' value='".$datas['PRD_FAMILY']   ."' readonly><br/>";
            echo "</div>";
            // garantie
            echo "<div class='form-group2'>";
            echo "<label for='warrantprd'> GARANTIE : </label>";
            echo "<input type='text' name='warrantprd' class='form-fold' value='".$datas['PRD_GUARANTEE']."' readonly><br/>";
            echo "</div>";
            // image --- TO DO --- on hold.
            //echo "<p class='folder-info'> IMAGE DU PRODUIT: ".$datas['PRD_IMAGE_URL']."</p><br/>";
            //echo "<label for='imgprd'> IMAGE DU PRODUIT : </label>";
            //echo "<input type='text' name='imgprd' class='form-fold' value='".$datas['PRD_IMAGE_URL']."' readonly><br/>";
            // date
            echo "<div class='form-group2'>";
            echo "<label for='orderdate'> DATE DE COMMANDE : </label>";
            echo "<input type='text' name='orderdate' class='form-fold' value='".$datas['OHR_DATE']."' readonly><br/>";
            echo "</div>";
            // numero de commande
            echo "<div class='form-group2'>";
            echo "<label for='cmdnumber'> NUMERO DE COMMANDE : </label>";
            echo "<input type='text' name='cmdnumber' class='form-fold' value='".$datas['OHR_ORDERNUMBER']."' readonly><br/>";
            echo "</div>";
            //echo "<p class='folder-info'> NUMERO DE TELEPHONE DU CLIENT: ".$datas['OHR_DELIVERYPHONE']."</p><br/>";
            // numero client
            echo "<div class='form-group2'>";
            echo "<label for='numeroclient'>  NUMERO DE TELEPHONE DU CLIENT : </label>";
            echo "<input type='text' name='numeroclient' class='form-fold' value='".$datas['OHR_DELIVERYPHONE']."' readonly><br/>";
            echo "</div>";    
            // ETAT traité ou non traité
            echo "<div class='form-group2'>";
            echo "<input type='checkbox' name='treated' value='1' >";
            echo '<label for="treated">Souhaitez-vous clôre ce dossier ? </label> <br/>'; 
            echo "</div>";
            // Submit
            echo "<input type='submit' class='btn-submit' value='Mettre à jour'>";
            //<input type="submit" class="btn-submit" value="Submit">
            echo "<input type='number' name='dossierid' class='hidden' value='".$datas['DSV_ID']."' readonly>";
            echo '</div>';
            echo '</form>';
            echo "</div>";
            echo "<hr>";
            // echo '<?php if(isset($_POST["dossierid"])){
            //     $mrsav2 = new TechSAV();
            //     $mrsav2->updateFolder($_POST);    
        }
    }
    /////////////////////////////////////////////////////////////
    // function pour aller rechercher les dossiers par type
    // SOFIANE 20/01/2022
    public function searchByType($post){
        $db = Connector::getInstance();
        $query = $db->prepareQuery('SELECT * from t_d_dossier_sav_dsv as DSV
                                    JOIN type_dossier_tds as TDS on DSV.DSV_ID = TDS.TDS_ID
                                    JOIN t_d_product_prd as PRD on DSV.DSV_PRD_ID = PRD.PRD_ID
                                    JOIN t_d_orderheader_ohr AS OHR ON DSV.DSV_ORH_ID = OHR.OHR_ID
                                    WHERE TDS.TDS_ID = ?'); 
        $val = intVal($post['foldertype'], 10);
        $query->bindValue(1, $val, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();
        return $this->printFolders($result);
    }
    /////////////////////////////////////////////////////////
    // SOFIANE 01/02/20222
    public function updateFolder($parampost){
        $db = Connector::getInstance();
        // definition de la valeur traité par défaut à 0;
        $val = 0;
        if(isset($parampost['treated'])){
            $val = $parampost['treated']; 
        }
        $query = $db->prepareQuery('UPDATE t_d_dossier_sav_dsv
                                    SET DSV_COM_DIAG_TERM = ?,
                                        DSV_TDS_ID = ?,
                                        DSV_ETAT = ?
                                    WHERE DSV_ID = ?');
        $query->bindValue(1, $parampost['commentairefinal'], PDO::PARAM_STR);                
        $query->bindValue(2, intval($parampost['typedossier'], 10), PDO::PARAM_INT);
        $query->bindValue(3, intval($val, 10), PDO::PARAM_INT);
        $query->bindValue(4, intval($parampost['dossierid'], 10), PDO::PARAM_INT);
        $query->execute();
        $this->insertStoryUpdate($parampost['dossierid']);
        // return var_dump($query);
        $count = $query->rowCount();
        if ($count > 0) {
           return print '<div class="half-box" ><p class="success"> Dossier mis à jour avec succès ! </p></div>';
        } else {
           return print '<div class="half-box" ><p class="warning"> Le dossier n\'a pas pu être modifié, veuillez verifier les données que vous avez entré sinon veuillez contacter l\'administrateur (voir haut de page).</p></div>';
        }
    }
    ///////////////////////////////////////////////////////////////////////////////
    // function de recherche avec possibilité d'avoir plusieurs arguments de recherche
    //  SOFIANE 26/01/2022
    // LAST UPDATE WITH FIXES 
    // 01/02/2022 SOFIANE
    public function searchForMe($post){
        $db = Connector::getInstance();
            $stack = array();
            if(!empty($post['searchtype'])){
                $val = intVal($post['searchtype'], 10);
                $first = " TDS.TDS_ID LIKE ".intval($val);
                array_push($stack, $first);
            }
            if(!empty($post['searchord'])){                
                $second = " OHR.OHR_ORDERNUMBER LIKE '".$post['searchord']."%'";
                array_push($stack, $second);
            }
            if(!empty($post['searchdate'])){ 
                $date = $post['searchdate'];      
                $third = " OHR.OHR_DATE LIKE "."'".$date."%'";
                // DATE_FORMAT("2018-09-24", "%d/%m/%Y")
                array_push($stack, $third);
            }
            if(!empty($post['searchprod'])){                
                $fourth = " PRD.PRD_DESIGNATION LIKE "."'%".$post['searchprod']."%'";
                array_push($stack, $fourth);
            }
            $count = sizeOf($stack);
            $sqlBind = "";
            //--------------------------
            if($count == 1){
                // if (DateTime::createFromFormat('Y-m-d', $sqlBind) !== false) {
                //     $sqlBind = DateTime::createFromFormat('Y-m-d', $sqlBind);
                //     // DateTime::createFromFormat('Y-m-d H:i:s', $myString)
                // } 
                // if(is_numeric($stack[0]) && strlen((string)$stack[0]) > 1){
                //     $sql
                // }
                // else
                if(is_numeric($stack[0]) && strlen((string)$stack[0]) <= 1){               
                        $sqlBind = intVal($stack[0], 10);
                } else {
                $sqlBind = $stack[0];
                }
            }
            if($count > 1){
                $sqlBind = implode(" AND ", $stack);
            }
            $sql = 'SELECT * from t_d_dossier_sav_dsv as DSV
                    JOIN type_dossier_tds as TDS on DSV.DSV_ID = TDS.TDS_ID
                    JOIN T_D_ORDERHEADER_OHR AS OHR ON DSV.DSV_ORH_ID = OHR.OHR_ID
                    JOIN T_D_ORDERDETAIL_ODT AS ODT ON ODT.ODT_OHR_ID = OHR.OHR_ID
                    JOIN T_D_PRODUCT_PRD AS PRD ON ODT.ODT_PRD_ID = PRD.PRD_ID;
                    WHERE'."$sqlBind";
            $query = $db->prepareQuery($sql);
            $query->execute();
            $result = $query->fetchAll();
            $count = $query->rowCount();
            if($count > 0){
                return $this->printFolders($result);
                // return var_dump($sql);
            }else{
                echo "<p class='warning'>aucun resultats trouvé.</p>";
            }
    }
    // SOFIANE 02/02/2022
    // function d'insert de l'historique à la création de dossier;
    // preparée mais inutilisée car l'insertion de dossier SAV n'est pas terminée
    // et se trouve sur le travail d'une autre personne dans l'equipe.
    // ce qui nécéssitera une readaptation.
    private function insertStoryCreation($param){
        $db = Connector::getInstance();
        $queryHistory = $db->prepareQuery('INSERT INTO  T_D_HISTORY_SAV_HSV (HSV_DSV_ID, HSV_LIBELLE, HSV_USERNAME)
                                            VALUES( ? ,"CREATION", ?)');
        $queryHistory->bindValue(1, $param, PDO::PARAM_INT); 
        $queryHistory->bindValue(2, $_SESSION['LOGGED_USER'], PDO::PARAM_STR); 
        $queryHistory->execute();
    }
    // SOFIANE 02/02/2022
    // function d'insert de l'historique à la modification du dossier;
    private function insertStoryUpdate($param){
        $db = Connector::getInstance();
        $queryHistory = $db->prepareQuery('INSERT INTO T_D_HISTORY_SAV_HSV (HSV_DSV_ID, HSV_LIBELLE, HSV_USERNAME)
                                            VALUES( ? ,"MODIFICATION", ?)');
        $queryHistory->bindValue(1, $param, PDO::PARAM_INT); 
        $queryHistory->bindValue(2, $_SESSION['LOGGED_USER'], PDO::PARAM_STR); 
        $queryHistory->execute();
    }
    // SOFIANE 02/02/2022
    // function d'imprimerie de l'historique
    private function printStory($param){
        echo "<div class='half-box shadow padding'>";
        echo "<div class='field-form padding'>";
        foreach($param as $data){
            echo "<h3 class='form-legend'>Numero de dossier : ".$data['DSV_ID']."</h3>";
            echo "<p>Libelle : ".$data['HSV_LIBELLE'].".</p>";
            echo "<p>DATE : ".$data['DATE'].".</p>";
            echo "<p>Utilisateur : ".$data['HSV_USERNAME'].".</p>";
        }
        echo "</div>";
        echo "</div>";
    }
    // SOFIANE 02/02/2022
    // function pour aller chercher la data de l'historique et renvoyer la function d'imprimerie.
    public function getStory($param){
        $db = Connector::getInstance();
        $query = $db->prepareQuery('SELECT * FROM T_D_HISTORY_SAV_HSV AS HSV
                                    JOIN T_D_DOSSIER_SAV_DSV AS DSV ON HSV.HSV_DSV_ID = DSV.DSV_ID
                                    WHERE HSV.HSV_DSV_ID = ?');
        $query->bindValue(1, intval($param['gethistory']), PDO::PARAM_INT); 
        $query->execute();
        $result = $query->fetchAll();
        return $this->printStory($result);
    }
}
?>