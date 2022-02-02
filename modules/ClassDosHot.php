<?php

Class TechHOTLINE {

    // PArtie code par Florent le 01/02/2022
    // Fonction d'affichage des résultats de la recherche d'un dossier SAV
    public function showProduct($results){   
            echo '<table>';
            echo '<tr>';
            echo '<th></th><th>Nom</th><th>Référence</th><th>Type</th>';
            echo '</tr>';
        foreach($results as $data){
            echo '<tr>';
            echo '<th><input type="radio" name="produit" value="'.$data['ODT_ID'].'"></th>';
            echo '<td>' .$data['PRD_DESCRIPTION'].'</td>';
            echo '<td>' .$data['PRD_REFERENCE'].'</td>';
            echo '<td>' .$data['PRD_DESIGNATION'].'</td>';
            echo '</tr>';
        }
            echo '</table>';

    }


    // Fonction qui affiche le numéro de dossier automatiquement
    public function getFolderNum(){
        $db = Connector::getInstance();
        $QueryNumDoss = $db->prepareQuery('SELECT `DSV_ID` FROM `t_d_dossier_sav_dsv` WHERE `dsv_id` order by `dsv_id` desc limit 1;');        
        $QueryNumDoss->execute();
        $varFolder = $QueryNumDoss->fetch();
        // var_dump($varFolder);
        $varFolder = intval($varFolder['DSV_ID']) ;
        // var_dump($varFolder); // pour tester
        $varFolder = ($varFolder + 1);     
        return $varFolder;   
    }

        // PArtie code par Florent le 01/02/2022
    // Fonction affichage de la recherche par numéro de téléphone
    public function searchDos() {       
        echo '<form action="" method="POST">';
        echo '<fieldset class="floFieldsetInfo">';
        echo '<legend class="floLegend">Recherche d\'un dossier : </legend>';
        echo '<label class="floLabel" for="nom">Numéro de téléphone : </label>';
        echo '<input type="text" name="query" required>';
        echo '<input class="floButton" type="submit" value="Recherche"/>';
        echo '</fieldset>';
        echo '</form><br>';
    }

       // Partie code par Florent le 31/01/2022
    // Fonction de recherche par numéro de téléphone pour afficher les produits.
    public function searchHot($query){
        $db = Connector::getInstance();
        $QuerySearch = $db->prepareQuery("SELECT `ODT_ID`, `PRD_REFERENCE`, `PRD_DESIGNATION`, `PRD_DESCRIPTION` FROM `t_d_orderheader_ohr` AS OHR
        JOIN `t_d_address_adr` AS ADR ON OHR.OHR_ADR_ID_PAYMENT = ADR.ADR_ID
        JOIN `t_d_orderdetail_odt` AS ODT ON ODT.ODT_OHR_ID = OHR.OHR_ID
        JOIN `t_d_product_prd` AS PRD ON ODT.ODT_PRD_ID = PRD.PRD_ID
        WHERE `ohr_deliveryphone` LIKE ? ");    
        $QuerySearch -> bindvalue( 1 , $query."%", PDO::PARAM_STR);      
        $QuerySearch->execute();
        $results = $QuerySearch->fetchAll();
        // var_dump($results); // pour tester
        return $this->showProduct($results);
    }

    // PArtie code par Sofiane le 01/02/2022
    // Fonction de recherche des résultats par rapport au numéro de téléphone
    public function searchDog($query){
        $db = Connector::getInstance();
        $QuerySearch = $db->prepareQuery("SELECT `OHR_DELIVERYPHONE`, `OHR_ID`, `OHR_ORDERNUMBER`, `OHR_DATE` , `ADR_DENOMINATION` FROM `t_d_orderheader_ohr` AS OHR
        JOIN `t_d_address_adr` AS ADR ON OHR.OHR_ADR_ID_PAYMENT = ADR.ADR_ID
        JOIN `t_d_orderdetail_odt` AS ODT ON ODT.ODT_OHR_ID = OHR.OHR_ID
        JOIN `t_d_product_prd` AS PRD ON ODT.ODT_PRD_ID = PRD.PRD_ID
        WHERE `ohr_deliveryphone` LIKE ? ");    
        $QuerySearch -> bindvalue( 1 , $query."%", PDO::PARAM_STR);      
        $QuerySearch->execute();
        $results = $QuerySearch->fetchAll();
        return $results;
    }

    // Fonction qui recherche la liste de tous les numéros de commande
    // public function getOrderNum(){
    //     $db = Connector::getInstance();
    //     $QueryNumOrder = $db->prepareQuery('SELECT `OHR_ORDERNUMBER` FROM `t_d_orderheader_ohr` order by `ohr_ordernumber` DESC;');        
    //     $QueryNumOrder->execute();
    //     $result = $QueryNumOrder->fetchAll();
    //     return $this->createOptions($result);
    // }


    // Fonction qui enregistre les données du formulaire dans la BDD
    public function postForm($valuescoo) {            
        $db = Connector::getInstance();
        $stmt = $db->prepareQuery("INSERT INTO t_d_dossier_sav_dsv (DSV_TDS_ID, DSV_PRD_ID, DSV_ORH_ID, DSV_COM_DIAG_INITIAL) VALUES (? , ? , ? , ?)");
        
        $stmt -> bindvalue( 1 , $valuescoo['etatDos'], PDO::PARAM_INT);
        $stmt -> bindvalue( 2 , $valuescoo['produit'], PDO::PARAM_INT);
        $stmt -> bindvalue( 3 , $valuescoo['idCom'], PDO::PARAM_INT);
        $stmt -> bindvalue( 4 , $valuescoo['comDiag'], PDO::PARAM_STR);
        
        $result = $stmt->execute();
        return var_dump($result); // Pour tester
    }
}

?>