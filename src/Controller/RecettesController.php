<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecettesRepository;

class RecettesController extends AbstractController
{
    /**
     * @Route("/recettes{nomRecette}", name="recetteParNom")
     */
    public function searchRecette(RecettesRepository $repo, $nomRecette)
    {
         $recettes = array();
        $recette = array();
        //$recettes = $repo->getRecetteParPropriete('nomRecette' , $nomRecette);
        $recettesBrut = $repo->countNumberPrintedForCategory($nomRecette);
        //var_dump($recettesBrut);die;
        foreach ($recettesBrut as  $recette) {
            $nomRecette = $recette['nom_recette'];
            $recettesTemp = $repo->getRecetteParPropriete('nomRecette', '=' , $nomRecette);  
            $recettes[] = $recettesTemp[0];
        }
        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('recettes/liste.html.twig', [
            'recettes' => $recettes,
            'classeCouleur' => $classeCouleur 
        ]);
    }
}
