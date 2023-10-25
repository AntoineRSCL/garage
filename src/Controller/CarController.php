<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Repository\CarsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    /**
     * Affiche toutes les voitures du site
     *
     * @param CarsRepository $repo
     * @return Response
     */
    #[Route('/cars', name: 'cars_index')]
    public function index(CarsRepository $repo): Response
    {
        $cars = $repo->findAll();
        $categories = $repo->distinctCategories();
        
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'brand' => "",
            'logoBrand' => "",
            'categories' => $categories
        ]);
    }

    #[Route("/cars/{slug_brand}", name: 'cars_brand')]
    public function brand(string $slug_brand, CarsRepository $repo): Response
    {
        $cars = $repo->findBy(array('slugBrand' => $slug_brand));
        $url_brand = $repo->findBy(array('slugBrand' => $slug_brand),array('price' => 'ASC'),1 ,0)[0];
        $categories = $repo->distinctCategories();

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'brand' => $slug_brand,
            'logoBrand' => $url_brand,
            'categories' => $categories
        ]);
    }

    #[Route("/car/{id}", name: "car_show")]
    public function show(int $id, Cars $car): Response
    {
        return $this->render("car/show.html.twig", [
            'car' => $car
        ]);
    }


}
