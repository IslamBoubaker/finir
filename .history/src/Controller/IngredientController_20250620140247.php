<?php

namespace App\Controller;

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class IngredientController extends AbstractController
{
    #[Route('/ingredients', name: 'app_ingredients')]
    public function index(
        Request $request,
        IngredientRepository $ingredientRepository,
        PaginatorInterface $paginator
    ): Response {
        $ingredients = $paginator->paginate(
            $ingredientRepository->findAll(),
            $request->query->getInt('page', 1),
            10 // nombre par page
        );

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
}