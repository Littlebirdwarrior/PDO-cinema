<?php
//Dans le fichier "Connect.php" on se contente de déclarer la connexion à la base de données 
namespace Model;

abstract class Connect {
    const HOST="localhost";
    const DB = "cinema";
    const USER = "root";
    const PASS ="";

//La classe est abstraite, on n'instanciera jamais la classe Connect puisqu'on aura seulement besoin d'accéder à la méthode "seConnecter"
    public static function seConnecter(){
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        }catch(\PDOException $ex){
            return $ex->getMessage();
        }
    }

}

