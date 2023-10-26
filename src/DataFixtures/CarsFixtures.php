<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Cars;
use App\Entity\Images;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
;

class CarsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();

        $brands = ["Volkswagen", "Alfa Romeo", "BMW", "Audi", "Toyota", "Porsche", "Lamborghini", "Ford"];

        $modelVW = ["Golf", "Passat", "Jetta", "Tiguan"];
        $imagesVW = ["https://i.pinimg.com/originals/03/5c/6d/035c6d9e39fe11852356f5d9d39bb015.png", "https://i.pinimg.com/originals/5f/cc/fa/5fccfac04b16562e72515dc9a287fb40.png", "https://www.pngplay.com/wp-content/uploads/13/Volkswagen-Jetta-PNG-Free-File-Download.png", "https://images.dealer.com/ddc/vehicles/2023/Volkswagen/Tiguan/SUV/perspective/front-left/2023_76.png"];
        $modelAlfa = ["Giulia", "Stelvio", "Giulietta", "4C"];
        $imagesAlfa = ["https://www.real-luxury.com/media/tz_portfolio_plus/article/cache/noleggio-alfa-romeo-giulia-quadrifoglio-41-1_xl.png", "https://www.motortrend.com/uploads/sites/10/2022/09/2021-alfa-romeo-stelvio-ti-4wd-suv-angular-front.png", "https://i.pinimg.com/originals/4a/fb/96/4afb967a7ba4700b16126a103fcdbbe3.png", "https://purepng.com/public/uploads/large/purepng.com-alfa-romeo-4c-carcarvehicletransportalfa-romeo-961524665177igoln.png"];
        $modelBMW = ["3 Series", "5 Series", "X5", "7 Series"];
        $imagesBMW = ["https://cdn2.webdamdb.com/md_k2CWoy7NcZj23gFr.png?1630706876", "https://s3.amazonaws.com/cka-dash/180-0921-SBM872/jellybean-1.png", "https://www.bmw.fr/content/dam/bmw/common/all-models/x-series/x5/2018/navigation/bmw-g05-x5-modellfinder.png.asset.1528293281595.png", "https://purepng.com/public/uploads/large/purepng.com-bmw-7-series-carcarbmwvehicletransport-961524660822bix0u.png"];
        $modelAudi = ["A4", "Q5", "A6", "Q7"];
        $imagesAudi = ["https://i.pinimg.com/originals/73/09/7a/73097a07ed9d8becca73dc192967c1a8.png", "https://i.pinimg.com/originals/ce/5a/5b/ce5a5b53a19ddfb2ddd22da1d1d70a6e.png", "https://crdms.images.consumerreports.org/c_lfill,w_720,q_auto,f_auto/prod/cars/cr/model-years/15101-2023-audi-a6", "https://purepng.com/public/uploads/large/purepng.com-audi-q7-caraudicars-961524670848felfc.png"];
        $modelToyota = ["Camry", "Corolla", "RAV4", "Tacoma"];
        $imagesToyota = ["https://i.pinimg.com/originals/56/f7/55/56f755ce852fc23de4ca0dd6e74361ea.png", "https://freepngimg.com/download/vehicle/84665-car-2017-corolla-toyota-family-download-free-image.png", "https://i.pinimg.com/originals/dc/52/d9/dc52d9e7e8454705646a7231d2c6b4bb.png", "https://65e81151f52e248c552b-fe74cd567ea2f1228f846834bd67571e.ssl.cf1.rackcdn.com/ldm-images/2018-Toyota-Tacoma-SR.png"];
        $modelPorsche = ["911", "Cayenne", "Panamera", "Macan"];
        $imagesPorsche = ["https://cka-dash.s3.amazonaws.com/014-0819-CPO835/model1.png", "https://cdn.botb.com/media/g3umer5b/porsche-cayenne-botb-2023-carousel.png", "https://purepng.com/public/uploads/large/purepng.com-black-porsche-panamera-carcarvehicletransportporsche-961524660080ezwd4.png", "https://purepng.com/public/uploads/large/purepng.com-red-porsche-macan-gts-carcarvehicletransportporsche-961524653732vwswi.png"];
        $modelLambo = ["Aventador", "Huracan", "Urus", "Gallardo"];
        $imagesLambo = ["https://i.pinimg.com/originals/b9/66/a5/b966a5c2532ef37a1c03b463b6286279.png", "https://purepng.com/public/uploads/large/purepng.com-lamborghini-huracan-carcarvehicletransportlamborghini-961524662219yiinh.png", "https://www.motortrend.com/uploads/sites/5/2020/06/2020-lamborghini-urus.png", "https://i.pinimg.com/originals/b3/7b/86/b37b86a23eb4a02428c454d5c28bba27.png"];
        $modelFord = ["Mustang", "F-150", "Escape", "Focus"];
        $imagesFord = ["https://i.pinimg.com/originals/a1/0e/19/a10e19c0354de63803091dedd6dba0ca.png", "https://i.pinimg.com/originals/7e/b5/5c/7eb55c7901917a52b62142454b78900c.png", "https://images.dealer.com/ddc/vehicles/2020/Ford/Escape/SUV/perspective/front-left/2020_24.png", "https://i.pinimg.com/originals/85/c4/bc/85c4bc3f7a6723fc24ba06c45a2d4e1a.png"];

        
        $fuels = ["Essence", "Diesel", "Electrique"];
        $transmissions = ["Manuel", "Automatique"];

        for ($i=1; $i <= 60; $i++) { 
            $car = new Cars();
            $brand = $faker->randomElement($brands);
            $fuel = $faker->randomElement($fuels);
            $transmission = $faker->randomElement($transmissions);
            $description = $faker->paragraph(4);

            $alea = rand(0,3);

            if($brand == "Volkswagen"){
                $model = $modelVW[$alea];
                $coverImg = $imagesVW[$alea];
            }else if($brand == "Alfa Romeo"){
                $model = $modelAlfa[$alea];
                $coverImg = $imagesAlfa[$alea];
            }else if($brand == "BMW"){
                $model = $modelBMW[$alea];
                $coverImg = $imagesBMW[$alea];
            }else if($brand == "Audi"){
                $model = $modelAudi[$alea];
                $coverImg = $imagesAudi[$alea];
            }else if($brand == "Toyota"){
                $model = $modelToyota[$alea];
                $coverImg = $imagesToyota[$alea];
            }else if($brand == "Porsche"){
                $model = $modelPorsche[$alea];
                $coverImg = $imagesPorsche[$alea];
            }else if($brand == "Lamborghini"){
                $model = $modelLambo[$alea];
                $coverImg = $imagesLambo[$alea];
            }else{
                $model = $modelFord[$alea];
                $coverImg = $imagesFord[$alea];
            }
            

            $car->setBrand($brand)
                ->setModel($model)
                ->setCoverImage($coverImg)
                ->setKilometers(rand(0,100000))
                ->setPrice(rand(12500, 200000))
                ->setOwners(rand(1,6))
                ->setEngineCylinder(rand(1000,1600))
                ->setPower(rand(30,800))
                ->setFuel($fuel)
                ->setReleaseYear(rand(2006,2023))
                ->setTransmission($transmission)
                ->setDescription($description)
                ->setOptions('<p>'.join("<p></p>",$faker->paragraphs(3)).'</p>');

                //Gestion des images des produits
                for ($g=1; $g <= rand(3,5) ; $g++) { 
                    $image = new Images();
                    $image->setUrl('https://picsum.photos/id/'.$g.'/900')
                        ->setCaption($faker->sentence())
                        ->setCars($car);
                    $manager->persist($image);
                }

            $manager->persist($car);
        }



        $manager->flush();
    }
}
