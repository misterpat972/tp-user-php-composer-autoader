<?php

namespace Src\front\Controllers;

/**
 * Ici, nous avons un contrôleur qui gère les vues que l'utilisateur aura accès.
 *
 * Class UserFrontController
 *
 * @package Src\front\Controllers
 */
class UserFrontController
{
    /**
     * Cette méthode permet d'afficher la page de connexion.
     *
     * @return void
     */
    public function login(): void
    {
        $title = "Connexion";
        ob_start();
        require('views/login.php');
        $content = ob_get_clean();
        require('views/layout.php');
    }
    /**
     * Cette méthode permet d'afficher la page d'inscription.
     *
     * @return void
     */
    public function register(): void
    {
        $title = "Inscription";
        ob_start();
        require('views/register.php');
        $content = ob_get_clean();
        require('views/layout.php');
    }
    /**
     * Cette méthode permet d'afficher la page de compte.
     *
     * @return void
     */
    public function account(): void
    {
        $title = "Mon compte";
        ob_start();
        $_SESSION['user']['is_admin'] == 1 ? require('views/admin.php') : require('views/account.php');
        $content = ob_get_clean();
        require('views/layout.php');
    }
}