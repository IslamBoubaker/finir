<?php

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class IngredientController extends AbstractController

{
    
#[Route('/ingredient', name: 'app_ingredient')]
public function index(IngredientRepository $ingredientRepository): Response


{
    $ingredients = $ingredientRepository->findAll();
 
 
// return $this->render('pages/ingredient/index.html.twig', [
// 'controller_name' => 'IngredientController',
// ]);
   
        return $this->render('pages/ingredient/new.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }







}