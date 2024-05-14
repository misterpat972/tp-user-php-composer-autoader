<?php

namespace Src\Models;
/**
 * Class UserRepository
 * @package Src\Models
 */
class UserRepository extends ModelRepository
{
    protected $table_name = 'users';

    /**
     * Fonction qui permet de passer en paramètre l'email.
     *
     * Cette fonction est utilisé pour récupérer un utilisateur par son email.
     *
     * @param $email
     * @return array
     */
    public function getUser($email): array
    {
        return $this->getByField('email', $email);
    }

    public function emailExist($email): bool
    {
        return $this->exist('email', $email);
    }

    /**
     * Fonction qui permet de récupérer tous les utilisateurs.
     *
     * Cette fonction est utilisé pour récupérer tous les utilisateurs pour la génération d'un fichier exel.
     *
     * @return array
     */
    public function getAllUsers(): array
    {
        return $this->getAll();
    }
}
