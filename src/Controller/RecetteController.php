<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\Categorie;
use App\Entity\Ingredient;
use App\Form\RecetteType;
use App\Form\RecetteIngredientType;
use App\Entity\Preparation;
use App\Entity\RecetteIngredient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {

        // $repository=$this->getDoctrine()->getRepository(Recette::class);
        // $lastRecette= $repository->findAll()->setMaxResults(3);

        $cnx = $this->getDoctrine()->getManager()->getConnection();
        $sql = "SELECT * FROM `recette` ORDER BY datePublication DESC LIMIT 3";
        $stmt = $cnx->prepare($sql);
        $stmt->execute();

        $tab = $stmt->fetchAllAssociative();

        // $dernieresRecettes= $recetteRepo->findLastRecette();
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
            "dernieresRecettes" => $tab
        ]);
    }

    /**
     * @Route("/recettes", name="recettes")
     */
    public function recettes(): Response
    {
        // Liste de toutes les recettes
        $repository = $this->getDoctrine()->getRepository(Recette::class);
        $recettes = $repository->findAll();

        // dd($recettes);

        return $this->render('recette/recettes.html.twig', [
            'listRecette' => $recettes,
        ]);
    }

    /**
     * @Route("/recettes/{id}", name="recetteById")
     */
    public function recetteById(Recette $recette): Response
    {
        // Récupérer la préparation de la recette
        $repository = $this->getDoctrine()->getRepository(Preparation::class);
        $preparationRecette = $repository->findOneBy(["idrecette" => $recette->getIdrecette()]);

        // dd($recette);
        return $this->render('recette/recetteById.html.twig', [
            'infoRecette' => $recette,
            'preparation' => $preparationRecette
        ]);
    }

    /**
     * @Route("/admin/", name="admin")
     */
    public function addRecette(Request $request, EntityManagerInterface $manager)
    {

        $recette = new Recette();

        $formAdd = $this->createForm(RecetteType::class, $recette);
        $formAdd->handleRequest($request);


        // Liste de toutes les recettes
        $repository = $this->getDoctrine()->getRepository(Recette::class);
        $listeRecette = $repository->findAll();

        
        if ($formAdd->isSubmitted() && $formAdd->isValid()) {
            
            $data = $formAdd->getData();
            
            $data->setDatepublication(new \DateTime());

            $manager->persist($data);
            $manager->flush();
            
            return $this->redirectToRoute('ajouterIng', ['idRecette' => $data->getIdrecette()]);


        }

        return $this->render('security/admin.html.twig', [
            "formAdd" => $formAdd->createView(),
            "listeRecette" => $listeRecette
        ]);
    }

    /**
     * @Route("/admin/ajouterIng/{idRecette}", name="ajouterIng")
     */
    public function ajouterIng(Request $request, Recette $idRecette, EntityManagerInterface $manager){
        $recetteIng= new RecetteIngredient();
        $recetteIng->setIdrecette($idRecette);

        $formAddIng = $this->createForm(RecetteIngredientType::class, $recetteIng);
        $formAddIng->handleRequest($request);

        // Liste des ingrédients
        $repository = $this->getDoctrine()->getRepository(Ingredient::class);
        $ingredients = $repository->findAll();

// dd($formAddIng);
        if ($formAddIng->isSubmitted() && $formAddIng->isValid()) {
            // toutes les infos passent sauf ing    veut mettre post dans data

            $data = $formAddIng->getData();

            $idIng= $_POST['ingredient'];

            $getIng= $data->getIding();
            $getIng= $idIng;
          
            // dd($getIng);

            
// dd($data);
            
            $manager->persist($data);
            $manager->flush();
            
            return $this->redirectToRoute('index');


        }

     
        return $this->render('security/ajouterIng.html.twig', [
            "formAddIng" => $formAddIng->createView(),
            "listeIng"  => $ingredients
        ]);
    }


    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function supprimer($id): Response
    {
        $recetteManager = $this->getDoctrine()->getManager();
        $recette = $recetteManager->getRepository(Recette::class)->find($id);

        $recetteManager->remove($recette);
        $recetteManager->flush();


        return $this->redirectToRoute('admin');
    }


    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function modifier($id): Response
    {

        return $this->render('recette/admin.html.twig', []);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('recette/contact.html.twig', []);
    }



    // controller nav, géner do vu, faire appel méthode du contro dans twig grace doc
}
