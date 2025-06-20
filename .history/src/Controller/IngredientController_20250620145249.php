<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ingredient')]
class IngredientController extends AbstractController
{
    #[Route('/', name: 'app_ingredient_index')]
    public function index(IngredientRepository $repo): Response
    {
        return $this->render('pages/ingredient/index.html.twig', [
            'ingredients' => $repo->findAll()
        ]);
    }

    #[Route('/nouveau', name: 'app_ingredient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ingredient);
            $em->flush();
            $this->addFlash('success', 'Ingrédient créé avec succès');
            return $this->redirectToRoute('app_ingredient_index');
        }

        return $this->render('pages/ingredient/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_ingredient_edit', methods: ['GET', 'POST'])]
    public function edit(Ingredient $ingredient, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ingrédient modifié avec succès');
            return $this->redirectToRoute('app_ingredient_index');
        }

        return $this->render('pages/ingredient/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/supprimer/{id}', name: 'app_ingredient_delete', methods: ['GET'])]
    public function delete(Ingredient $ingredient, EntityManagerInterface $em): Response
    {
        $em->remove($ingredient);
        $em->flush();
        $this->addFlash('success', 'Ingrédient supprimé avec succès');
        return $this->redirectToRoute('app_ingredient_index');
    }
}
