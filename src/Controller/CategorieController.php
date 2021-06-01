<?php

namespace App\Controller;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{

    /**
     * @Route("/recetteCategorie", name="recetteCategorie")
     */
    public function test(): Response
    {
        // Liste de toutes les catégories
        $repository= $this->getDoctrine()->getRepository(Categorie::class);
        $categories= $repository->findAll();

        return $this->render('recette/recetteCategorie.html.twig', [
            'listCateg' => $categories,
        ]);
    }
}
 