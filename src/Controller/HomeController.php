<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(CarsRepository $repo): Response
    {
        $cars = $repo->findBy(array('transmission' => "Automatique"), array('price' => 'DESC'),5,0);

        $categories = $repo->distinctCategories();

        return $this->render('home.html.twig', [
            "cars" => $cars,
            "category" => $categories
        ]);
    }
}
