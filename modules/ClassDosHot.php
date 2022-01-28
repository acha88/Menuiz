<?php

Class TechHOTLINE {

    // Fonction qui affiche le numéro de dossier automatiquement
    public function getFolderNum(){
        $db = Connector::getInstance();
        $QueryNumDoss = $db->prepareQuery('SELECT `DSV_ID` FROM `t_d_dossier_sav_dsv` WHERE `dsv_id` order by `dsv_id` desc limit 1;');        
        $QueryNumDoss->execute();
        $varFolder = $QueryNumDoss->fetch();
        // var_dump($varFolder);
        $varFolder = intval($varFolder['DSV_ID']) ;
        // var_dump($varFolder); // pour tester
        return $varFolder = ($varFolder + 1);
    }

    // Fonction qui recherche la liste de tous les numéros de commande
    public function getOrderNum(){
        $db = Connector::getInstance();
        $QueryNumOrder = $db->prepareQuery('SELECT `OHR_ORDERNUMBER` FROM `t_d_orderheader_ohr` order by `ohr_ordernumber` DESC;');        
        $QueryNumOrder->execute();
        $result = $QueryNumOrder->fetchAll();
        return $this->createOptions($result);
    }

    // Fonction qui créé les options
    public function createOptions($param){
        foreach($param as $key) {
            foreach($key as $value => $entries) :
                echo '<option value="'.$entries.'">'.$entries.'</option>';
            endforeach;
        }
    }

    // Fonction qui enregistre les données du formulaire dans la BDD
    public function postForm($valuescoo) {
                
        $db = Connector::getInstance();
        $stmt = $db->prepareQuery("INSERT INTO t_d_dossier_sav_dsv (DSV_ETAT, DSV_TDS_ID, DSV_PRD_ID, DSV_ORH_ID, DSV_COM_DIAG_INITIAL) VALUES (? , ? , ? , ? , ? )");
        
        $stmt -> bindvalue( 1 , $valuescoo['civ'], PDO::PARAM_INT);
        $stmt -> bindvalue( 2 , $valuescoo['tdsid'], PDO::PARAM_INT);
        $stmt -> bindvalue( 3 , $valuescoo['prdid'], PDO::PARAM_INT);
        $stmt -> bindvalue( 4 , $valuescoo['orhid'], PDO::PARAM_INT);
        $stmt -> bindvalue( 5 , $valuescoo['comdiag'], PDO::PARAM_STR);
        
        $result = $stmt->execute();
        // return var_dump($stmt); // Pour tester
     
    }
    
    // Remplissage des champs automatiques
    // public function readinfo() {
    //     if (isset($_GET["value1"])) {
    //         $NumCommande = $_GET["value1"];
    //         echo $_GET["value1"].$NumCommande;
    //         var_dump($NumCommande);
    //     }
        
    //     if(isset($_POST['value1'])){
    //         $entry = $_POST['value1'];
    //         $db = Connector::getInstance();
    //         $QueryNumOrder = $db->prepare('SELECT `adr_denomination`, `adr_city` FROM `t_d_address_adr`
    //         join `t_d_orderheader_ohr` on `t_d_address_adr`.`ADR_ID` = `t_d_orderheader_ohr`.`OHR_ADR_ID_PAYMENT` 
    //         WHERE `OHR_ORDERNUMBER` = ?'); 
    //         $QueryNumOrder->bindValue(1, $entry, PDO::PARAM_STR); 
    //         $QueryNumOrder->execute();
    //         $varadr = $QueryNumOrder->fetchAll();
    //         var_dump($varadr);
    //         }
    // }

}

?>