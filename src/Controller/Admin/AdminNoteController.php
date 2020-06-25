<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NoteRepository;
use App\Form\NoteType;
use App\Entity\Note;
use Symfony\Component\HttpFoundation\Request;

class AdminNoteController extends AbstractController
{
    /**
     * @Route("/adminNote/note", name="adminNote")
     */
    public function index(NoteRepository $repository)
    {
        $notes = array();
        $notes = $repository->findAll();

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('admin/admin_note/listeAdminNotes.html.twig', [
            'notes' => $notes,
            'classeCouleur' => $classeCouleur 
        ]);
    }

      /**
     * @Route("/adminNotecreation", name="creationNote")
     * @Route("/adminNote/{id}", name="modifNote" , methods="GET|POST")
     */
    public function modificationEtAjout(Note $note=null, Request $request )
    {
        if ($note == null) {
            $note = new Note();
        }
        
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(NoteType::class, $note);
        dd($note);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($note);
            $manager->flush();
            $this->addFlash('success' , "L'action a été effectuée");
            return $this->redirectToRoute('adminNote');
        }

        return $this->render('admin/admin_note/modificationNote.html.twig', [
            'note' => $note,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adminNote/{id}", name="supNote" , methods="SUP")
     */
    public function supIngredient(Note $note, Request $request)
    {
       if ($this->isCsrfTokenValid("SUP".$note->getId(), $request->get("_token") )) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($note);
            $manager->flush();
            $this->addFlash('success' , "La note a été supprimé.");
            return $this->redirectToRoute("adminNote");
       }
    }
}
