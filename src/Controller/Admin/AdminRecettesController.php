<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecettesRepository;
use App\Entity\Recettes;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RecettesType;

class AdminRecettesController extends AbstractController
{
    /**
     * @Route("/admin/recettes", name="adminRecettes")
     */
    public function index(RecettesRepository $repository)
    {
        $recettes = array();
        $recettes = $repository->findAll();

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('admin/admin_recettes/listeAdmin.html.twig', [
            'recettes' => $recettes,
            'classeCouleur' => $classeCouleur 
        ]);
    }

    /**
     * @Route("/admin/creation", name="creationRecette")
     * @Route("/admin/{id}", name="modifRecette" , methods="GET|POST")
     */
    public function modificationEtAjout(Recettes $recette=null, Request $request )
    {
        if ($recette == null) {
            $recette = new Recettes();
        }

        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm( RecettesType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($recette);
            $manager->flush();
            $this->addFlash('success' , "L'action a été effectuée");
            return $this->redirectToRoute('adminRecettes');
        }

        return $this->render('admin/admin_recettes/modificationRecette.html.twig', [
            'recette' => $recette,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="supRecette" , methods="SUP")
     */
    public function supRecette(Recettes $recette, Request $request)
    {
       if ($this->isCsrfTokenValid("SUP".$recette->getId(), $request->get("_token") )) {
            $manager = $this->getDoctrine()->getManager();

            $photosRecette = $recette->getPhotos();  
            foreach ($photosRecette as $key => $photo) {
                $manager->remove($photo);
            }

            $ingredientsRecette = $recette->getComposes();  
            foreach ($ingredientsRecette as $key => $ingredient) {
                $manager->remove($ingredient);
            }

            $notesRecette = $recette->getNotes();  
            foreach ($notesRecette as $key => $note) {
                $manager->remove($note);
            }

            $commentairesRecette = $recette->getCommentaires();  
            foreach ($commentairesRecette as $key => $commentaire) {
                $manager->remove($commentaire);
            }

            $etapesRecette = $recette->getEtapes();  
            foreach ($etapesRecette as $key => $etape) {
                $manager->remove($etape);
            }

            $manager->remove($recette);
            $manager->flush();
            $this->addFlash('success' , "La recette a bien été supprimée.");
            return $this->redirectToRoute("adminRecettes");
       }
    }
}
