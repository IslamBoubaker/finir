<?php

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/ingredient/new', name: 'ingredient_new')]  

class IngredientController extends AbstractController
{
    #[Route('/', name: 'app_ingredient')]
    public function index(): Response
    {
        // This method would typically fetch and display a list of ingredients.
        return $this->render('pages/ingredient/index.html.twig');
    }

    #[Route('/new', name: 'app_ingredient_new')]
public function new(Request $request, EntityManagerInterface $em): Response
{
    $ingredient = new Ingredient();

    $form = $this->createForm(IngredientType::class, $ingredient);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($ingredient);
        $em->flush();

        return $this->redirectToRoute('app_ingredient');
    }

    return $this->render('pages/ingredient/new.html.twig', [
        'form' => $form->createView(),
    ]);
}
}