<?php

namespace Src\Models;
/**
 * Class ModelRepository
 * @package Src\Models
 */
abstract class ModelRepository
{
    protected $table_name;
    protected $conn;

    public function __construct()
    {
        $db = DbConnect::getInstance();
        $this->conn = $db->getConn();
    }
    /**
     * fonction qui permet de récupérer tous les enregistrements d'une table
     *
     * @return array
     */
    public function getAll(): array
    {
        $query = $this->conn->prepare("SELECT * FROM $this->table_name");
        $query->execute();
        return $query->fetchAll();
    }

    public function getById(int $id): array
    {
        $query = $this->conn->prepare("SELECT * FROM $this->table_name WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();

    }
    /**
     * fonction qui permet d'inserer un enregistrement dans une table
     *
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        $fields = implode(', ', array_keys($data));
        $values = implode(', ', array_map(fn($value) => ":$value", array_keys($data)));
        $query = $this->conn->prepare("INSERT INTO $this->table_name ($fields) VALUES ($values)");
        $return = $query->execute($data);
        return $return;
    }

    /**
     * fonction qui permet de récupérer un enregistrement par un champ donné     *
     *
     * @param string $field
     * @param $value
     * @return array
     */
    public function getByField(string $field, $value): array
    {
        $query = $this->conn->prepare("SELECT * FROM $this->table_name WHERE $field = :$field");
        $query->bindParam(":$field", $value);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }
    /**
     * fonction qui permet de vérifier si un enregistrement existe
     *
     * @param string $field
     * @param $value
     * @return bool
     */
    public function exist(string $field, $value): bool
    {
        $query = $this->conn->prepare("SELECT * FROM $this->table_name WHERE $field = :$field");
        $query->bindParam(":$field", $value);
        $query->execute();
        $product = $query->fetch();
        return (bool)$product;
    }
}