<?php

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class IngredientController extends AbstractController

{
    
#[Route('/ingredient/new', name: 'ingredient_new')]
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
        'form' => $form->createView(), // ✅ CECI EST OBLIGATOIRE
    ]);
}



}