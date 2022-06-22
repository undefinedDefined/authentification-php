<?php


class Database
{
    public static function connect()
    {
        try{
            $options = [
                PDO::FETCH_ASSOC,
                PDO::ERRMODE_EXCEPTION
            ];
            $pdo = new PDO('mysql:dbname=national_informatique;host=localhost', 'root', '', $options);

            return $pdo;
        }catch(PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }
}