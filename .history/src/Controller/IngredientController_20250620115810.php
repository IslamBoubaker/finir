<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController

{
    
#[Route('/ingredient', name: 'app_ingredient')]
public function index(IngredientRepository $ingredientRepository): Response


{
    $ingredients = $ingredientRepository->findAll();
 
 
return $this->render('pages/ingredient/index.html.twig', [
'controller_name' => 'IngredientController',
]);
    
}
    #[Route('/ingredient/{id}', name: 'app_ingredient_show')]
    public function show(int $id, IngredientRepository $ingredientRepository): Response
    {
        $ingredient = $ingredientRepository->find($id);
        
        if (!$ingredient) {
            throw $this->createNotFoundException('Ingredient not found');
        }
        
        return $this->render('pages/ingredient/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }







}