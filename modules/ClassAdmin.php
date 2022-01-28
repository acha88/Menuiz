<?php



class Administrator {
    // function d'ajout d'un utilisateur
    // TO DO FORMULAIRE D'AJOUT
    // private $adminName;

    // public function setAdmin($param){
    //     return $this->adminName = $param;
    // }

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
    // TO DO FORMULAIRE DE SUPPRESSION
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
    
    private function printUsers($param){
        echo "<div class='form-box form-group '>";
        foreach($param as $table){
            echo "<div class='contour'>";
            foreach($table as $row){
                echo "<p>".$row."</p>";
            }
            echo "</div>";
        }
        echo "</div>";
    }
    public function viewUsers(){
        $db = Connector::getInstance();
        $query = $db->prepareQuery('SELECT US.username, US.PASSWORD, US.MAIL, typ.typ_type FROM `USERS` AS US
                                    JOIN type_user AS typ ON US.user_type_id = typ.typ_user_id');
        $query->execute();
        $result = $query->fetchAll();
        return $this->printUsers($result);



        }
}


?>
