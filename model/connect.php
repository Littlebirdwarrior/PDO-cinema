<?php
//Dans le fichier "Connect.php" on se contente de déclarer la connexion à la base de données 
namespace Model;
use PDO;

abstract class Connect {
    const HOST="localhost:8888";
    const DB = "cinema";
    const USER = "root";
    const PASS ="";

    // return new \PDO(
    //     "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);

//La classe est abstraite, on n'instanciera jamais la classe Connect puisqu'on aura seulement besoin d'accéder à la méthode "seConnecter"
    public static function seConnecter(){
        try {
            return new PDO(
                'mysql:host=localhost;dbname=cinema;charset=utf8',
                'root',
                'root',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
            );
        }catch(\PDOException $ex){
            return $ex->getMessage();
        }
    }

}
