<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecettesRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recettes;
use App\Entity\Note;
use App\Entity\Commentaires;

class RecettesController extends AbstractController
{
    
    /**
     * Methode permettant de lister toutes les recettes
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
     * Methode pour ajouter un avis d'un utilisateur à une recette
     * @Route("/recettes/avis", name="avisUtilisateur")
     */
    public function avisUtilisateur( RecettesRepository $repo , Request $request, 
            Recettes $recette=null)
    {       
        $recetteId = $request->request->get('recetteId');
        $commentaireUser = $request->request->get('commentaire');
        $noteUser = (int) $request->request->get('note');
        $pseudoUser = $request->request->get('pseudo');

        $manager = $this->getDoctrine()->getManager();
        $recetteBdd = $repo->findById($recetteId);
        
        $note = new Note();
        $note->setNote($noteUser);
        $note->setRecette($recetteBdd[0]);

        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire($commentaireUser);
        $faker = \Faker\Factory::create('fr_FR');
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));    
        $commentaire->setValide(false);
        $commentaire->setPseudo($pseudoUser);
        $commentaire->setRecette($recetteBdd[0]);

        $manager->persist($note);
        $manager->persist($commentaire);
        $manager->flush();

        $recettes = $repo->findAll();

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('recettes/liste.html.twig', [
            'recettes' => $recettes,
            'classeCouleur' => $classeCouleur 
        ]);
    } 

    /**
     * Methode permettant de rechercher toutes les recette associées à un mot clé
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

        //  $request->query->get('name')
        
        // On retourne dans la partie Admin si on y était
        if ( (strpos($request->server->get('HTTP_REFERER'), "/admin/recette") )>0 ) {
            return $this->render('admin/admin_recettes/listeAdmin.html.twig', [
                'recettes' => $recettes,
                'classeCouleur' => $classeCouleur 
            ]);
        }else{
            return $this->render('recettes/liste.html.twig', [
                'recettes' => $recettes,
                'classeCouleur' => $classeCouleur 
            ]);
        }        
    }

    /**
     * Methode permettant de retrouver une recette à partir de son nom
     *  ainsi que sa note
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

        if($noteGlobale != 0){
            $noteGlobale = $noteGlobale / count($recettes[0]->getNotes());
        }

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('recettes/details.html.twig', [
            'recettes' => $recettes,
            'classeCouleur' => $classeCouleur,
            'noteGlobale' => $noteGlobale 
            
        ]);
    }


 

}
