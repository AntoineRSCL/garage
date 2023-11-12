<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarsType;
use App\Repository\CarsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
        $admin = "";

        if($this->getUser()){
            if($this->getUser()->getRoles()[0] === "ROLE_ADMIN"){
                $admin = "ok";
            }
        }
        
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'brand' => "",
            'logoBrand' => "",
            'categories' => $categories,
            'admin' => $admin
        ]);
    }

    #[Route("cars/new", name:"cars_create")]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('account_login', []);
        }

        $car = new Cars();

        $form = $this->createForm(CarsType::class, $car);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //gestion des images
            foreach($car->getImages() as $image)
            {
                $image->setCars($car);
                $manager->persist($image);
            }

            //On ajoute l'user
            $car->setSeller($this->getUser());

            // je persiste mon objet Ad
            $manager->persist($car);
            // j'envoie les persistances dans la bdd
            $manager->flush();

            $this->addFlash('success', "L'annonce <strong>".$car->getBrand()." ".$car->getModel()." ".$car->getReleaseYear()."</strong> a bien été enregistrée");

            return $this->redirectToRoute('car_show',[
                'id' => $car->getId()
            ]);
        }

        return $this->render("car/new.html.twig", [
            "myForm" => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher tout les vehicules triés par marque
     *
     * @param string $slug_brand
     * @param CarsRepository $repo
     * @return Response
     */
    #[Route("/cars/{slug_brand}", name: 'cars_brand')]
    public function brand(string $slug_brand, CarsRepository $repo): Response
    {
        $cars = $repo->findBy(array('slugBrand' => $slug_brand));
        $url_brand = $repo->findBy(array('slugBrand' => $slug_brand),array('price' => 'ASC'),1 ,0)[0];
        $categories = $repo->distinctCategories();
        $admin = "";

        if($this->getUser()){
            if($this->getUser()->getRoles()[0] === "ROLE_ADMIN"){
                $admin = "ok";
            }
        }

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'brand' => $slug_brand,
            'logoBrand' => $url_brand,
            'categories' => $categories,
            "admin" => $admin
        ]);
    }

    /**
     * Permet de supprimer une annonce
     *
     * @param integer $id
     * @param Cars $car
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route("/car/{id}/delete", name: 'car_delete')]
    public function delete(int $id, Cars $car, EntityManagerInterface $manager): Response
    {
        if(!$this->getUser())
        {
            return $this->redirectToRoute('account_login', []);
        }
        if($car->getSeller()->getId() != $this->getUser()->getId())
        {
            if($this->getUser()->getRoles()[0] === "ROLE_ADMIN"){

            }else{
                return $this->render("bundles/TwigBundle/Exception/error403.html.twig", [
                    "exception" => ""
                ]);
            }
            
        }

        $this->addFlash(
            'danger',
            "L'annonce <strong>".$car->getId()."</strong> a bien été supprimée"
        );

        $manager->remove($car);
        $manager->flush();

        return $this->redirectToRoute('account');
    }

    /**
     * Permet d'afficher un produit 
     *
     * @param integer $id
     * @param Cars $car
     * @return Response
     */
    #[Route("/car/{id}", name: "car_show")]
    public function show(int $id, Cars $car, UserRepository $repos): Response
    {
        $sellerId = $car->getSeller();
        $user = $repos->findOneBy(array('id' => $sellerId));

        return $this->render("car/show.html.twig", [
            'car' => $car,
            'user' => $user
        ]);
    }

    /**
     * Permet de modifier une vente de voiture
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param Cars $car
     * @return Response
     */
    #[Route("/car/{id}/edit", name: "car_edit")]
    public function edit(Request $request, EntityManagerInterface $manager, Cars $car): Response
    {
        if(!$this->getUser())
        {
            return $this->redirectToRoute('account_login', []);
        }
        if($car->getSeller()->getId() != $this->getUser()->getId())
        {
            if($this->getUser()->getRoles()[0] !== "ROLE_ADMIN"){
                return $this->render("bundles/TwigBundle/Exception/error403.html.twig", [
                    "exception" => ""
                ]);
            }
        }

        $form = $this->createForm(CarsType::class, $car);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //gestion des images
            foreach($car->getImages() as $image)
            {
                $image->setCars($car);
                $manager->persist($image);
            }

            // je persiste mon objet Ad
            $manager->persist($car);
            // j'envoie les persistances dans la bdd
            $manager->flush();

            $this->addFlash(
                'warning',
                "L'annonce <strong>".$car->getBrand()." ".$car->getModel()." ".$car->getReleaseYear()."</strong> a bien été modifiée !"
            );

            return $this->redirectToRoute('car_show', [
                'id' => $car->getId()
            ]);
        }

        return $this->render("car/edit.html.twig", [
            "car" => $car,
            "myForm" => $form->createView()
        ]);

    }


}
