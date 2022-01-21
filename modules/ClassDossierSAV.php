<?php
//  SOFIANE 20/01/2022
class DossierSAV {

    private $a;
    private $b;
    private $c;
    private $d;
    private $e;


    function affichageDossier($datas){
        echo "<tr>
        <th>Immatriculation</th>
        <th>Couleur</th>
        <th>***</th>
        <th>***</th>
        <th>Puissance</th>
        <th>***</th>
        <th>Reservoir</th>
        <th>Places</th>
        <th>Essence</th>
        <th>Message</th>
        </tr>";
        echo "<table class='table'>";
        foreach($datas as $dataRows){
            echo "<tr>";                    
            foreach($dataRows as $tableEntries){
                echo '<td> '.$tableEntries.'</td>';
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    function getData($param){
        $sql = 'SELECT * FROM T_D_DOSSIER_SAV_DSV AS SAV
	            JOIN T_D_PRODUCT_PRD AS PRD ON PRD.PRD_ID = SAV.DSV_PRD_ID
                JOIN t_d_orderheader_ohr as OHR ON OHR.OHR_ID = SAV.DSV_ORH_ID
                JOIN t_d_orderdetail_odt as ODT ON ODT.ODT_ID = OHR.OHR_ID 
                WHERE SAV.DSV_ID = ?';
    }
}

?>