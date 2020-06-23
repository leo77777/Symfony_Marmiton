<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecettesRepository;

class GlobalController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index( RecettesRepository $repo)
    {
        $recettes = $repo->findAll();

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('global/index.html.twig', [
            'recettes' => $recettes,
            'classeCouleur' => $classeCouleur 
        ]);
    }
}
