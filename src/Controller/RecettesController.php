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
     * @Route("/recettes/listeMotCle", name="rechercheRecettesParMotCle")
     */
    public function rechercheToutesLesRecettesParMotCle( RecettesRepository $repo , Request $request, 
            Recettes $recette=null)
    {
        $recettes = array();
        $nomRecette =  $request->query->get('nomRecette');
        $recettesBrut = $repo->rechercheRecetteParMotCle($nomRecette);
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
    public function rechercheLaRecetteEnQuestion(RecettesRepository $repo, $nomRecette)
    {
        $recettes = array();
        $recette = array();
        $recettesBrut = $repo->rechercheRecetteParMotCle($nomRecette);
        foreach ($recettesBrut as  $recette) {
            $nomRecette = $recette['nom_recette'];
            $recettesTemp = $repo->getRecetteParPropriete('nomRecette', '=' , $nomRecette);  
            $recettes[] = $recettesTemp[0];
        }

        $noteGlobale = 0;
        for ($i=0; $i < count($recettes[0]->getNotes()) ; $i++) { 
             $noteGlobale = $noteGlobale + $recettes[0]->getNotes()[$i]->getNote();
        }
        $noteGlobale = $noteGlobale / count($recettes[0]->getNotes());

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('recettes/details.html.twig', [
            'recettes' => $recettes,
            'classeCouleur' => $classeCouleur,
            'noteGlobale' => $noteGlobale 
            
        ]);
    }


}
