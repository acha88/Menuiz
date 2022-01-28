<?php
//  CHARLOTTE 24/01/2022 ; 25/01/2022 ; 26/01/2022 ; 27/01/2022
class DossierSAV {
    public function showDossier($datas){  
        foreach($datas as $datas){
            echo "<div class='_folderHotlineE'>";
            echo '<h3 class="title_folderHotline">Ticket : </h3>';
            echo '<p class="p_folderHotline"> Numéro de commande : ' .$datas['OHR_ORDERNUMBER'].'</p><br>';
            echo '<p class="p_folderHotline"> Date : ' .$datas['OHR_DATE'].'</p><br>';
            echo '<p class="p_folderHotline"> Nom du client : ' .$datas['ADR_DENOMINATION'].'</p><br>';
            echo '<p class="p_folderHotline"> Nom du produit : ' .$datas['PRD_DESIGNATION'].'</p><br>';
            echo '<p class="p_folderHotline"> Diagnostic : ' .$datas['DSV_COM_DIAG_INITIAL'].'</p><br>';
            echo '<p class="p_folderHotline"> Statut : ' .$datas['TDS_TYPE'].'</p><br>';                  
            echo "</div>";
        }
        
    }
    // CHARLOTTE 25/01/2022
    // TABLEAU OK
    // fonction de recherche par type de diagnotic
    public function getTypeDiag($param){
        $db = Connector::getInstance();
        $sql = 'SELECT * FROM t_d_dossier_sav_dsv AS dsv
        JOIN type_dossier_tds as TDS on DSV.DSV_ID = TDS.TDS_ID
        JOIN t_d_product_prd as PRD on DSV.DSV_PRD_ID = PRD.PRD_ID
        JOIN t_d_orderheader_ohr AS OHR ON DSV.DSV_ORH_ID = OHR.OHR_ID
        JOIN t_d_address_adr AS ADR ON OHR.OHR_ADR_ID_PAYMENT = ADR.ADR_ID	
        WHERE DSV_COM_DIAG_INITIAL LIKE ?';
        $req = $db->prepareQuery($sql);
        $req->bindValue(1, $param.'%', PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetchAll();
        return $this->showDossier($result);
    }

    // CHARLOTTE 26/01/2022
    /* affichage par numero de commande ou facture */
    public function getNumCmd($param) {
        $db = Connector::getInstance();
        $numCmdFct = 'SELECT OHR_DATE, OHR_ORDERNUMBER, OHR_TOTALHT, OHR_TOTALTTC FROM t_d_orderheader_ohr WHERE OHR_ORDERNUMBER';
        $val = (string)strip_tags($param);     
        $query = $db->prepareQuery($numCmdFct);
        $query->bindValue(1, $val, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();
        return $this->showDossier($result);
    }

    // CHARLOTTE 27/01/2022
    /* affichage par dénomination du client */
    public function getNameCustomer($param) {

    }

    // CHARLOTTE 24/01/2022
    /* affichage des produits par recherche du nom (designation) */
    public function getProductName($param) {
        $db = Connector::getInstance();
        $searchProd = 'SELECT ADR_DENOMINATION FROM t_d_address_adr LIKE ?';
        $val = (string)strip_tags($param);     
        $query = $db->prepareQuery($searchProd);
        $query->bindValue(1, $val, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();
        return $this->showDossier($result);
    }
}
?>