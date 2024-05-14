<?php

namespace Src\Models;
/**
 * Class DbConnect
 * @package Src\Models
 */
class DbConnect
{
    private static $instance;
    private $conn;
    /**
     * DbConnect constructor.
     *
     * ici on utilise les variables d'environnement pour la connexion à la base de données
     *
     */
    private function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_NAME'];

        $this->conn = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public static function getInstance(): DbConnect
    {
        if (!self::$instance) {
            self::$instance = new DbConnect();
        }
        return self::$instance;
    }
    public function getConn(): \PDO
    {
        return $this->conn;
    }
}