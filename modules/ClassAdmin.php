<?php
class Administrator {
    // SOFIANE 27/01/2022
    // SOFIANE LAST MODIF 31/01/2022 Ajout de la connexion à la BDD avec compte utilisateur aux privilèges restraints (pour la SECURITE)
    public function registerUser($post){
        $db = Connector::getInstance();
        $username = $post['username'];
        $password = $post['password'];
        $mail = $post['mail'];
        $usertype = intVal($post['usertype'], 10);
        var_dump($usertype);
        $regQuery = $db->prepareQuery('INSERT INTO `users` (`username`, `password`, `mail`, `user_type_id`)
                                        values(?, ?, ?, ?)');
        $regQuery->bindValue(1, $username, PDO::PARAM_STR);
        $regQuery->bindValue(2, $password, PDO::PARAM_STR);
        $regQuery->bindValue(3, $mail, PDO::PARAM_STR);
        $regQuery->bindValue(4, $usertype, PDO::PARAM_INT);
        $regQuery->execute();  
        $count = $regQuery->rowCount();
        if ($count > 0) {
            echo '<p class="success">SUCCESS, Utilisateur enregistré avec succès !</p>';
        } else {
            echo '<p class="warning"> L\'utilisateur n\'a pas été enregistré ou vous avez entré un nom d\'utilisateur deja existant.</p>';
        }
    }
    // function de delete d'un utilisateur
    // SOFIANE 27/01/2022
    public function removeUser($post){
        $db = Connector::getInstance();
        $rmvQuery = $db->prepareQuery('DELETE FROM `users` WHERE `username` = ?');
        $rmvQuery->bindValue(1, $post['delete'], PDO::PARAM_STR);         
        $rmvQuery->execute();
        $count = $rmvQuery->rowCount();
        if ($count > 0) {
            echo '<p class="success">SUCCESS, Utilisateur supprimé avec succès !</p>';
        } else {
            echo '<p class="warning"> L\'utilisateur n\'a pas été supprimé ou vous avez entré un nom d\'utilisateur qui n\'existe pas.</p>';
        }
    }
     // SOFIANE 27/01/2022
    private function printUsers($param){
        echo "<div class='fold-container shadow contour'>";
        foreach($param as $table){
            echo "<div class='contour'>";
            echo "<p> Username : ".$table['username'].'</p>';
            echo "<p> Password : ".$table['PASSWORD'].'</p>';
            echo "<p> Mail : ".$table['MAIL'].'</p>';
            echo "<p> Type : ".$table['typ_type'].'</p>';
            // foreach($table as $row){
            //     echo "<p>".$row."</p>";
            // }
            echo "</div>";
        }
        echo "</div>";
    }
     // SOFIANE 27/01/2022
    public function viewUsers(){
        $db = Connector::getInstance();
        $query = $db->prepareQuery('SELECT US.username, US.PASSWORD, US.MAIL, typ.typ_type FROM `USERS` AS US
                                    JOIN type_user AS typ ON US.user_type_id = typ.typ_user_id');
        $query->execute();
        $result = $query->fetchAll();
        return $this->printUsers($result);
    }
    // function pour obtenir un tableau d'un utilisateur avec son type
    // qui ensuite execute une function qui créera et definira ses privilèges dans la database
    // SOFIANE 31/01/2022
    public function setUserPriv($paramName){
        $db = Connector::getInstance();
        $query = $db->prepareQuery('SELECT * FROM `USERS` AS US
                                    JOIN type_user AS typ 
                                    ON US.user_type_id = typ.typ_user_id
                                    WHERE US.username = ?');
        $query->bindValue(1, $paramName, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();
        // return var_dump($result);
        return $this->createUserPriv($result);
    }
    // function pour créer un utilisateur dans la database avec des privilèges selon son rôle
    // SOFIANE 31/01/2022
    // TO DO - VERIF pourquoi Grant ne fonctionne pas en requête par PDO.
    public function createUserPriv($param){
        $db = Connector::getInstance();
        $query = $db->prepareQuery("CREATE USER ?@'localhost' IDENTIFIED BY ?");
        $query2 = $db->prepareQuery("GRANT SELECT, INSERT, UPDATE ON `Menuiz`.* TO ?@'localhost' WITH GRANT OPTION");
        foreach($param as $data){
            if(strcmp($data['Typ_type'], 'Technicien SAV') !== 0 || strcmp($data['Typ_type'], 'Technicien HOTLINE') !== 0){
                var_dump($data);
                $query->bindValue(1, $data['username'], PDO::PARAM_STR); 
                $query->bindValue(2, $data['password'], PDO::PARAM_STR); 
                $query2->bindValue(1, $data['username'], PDO::PARAM_STR); 
                $query->execute();  
                $query2->execute();                
            }
        }
    }
    public function getUsersList(){
    $db = Connector::getInstance();
    $query = $db->prepareQuery('SELECT * FROM `USERS` AS US
                                JOIN type_user AS typ ON US.user_type_id = typ.typ_user_id');
    $query->execute();
    $result = $query->fetchAll();
    return $result;
    }
}
?>