<?php

namespace App\Controller;
use App\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends AbstractController
{
    /**
     * @Route("/recetteTheme", name="recetteTheme")
     */
    public function index(): Response
    {
        // Liste de toutes les catégories
        $repository= $this->getDoctrine()->getRepository(Theme::class);
        $themes= $repository->findAll();

        return $this->render('recette/recetteTheme.html.twig', [
            'listTheme' => $themes,
        ]);
    }

    /**
     * @Route("/recetteTheme", name="recetteTheme")
     */
    public function listeTheme(): Response
    {
        // Liste de toutes les catégories
        $repository= $this->getDoctrine()->getRepository(Theme::class);
        $themes= $repository->findAll();

        return $this->render('recette/recetteTheme.html.twig', [
            'listeThemes' => $themes,
        ]);
    }
}
