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

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngredientRepository $ingredientRepository): Response
    {
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredientRepository->findAll(),
        ]);
    }

    #[Route('/ingredient/new', name: 'app_ingredient_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ingredient);
            $em->flush();

            $this->addFlash('success', 'Ingrédient ajouté avec succès !');
            return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('ingredient/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ingredient/edition/{id}', name: 'app_ingredient_edit')]
    public function edit(
        int $id,
        IngredientRepository $ingredientRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $ingredient = $ingredientRepository->findOneBy(['id' => $id]);

        if (!$ingredient) {
            throw $this->createNotFoundException("Ingrédient non trouvé");
        }

        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Ingrédient modifié avec succès !');
            return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('ingredient/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
