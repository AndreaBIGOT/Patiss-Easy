<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\Categorie;
use App\Form\RecetteType;
use App\Entity\Ingredient;
use App\Entity\Preparation;
use App\Entity\RecetteIngredient;
use App\Form\RecetteIngredientType;
use App\Form\RecettePreparationType;
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
     * @Route("/recettes/categ/{idCateg}", name="recettes")
     */
    public function recettes(Categorie $idCateg =null, EntityManagerInterface $manager): Response
    {
        // Liste de toutes les recettes
        $repository = $this->getDoctrine()->getRepository(Recette::class);
        // $recettes = $repository->findAll();

        
        $recettes = $manager->createQuery(
            'SELECT r, c
            FROM App\Entity\Recette r
            INNER JOIN r.idcateg c
            WHERE c.idcateg = :id'
        )->setParameter('id', $idCateg);

        // $query = $recettes->getQuery();
        $recettes= $recettes->execute();
        

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
            
            return $this->redirectToRoute('ajouterPrep', ['idRecette' => $data->getIdrecette()]);

        }

        return $this->render('security/admin.html.twig', [
            "formAdd" => $formAdd->createView(),
            "listeRecette" => $listeRecette
        ]);
    }

    /**
     * @Route("/admin/ajouterPrep/{idRecette}", name="ajouterPrep")
     */
    public function ajouterPrep(Request $request, Recette $idRecette, EntityManagerInterface $manager){
        $recettePrep= new Preparation();
        $recettePrep->setIdrecette($idRecette);
      
        $formAddPrep = $this->createForm(RecettePreparationType::class, $recettePrep);
        $formAddPrep->handleRequest($request);

        if ($formAddPrep->isSubmitted() && $formAddPrep->isValid()) {
            // toutes les infos passent sauf ing    veut mettre post dans data

            $data = $formAddPrep->getData();
            
            $manager->persist($recettePrep);
            $manager->flush();
            
            return $this->redirectToRoute('ajouterIng', ["idRecette" => $idRecette->getIdrecette()]);
        }

     
        return $this->render('security/ajouterPrep.html.twig', [
            "formAddPrep" => $formAddPrep->createView()
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

        if ($formAddIng->isSubmitted() && $formAddIng->isValid()) {
            // toutes les infos passent sauf ing    veut mettre post dans data

            $data = $formAddIng->getData();
            
            $manager->persist($recetteIng);
            $manager->flush();
            
            return $this->redirectToRoute('ajouterIng', ["idRecette" => $idRecette->getIdrecette()]);
        }

     
        return $this->render('security/ajouterIng.html.twig', [
            "formAddIng" => $formAddIng->createView()
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
