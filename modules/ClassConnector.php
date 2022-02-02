<?php

// INSTANCIATION DE LA CLASS CONNECT
// SOFIANE 19/01/2022
class Connector
{  
    private $host;
    private $db; 
    private $username;
    private $password;
    private $con;
    private static $instance;

    // function de connexion
    // SOFIANE 20/01/2022
    private function connect() {  
        if($_SESSION && strcmp($_SESSION['LOGGED_USER'], 'admin')!== 0){
            $this->host = 'localhost';
            $this->username = $_SESSION['LOGGED_USER'];
            $this->password = $_SESSION['password'];
            $this->db = 'Menuiz';
            try { 
                 $con = new PDO('mysql:host='.$this->host.';dbname='.$this->db.';charset=utf8', $this->username, $this->password);
                 $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                 $this->con = $con;                 
            } catch(PDOException $e){
                die("Erreur:".$e->getMessage());
            }    
            } else {
            $this->host = 'localhost';
            $this->username = 'root';
            $this->password = '';
            $this->db = 'Menuiz';
            try { 
                 $con = new PDO('mysql:host='.$this->host.';dbname='.$this->db.';charset=utf8', $this->username, $this->password);
                 $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                 $this->con = $con;                 
            } catch(PDOException $e){
                die("Erreur:".$e->getMessage());
            }      
        }      
    }
    // static connexion function qui facilite son appel à l'exterieur de la class.
    // SOFIANE 20/01/2022
    public static function getInstance(){
        if(static::$instance === NULL){
            static::$instance = new Connector();
            static::$instance->connect();
        } 
        return static::$instance;        
    }

    // function d'affichage de la totalité d'une entité par select SQL
    // nécéssaire sinon prepare ne fonctionne pas, j'aurai fait un extend sur la class PDO mais je ne voulais pas tout mélanger.
    // SOFIANE 20/01/2022
    public function prepareQuery($query) {
        return $this->con->prepare($query);
    }

    // function check si l'utilisateur est déjà dans la database
    // SOFIANE 20/01/2022
    public function checkName($paramName){
            $checkIfExist = $this->prepareQuery('SELECT 1 FROM `users` WHERE `username` = ?');
            $checkIfExist->bindValue(1, $paramName, PDO::PARAM_STR);         
            $checkIfExist->execute();
            return  $checkIfExist->fetchColumn();
    } 
    // function check password sans hash -- TO DO HASH
    // SOFIANE 20/01/2022
    public function checkPassword($param, $param2){
            // $encryptedPw = password_hash($param, PASSWORD_DEFAULT);
            $checkIfExist = $this->con->prepare("SELECT * FROM `users` WHERE `username` = ?");
            $checkIfExist->bindValue(1, $param, PDO::PARAM_STR); 
            // $encryptedPw,
            $checkIfExist->execute();
            $result = $checkIfExist->fetchAll(PDO::FETCH_ASSOC);
            return password_verify($param2, $result['password']);
    }

}  

?>

