<?php

namespace App\Controller;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
   
    /**
     * @Route("/", name="base")
     */
    public function base(): Response
    {
        // Liste de toutes les catégories
        $repository= $this->getDoctrine()->getRepository(Categorie::class);
        $categories= $repository->findAll();
// dd($categories);
        return $this->render('base/nav.html.twig', [
            'listCateg' => $categories,
        ]);
    }

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
 