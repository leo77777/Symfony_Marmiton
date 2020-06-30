<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientsRepository;
use App\Form\IngredientsType;
use App\Entity\Ingredients;
use Symfony\Component\HttpFoundation\Request;

class AdminIngredientsController extends AbstractController
{

   
    /**
     * @Route("/adminIngredient/ingredients", name="adminIngredients")
     */
    public function index( IngredientsRepository $repository )    {

        $ingredients = array();
        $ingredients = $repository->findAll();

        $classeCouleur = array( "success", "danger", "warning");
        return $this->render('admin/admin_ingredients/listeAdminIngredients.html.twig', [
            'ingredients' => $ingredients,
            'classeCouleur' => $classeCouleur 
        ]);
    }



    /**
     * @Route("/adminIngredient/creation", name="creationIngredient")
     * @Route("/adminIngredient/{id}", name="modifIngredient" , methods="GET|POST")
     */
    public function modificationEtAjout(Ingredients $ingredient=null, Request $request )
    {
        if ($ingredient == null) {
            $ingredient = new Ingredients();
        }

        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(IngredientsType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($ingredient);
            $manager->flush();
            $this->addFlash('success' , "L'action a été effectuée");
            return $this->redirectToRoute('adminIngredients');
        }

        return $this->render('admin/admin_ingredients/modificationIngredient.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/adminIngredient/{id}", name="supIngredient" , methods="SUP")
     */
    public function supIngredient(Ingredients $ingredient, Request $request)
    {
       if ($this->isCsrfTokenValid("SUP".$ingredient->getId(), $request->get("_token") )) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($ingredient);
            $manager->flush();
            $this->addFlash('success' , "L ingredient a été supprimé.");
            return $this->redirectToRoute("adminIngredients");
       }
    }

    /**     
    * @Route("/adminIngredient", name="adminRecetteIngredient")
     */
    public function adminRecetteIngredient( Request $request)
    {
            dd('ici');
            return $this->redirectToRoute("adminIngredients");
    }


}
