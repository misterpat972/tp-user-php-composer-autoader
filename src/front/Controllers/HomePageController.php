<?php
//require('config/DbConnect.php');

namespace Src\front\Controllers;

/**
 * Ici, nous avons un contrôleur qui gère la page d'accueil.
 *
 * Class HomePageController
 *
 * @package Src\front\Controllers
 */
class HomePageController
{
    /**
     * Cette méthode permet d'afficher la page d'accueil.
     *
     * @return void
     */
    public function index()
    {
        $title = "Accueil";
        ob_start();
        require('views/homepage.php');
        $content = ob_get_clean();
        require('views/layout.php');
    }

}
