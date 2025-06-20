<?php


namespace App\Controller;

use App\Repository\IngredientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient', methods: ['GET'])]
    
    
    /**
        * This function 
        *
        * @param IngredientRepository $ingredientRepository The repository to fetch ingredients.
        * @param Request $request The current request object.
        * @param PaginatorInterface $paginator The paginator service for pagination.
        *
        * @return Response The rendered template with the list of ingredients.
        */
    public function index(
        IngredientRepository $ingredientRepository,
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        $ingredients = $paginator->paginate(
            $ingredientRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }
}
