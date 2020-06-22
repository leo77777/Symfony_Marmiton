<?php

namespace App\DataFixtures;

use App\Entity\Recettes;
use App\Entity\Note;
use App\Entity\Photos;
use App\Entity\Etapes;
use App\Entity\Categories;
use App\Entity\Commentaires;
use App\Entity\Ingredients;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecettesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        // CREATION DE CATEGORIES
        $categorie1 = new Categories();
        $categorie1->setNomCategorie('dessert');
        $manager->persist($categorie1);  
        $categorie2 = new Categories();
        $categorie2->setNomCategorie('plat principal');
        $manager->persist($categorie2);  
        $categorie3 = new Categories();
        $categorie3->setNomCategorie('entrée');
        $manager->persist($categorie3);
        $categorie4 = new Categories();
        $categorie4->setNomCategorie('soupe');
        $manager->persist($categorie4);
        $categorie5 = new Categories();        
        $categorie5->setNomCategorie('tarte');
        $manager->persist($categorie5);
        $categorie6 = new Categories();
        $categorie6->setNomCategorie('cuisine asiatique');
        $manager->persist($categorie6);
        $categorie7 = new Categories();
        $categorie7->setNomCategorie('purée');
        $manager->persist($categorie7);  
        $categorie8 = new Categories();
        $categorie8->setNomCategorie('légumes');
        $manager->persist($categorie8);  
        $categorie9 = new Categories();    
        $categorie9->setNomCategorie('sauce');
        $manager->persist($categorie9); 
        $categorie10 = new Categories(); 
        $categorie10->setNomCategorie('viande');
        $manager->persist($categorie10);  

        // CREATION D INGREDIENTS
        $ingredient1 = new Ingredients();
        $ingredient1->setNomIngredient("ingredient1");
        $ingredient1->setCouleur('rouge');
        $manager->persist($ingredient1); 
        $ingredient2 = new Ingredients();
        $ingredient2->setNomIngredient("ingredient2");
        $ingredient2->setCouleur('vert');
        $manager->persist($ingredient2); 
        $ingredient3 = new Ingredients();
        $ingredient3->setNomIngredient("ingredient3");
        $ingredient3->setCouleur('rouge');
        $manager->persist($ingredient3); 
        $ingredient4 = new Ingredients();
        $ingredient4->setNomIngredient("ingredient4");
        $ingredient4->setCouleur('rouge');
        $manager->persist($ingredient4); 
        $ingredient5 = new Ingredients();
        $ingredient5->setNomIngredient("ingredient5");
        $ingredient5->setCouleur('rouge');
        $manager->persist($ingredient5); 
        $ingredient6 = new Ingredients();
        $ingredient6->setNomIngredient("ingredient6");
        $ingredient6->setCouleur('rouge');
        $manager->persist($ingredient6); 
        $ingredient7 = new Ingredients();
        $ingredient7->setNomIngredient("ingredient7");
        $ingredient7->setCouleur('rouge');
        $manager->persist($ingredient7); 
          
        //
        $recette1 = new Recettes();
        $recette1->addCategory($categorie2);
        $recette1->addCategory($categorie3);
        $recette1->setNomRecette("Mousse d'asperge");        
        $manager->persist($recette1);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette1);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Mousse asperge');
        $photo->setLien('\images\mousseAsperge.jpg');
        $photo->setRecette($recette1);
        $manager->persist($photo); 
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape('Préparer un paquet de gelée Maggi avec 1/4 l d’eau. Eplucher 1 kg d’asperges fraîches, garder les parties tendres, faire cuire 20 min à l’eau bouillante salée');
        $etape->setRecette($recette1);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape('Mixer les asperges, ajouter 100 g de vache qui rit, un pot de crème fraîche, sel, poivre, le jus d’un citron, éventuellement du Tabasco');
        $etape->setRecette($recette1);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape('Dans un moule à cake ou à charlotte, verser la préparation, mettre au réfrigérateur une nuit');
        $etape->setRecette($recette1);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(4);
        $etape->setDescriptionEtape('Démouler et servir avec de la mayonnaise au citron');
        $etape->setRecette($recette1);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("bon");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Rere");
        $commentaire->setRecette($recette1);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("tres bon");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Vyvy");
        $commentaire->setRecette($recette1);
        $manager->persist($commentaire);




        $recette2 = new Recettes();
        $recette2->addCategory($categorie4);
        $recette2->addCategory($categorie8);
        $recette2->setNomRecette("Soupe de cresson");
        $manager->persist($recette2);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette2);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Soupe de cresson');
        $photo->setLien('\images\soupeCresson.jpg');
        $photo->setRecette($recette2);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape('Laver, nettoyer le cresson pour enlever les trop grosses tiges.');
        $etape->setRecette($recette2);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape('Eplucher les pommes de terre, et les détailler en cubes.');
        $etape->setRecette($recette2);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape("Dans une grande casserole, mettre le beurre à chauffer. Lorsqu'il commence à grésiller (sans brûler), ajouter le cresson, les pommes de terre, l'échalote hachée grossièrement et le thym.");
        $etape->setRecette($recette2);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(4);
        $etape->setDescriptionEtape("Laisser le cresson ramollir et ajouter l'eau et le bouillon cube. Il faut que l'eau recouvre les légumes d'au moins 2 doig");
        $etape->setRecette($recette2);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("moyen");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Vyvy");
        $commentaire->setRecette($recette2);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("fameux");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(false);
        $commentaire->setPseudo("Tina");
        $commentaire->setRecette($recette2);
        $manager->persist($commentaire);
        


        $recette3= new Recettes();
        $recette3->addCategory($categorie1);
        $recette3->addCategory($categorie5);
        $recette3->setNomRecette("Mousse au chocolat");
        $manager->persist($recette3);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette3);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Mousse au chocolat');
        $photo->setLien('\images\mousseChocolat.jpg');
        $photo->setRecette($recette3);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape("Séparer les blancs des jaunes d'oeufs.");
        $etape->setRecette($recette3);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape("Hors du feu, incorporer les jaunes et le sucre.");
        $etape->setRecette($recette3);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape("Ajouter délicatement les blancs au mélange à l'aide d'une spatule.");
        $etape->setRecette($recette3);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(4);
        $etape->setDescriptionEtape("Mettre au frais 2h minimum.");
        $etape->setRecette($recette3);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("moyen");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Byby");
        $commentaire->setRecette($recette3);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("bon");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(false);
        $commentaire->setPseudo("Tina");
        $commentaire->setRecette($recette3);
        $manager->persist($commentaire);


        $recette4 = new Recettes();
        $recette4->addCategory($categorie2);
        $recette4->addCategory($categorie8);
        $recette4->setNomRecette("Carottes vichy");
        $manager->persist($recette4);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette4);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Carottes vichy');
        $photo->setLien('\images\carottesVichy.jpg');
        $photo->setRecette($recette4);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape("Eplucher (gratter) les carottes et couper-les en petites rondelles");
        $etape->setRecette($recette4);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape("Dans une casserole, préparer un bouillon de poulet. La quantité d'eau doit être suffisante pour recouvrir les carottes.");
        $etape->setRecette($recette4);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape("Dans une poêle, faire fondre le beurre puis, ajouter le sucre. Remuer jusqu'à obtention d'une légère 'mousse', et ajouter les carottes. Remuer un peu puis, y ajouter le bouillon.");
        $etape->setRecette($recette4);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(4);
        $etape->setDescriptionEtape("Laisser à petit feu sans couvrir afin de permettre à l'eau de s'évaporer pendant 20/25 minutes.");
        $etape->setRecette($recette4);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("succulent");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Keke");
        $commentaire->setRecette($recette4);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("fameux");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Mirti");
        $commentaire->setRecette($recette4);
        $manager->persist($commentaire);


        $recette5 = new Recettes();
        $recette5->addCategory($categorie7);
        $recette5->addCategory($categorie1);
        $recette5->setNomRecette("Compote pomme banane");
        $manager->persist($recette5);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette5);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Compote pomme banane');
        $photo->setLien('\images\compotePommeBanane.jpg');
        $photo->setRecette($recette5);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape("Eplucher les pommes et les couper en petits dés.");
        $etape->setRecette($recette5);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape("Couper la banane en rondelles.");
        $etape->setRecette($recette5);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape("Ajouter les 3 sachets de sucre vanillé, et laisser mijoter pendant 1 heures.");
        $etape->setRecette($recette5);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(4);
        $etape->setDescriptionEtape("Remuer régulièrement et rajouter de l'eau si besoin.");
        $etape->setRecette($recette5);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("a voir");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Mibo");
        $commentaire->setRecette($recette5);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("excellent");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(false);
        $commentaire->setPseudo("Tina");
        $commentaire->setRecette($recette5);
        $manager->persist($commentaire);

        $recette6 = new Recettes();
        $recette6->addCategory($categorie2);
        $recette6->addCategory($categorie6);
        $recette6->setNomRecette("Riz contonais");
        $manager->persist($recette6);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette6);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Riz contonais');
        $photo->setLien('\images\rizCantonais.jpg');
        $photo->setRecette($recette6);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape("Faire cuire le riz et le rincer à l'eau froide.");
        $etape->setRecette($recette6);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape("Faire une omelette et la couper en lanières");
        $etape->setRecette($recette6);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("incroyable");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Hera");
        $commentaire->setRecette($recette6);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("bien");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(false);
        $commentaire->setPseudo("Jeti");
        $commentaire->setRecette($recette6);
        $manager->persist($commentaire);



        $recette7 = new Recettes();
        $recette7->addCategory($categorie2);
        $recette7->addCategory($categorie3);
        $recette7->setNomRecette("Sushis");
        $manager->persist($recette7);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette7);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Sushis');
        $photo->setLien('\images\sushis.jpg');
        $photo->setRecette($recette7);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape("Poser la feuille de Nori à plat et la couper en deux.");
        $etape->setRecette($recette7);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape("Ajouter les ingrédients au centre sur toute la longueur.");
        $etape->setRecette($recette7);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape("Couper le rouleau en petites bouchées, et servir en apéritif.");
        $etape->setRecette($recette7);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("fameux");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Vyvy");
        $commentaire->setRecette($recette7);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("tres bon");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(false);
        $commentaire->setPseudo("Tina");
        $commentaire->setRecette($recette7);
        $manager->persist($commentaire);






        $recette8 = new Recettes();
        $recette8->addCategory($categorie2);
        $recette8->addCategory($categorie8);
        $recette8->setNomRecette("Purée de blettes");
        $manager->persist($recette8);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette8);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Purée de blettes');
        $photo->setLien('\images\pureeDeBlettes.jpg');
        $photo->setRecette($recette8);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape("Mettre les pommes de terres et les blettes à cuire.");
        $etape->setRecette($recette8);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape("Quand tout est cuit, déposer les pommes de terre et les blettes dans une passoire.");
        $etape->setRecette($recette8);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape("Bien mélanger, soit au mixer, soit écraser avec une spatule.");
        $etape->setRecette($recette8);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("hum...");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Syla");
        $commentaire->setRecette($recette8);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("oh la !");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(false);
        $commentaire->setPseudo("Cety");
        $commentaire->setRecette($recette8);
        $manager->persist($commentaire);


        $recette9 = new Recettes();
        $recette9->addCategory($categorie5);
        $recette9->addCategory($categorie1);
        $recette9->setNomRecette("Tarte tatin");
        $manager->persist($recette9);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette9);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Tarte tatin');
        $photo->setLien('\images\tarteTatin.jpg');
        $photo->setRecette($recette9);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape("Eplucher les 8 pommes golden entières. ");
        $etape->setRecette($recette9);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape("Aplatir avec une spatule de temps en temps.");
        $etape->setRecette($recette9);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape("Saupoudrer les pommes de sucre vanillé et de cannelle.");
        $etape->setRecette($recette9);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("super");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Vyvy");
        $commentaire->setRecette($recette9);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("a gouter !");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(false);
        $commentaire->setPseudo("Tina");
        $commentaire->setRecette($recette9);
        $manager->persist($commentaire);


        $recette10 = new Recettes();
        $recette10->addCategory($categorie3);
        $recette10->addCategory($categorie8);
        $recette10->setNomRecette("Salade vietnamienne");
        $manager->persist($recette10);
        for ($i = 1; $i <= 10; $i++) {
            $note = new Note();
            $note->setNote($faker->numberBetween($min=0, $max=20));
            $note->setRecette($recette10);
            $manager->persist($note);                                    
        }
        $photo = new Photos();
        $photo->setChampAlternatif('Salade vietnamienne');
        $photo->setLien('\images\saladeVietnamienne.jpg');
        $photo->setRecette($recette10);
        $manager->persist($photo);
        $etape = new Etapes();
        $etape->setNumEtape(1);
        $etape->setDescriptionEtape("Emincer tous les légumes.");
        $etape->setRecette($recette10);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(2);
        $etape->setDescriptionEtape("Préparez la sauce en mélangeant les ingrédients.");
        $etape->setRecette($recette10);
        $manager->persist($etape);
        $etape = new Etapes();
        $etape->setNumEtape(3);
        $etape->setDescriptionEtape("Verser sur les légumes au dernier moment, juste avant de servir.");
        $etape->setRecette($recette10);
        $manager->persist($etape);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("le meilleur");
        $commentaire->setCreatedAt($faker->dateTimeBetween( '-30 years', 'now'));
        $commentaire->setValide(true);
        $commentaire->setPseudo("Vyvy");
        $commentaire->setRecette($recette10);
        $manager->persist($commentaire);
        $commentaire = new Commentaires();
        $commentaire->setLibelleCommentaire("japonisant");
        $commentaire->setCreatedAt($faker->dateTimeBetween('-30 years', 'now' ));
        $commentaire->setValide(false);
        $commentaire->setPseudo("Hiki");
        $commentaire->setRecette($recette10);
        $manager->persist($commentaire);

        $manager->flush();
    }
}
