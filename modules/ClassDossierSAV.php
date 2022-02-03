<?php
//  CHARLOTTE 24/01/2022 => 02/02/2022
class DossierSAV {
    public function showDossier($data){  
        foreach($data as $datas){
            echo "<div class='_folderHotline'>";
            echo '<h3 class="title_folderHotline">Ticket</h3>';
            echo '<hr>';
            echo '<br>';
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
        JOIN type_dossier_tds as TDS on DSV.DSV_TDS_ID = TDS.TDS_ID
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
        $num = 'SELECT * FROM t_d_dossier_sav_dsv AS dsv
        JOIN type_dossier_tds as TDS on DSV.DSV_TDS_ID = TDS.TDS_ID
        JOIN t_d_product_prd as PRD on DSV.DSV_PRD_ID = PRD.PRD_ID
        JOIN t_d_orderheader_ohr AS OHR ON DSV.DSV_ORH_ID = OHR.OHR_ID
        JOIN t_d_address_adr AS ADR ON OHR.OHR_ADR_ID_PAYMENT = ADR.ADR_ID	
        WHERE OHR.OHR_ORDERNUMBER LIKE ?';
        $val = (string)strip_tags($param);    
        $query = $db->prepareQuery($num);
        $query->bindValue(1, $param.'%', PDO::PARAM_STR);
        $query->execute();
        $resultat = $query->fetchAll();
        return $this->showDossier($resultat);
    }
    // CHARLOTTE 02/02/2022
    /* affichage par dénomination du client */
    public function getNameCustomer($param) {
        $db = Connector::getInstance();
        $name = 'SELECT * FROM t_d_dossier_sav_dsv AS dsv
        JOIN type_dossier_tds as TDS on DSV.DSV_TDS_ID = TDS.TDS_ID
        JOIN t_d_product_prd as PRD on DSV.DSV_PRD_ID = PRD.PRD_ID
        JOIN t_d_orderheader_ohr AS OHR ON DSV.DSV_ORH_ID = OHR.OHR_ID
        JOIN t_d_address_adr AS ADR ON OHR.OHR_ADR_ID_PAYMENT = ADR.ADR_ID
        WHERE ADR.ADR_DENOMINATION LIKE ?';    
        $query = $db->prepareQuery($name);
        $query->bindValue(1, $param.'%', PDO::PARAM_STR);
        $query->execute();
        $rep = $query->fetchAll();
        return $this->showDossier($rep);
    }
    // CHARLOTTE 02/02/2022
    /* affichage des produits par recherche du nom (designation) */
    public function getProductName($param) {
        $db = Connector::getInstance();
        $searchProd = 'SELECT * FROM T_D_DOSSIER_SAV_DSV as DSV
        JOIN type_dossier_tds as TDS on DSV.DSV_TDS_ID = TDS.TDS_ID
        JOIN T_D_ORDERHEADER_OHR AS OHR ON DSV.DSV_ORH_ID = OHR.OHR_ID
        JOIN T_D_ORDERDETAIL_ODT AS ODT ON ODT.ODT_OHR_ID = OHR.OHR_ID
        JOIN T_D_PRODUCT_PRD AS PRD ON ODT.ODT_PRD_ID = PRD.PRD_ID
        JOIN t_d_address_adr AS ADR ON OHR.OHR_ADR_ID_PAYMENT = ADR.ADR_ID
        WHERE PRD.PRD_DESIGNATION LIKE ?';    
        $query = $db->prepareQuery($searchProd);
        $query->bindValue(1, $param.'%', PDO::PARAM_STR);
        $query->execute();
        $reponse = $query->fetchAll();
        return $this->showDossier($reponse);
    }
}
?>