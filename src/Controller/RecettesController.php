<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecettesRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recettes;

class RecettesController extends AbstractController
{
    
        /**
     * @Route("/recettes/liste", name="listeRecettes")
     */
    public function index( RecettesRepository $repository)
    {

        $recettes = array();
        $recettes = $repository->findAll();

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('recettes/liste.html.twig', [
            'recettes' => $recettes,
            'classeCouleur' => $classeCouleur 
        ]);
    }

    /**
     * @Route("/recettes/liste2", name="rechercheRecette2")
     */
    public function rechercheRecette( RecettesRepository $repo , Request $request, 
            Recettes $recette=null)
    {

        $nomRecette =  $request->query->get('nomRecette');
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

    /**
     * @Route("/recettes/{nomRecette}", name="recetteParNom")
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
