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
        $recettesTemp = $repo->findAll();

        // Sélectionne 3 recettes de manière aléatoire
        $prem = rand( 0, count($recettesTemp)-1);
        $deus = rand(0, count($recettesTemp)-1) ;
        $trois= rand(0, count($recettesTemp)-1);
        $recettes = array();
        if ($prem == $deus) {
            $deus = rand(0, count($recettesTemp)-1) ;
        }
        if ($deus == $trois) {
            $trois= rand(0, count($recettesTemp)-1);
        }
        array_push($recettes, $recettesTemp[$prem]);
        array_push($recettes, $recettesTemp[$deus]);
        array_push($recettes, $recettesTemp[$trois]);

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('global/index.html.twig', [
            'recettes' => $recettes,
            'classeCouleur' => $classeCouleur 
        ]);
    }
}
