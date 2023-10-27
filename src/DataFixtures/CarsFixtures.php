<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Cars;
use App\Entity\User;
use App\Entity\Images;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
;

class CarsFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();

        $brands = ["Volkswagen", "Alfa Romeo", "BMW", "Audi", "Toyota", "Porsche", "Lamborghini", "Ford"];

        $users = []; //Init d'un tableau pour recup des users pour les annonces
        $genres = ['male', "femelle"];

        //Création des membres
        for ($u=1; $u <= 10; $u++) { 
            $user = new User();
            $genre = $faker->randomElement($genres);

            $hash = $this->passwordHasher->hashPassword($user, 'StandardChampion');

            $user->setFirstName($faker->firstName($genre))
                ->setLastName($faker->lastName())
                ->setEmail($faker->email())
                ->setIntroduction($faker->sentence())
                ->setDescription('<p>'.join('</p><p>', $faker->paragraphs(5)).'</p>')
                ->setPassword($hash)
                ->setPicture('');

            $manager->persist($user);

            $users[] = $user; // ajouter un user au tableau(pour les annonces)
        }

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
                $multiplicateur = 1;
                $images = ["https://images.caradisiac.com/images/5/2/1/4/185214/S0-volkswagen-devoile-l-interieur-de-l-id-4-641931.jpg", "https://images.caradisiac.com/images/5/2/1/4/185214/S0-volkswagen-devoile-l-interieur-de-l-id-4-641929.jpg", "https://pimdieprodstor02.blob.core.windows.net/dam01/Factories/Volkswagen/Images/000019819C_jpg-20221028_022247-default.png", "https://img-4.linternaute.com/G1myLAw50T1Xn6ve7M58Id0T3y8=/1240x/smart/d50ce2abfe794527baff7215ef6532a7/ccmcms-linternaute/12214030.jpg", "https://cdn.motor1.com/images/mgl/koBpnN/s1/2024-volkswagen-id.4-interior-updates.webp"];
            }else if($brand == "Alfa Romeo"){
                $model = $modelAlfa[$alea];
                $coverImg = $imagesAlfa[$alea];
                $multiplicateur = 3;
                $images = ["https://www.automobiledimension.com/photos/interior/alfa-romeo-giulietta-2016-dashboard.jpg", "https://www.automobile-magazine.fr/asset/cms/57840/config/38772/comme-la-mito-la-giulietta-peut-recevoir-une-boite-a-double-embrayage-tct.jpg", "https://www.asphalte.ch/Auto/Alfa_Romeo_Giulietta/Alfa_Romeo_Giulietta_13.jpg", "https://media.paruvendu.fr/cms/pictures//2010111815121271.jpg", "https://www.petwareshop.com/images/stories/virtuemart/product/alf1gacc-alfa-romeo-giulietta-2010-5-door-hatchback-carbox-classic-yoursize-high-sided-boot-liner-1.jpg"];
            }else if($brand == "BMW"){
                $model = $modelBMW[$alea];
                $coverImg = $imagesBMW[$alea];
                $multiplicateur = 2;
                $images = ["https://www.largus.fr/images/images/bmw330i-m-sport-portimao-blue-mettallic-0518-1.jpg", "https://static.moniteurautomobile.be/imgcontrol/images_tmp/clients/moniteur/c680-d465/content/medias/images/news/41000/300/30/p90479632_highres_the-new-bmw-m340i-xd.jpg", "https://mediapool.bmwgroup.com/cache/P9/201901/P90335838/P90335838-the-new-bmw-745le-interieur-02-2019-2250px.jpg", "https://cdn.pixabay.com/photo/2023/05/03/14/47/bmw-7967852_1280.jpg", "https://www.bmw.be/fr/shop/ls/images/connected-drive/xl/Seat_Heating_SFA/images/220516161_FoD_Seat_Heating_FSA_902x508.jpg"];
            }else if($brand == "Audi"){
                $model = $modelAudi[$alea];
                $coverImg = $imagesAudi[$alea];
                
                $multiplicateur = 2;
                $images = ["https://media.audifrance.fr/wp-content/uploads/2023/09/07876e3a335a741fd2511dab33150de9-2000x1500.jpg", 'https://cdn-s-www.lalsace.fr/images/A6E5CC4F-DEB7-4222-8FDE-0F40E75A4FFA/NW_raw/l-interieur-de-l-audi-a3-sportback-est-sportif-photo-sp-audi-1585669308.jpg', "https://www.gaillardauto.com/content/uploads/2021/02/audia3-sportback-interieur-1024x436.jpg", "https://www.largus.fr/images/2022-10/sieges-baquets-audi-rs3-edition-performance.jpg", "https://www.schwartz-auto-moto.com/wp-content/uploads/2020/10/fd916daa985960f3ffeebef428490075b8498b7d.jpg"];
            }else if($brand == "Toyota"){
                $model = $modelToyota[$alea];
                $coverImg = $imagesToyota[$alea];
                $multiplicateur = 1;
                $images = ["https://images.caradisiac.com/images/7/1/3/3/167133/S1-surprise-voici-l-interieur-de-la-nouvelle-toyota-auris-548145.jpg", "https://photos.tf1.fr/1200/720/l-interieur-toyota-c-hr-devoile-3-a2bbfa-0@1x.jpg", "https://voiture.kidioui.fr/blog/wp-content/uploads/2018/09/toyota-auris-interieur.jpg", "https://static.moniteurautomobile.be/clients/moniteur/content/medias/images/news/38000/700/30/corolla_interieur.jpg", "https://www.largus.fr/images/images/toyota-ch-r-gr-sport-8.jpg"];
            }else if($brand == "Porsche"){
                $model = $modelPorsche[$alea];
                $coverImg = $imagesPorsche[$alea];
                $multiplicateur = 6;
                $images = ["https://assets-v2.porsche.com/be/-/media/Project/PCOM/SharedSite/PorscheExclusiveManufaktur/PackageClassic/021-overscroll_16-9_leather-interior-black.jpg?rev=6c210593eecd41e2aa4cc26d3c1e934f&w=1299", "https://i.gaw.to/content/photos/56/75/567594-le-porsche-cayenne-2024-en-mettra-plein-la-vue-a-l-interieur.jpeg", "https://cdn.motor1.com/images/mgl/qPonG/s1/topcar-panamera.jpg", "https://img-4.linternaute.com/lO6qlyrDQlAGHMuZez9dz4cKTeg=/1240x/smart/82bc703329df484dae50b5bde70385b9/ccmcms-linternaute/11090524.jpg", "https://www.renovation-du-cuir.fr/forum/images/134_1.jpg"];
            }else if($brand == "Lamborghini"){
                $model = $modelLambo[$alea];
                $coverImg = $imagesLambo[$alea];
                $multiplicateur = 8;
                $images = ["https://www.lamborghini.com/sites/it-en/files/DAM/lamborghini/facelift_2019/model_detail/urus/urus_s/s/s_2_m.jpg", "https://www.challenges.fr/assets/img/2017/12/04/images_list-r4x3w1000-5a2585751b737-lambo-urus-officialy-unveiled-4-jpg.jpg", "https://www.automobiledimension.com/photos/interior/lamborghini-huracan-sto-2021-dashboard.jpg", "https://pachir-art.fr/wp-content/uploads/2022/03/photo_exposition_automobile_lambo_huracan.jpg", "https://www.topgear-magazine.fr/wp-content/uploads/2019/08/Lamborghini-Huracan-Evo-04.jpg"];
            }else{
                $model = $modelFord[$alea];
                $coverImg = $imagesFord[$alea];
                $multiplicateur = 2;
                $images = ["https://www.fr.ford.be/content/dam/guxeu/rhd/central/cars/2021-fiesta/launch/features/ford-fiestaMCA-eu-2021_FORD_FIESTA_STUDIO_INTERIOR_16_1-16x9-2160x1215-gt3.jpg.renditions.original.png", "https://www.fr.ford.be/content/dam/guxeu/rhd/central/cars/2019-puma/pre-launch/gallery/interior/9x8/ford-puma-eu-BX726_19MY_CHS-99_SHOT_18_0050-1-9x8-1200x1066-Gallery_D_T_M.jpg.renditions.original.png", "https://i.pinimg.com/736x/f1/c5/f6/f1c5f68992072af44040f12007e7f066.jpg", "https://www.fr.ford.be/content/dam/guxeu/rhd/central/cars/2019-kuga/launch/gallery/interior/9x8/ford-KugaFHEV-eu-SHOT_07_KUGA_FHEV_Interior_Wide-9x8-1200x1066-bg.jpg.renditions.original.png", "https://images.caradisiac.com/logos/3/3/8/4/263384/S8-aux-etats-unis-le-ford-f150-lance-les-sieges-couchette-186460.jpg"];
            }
            
            //liaison avec l'user
            $user = $users[rand(0, count($users)-1)];

            $nbPhoto = 0;

            $car->setBrand($brand)
                ->setModel($model)
                ->setCoverImage($coverImg)
                ->setKilometers(rand(0,100000))
                ->setPrice(rand(12500, 25000)*$multiplicateur)
                ->setOwners(rand(1,6))
                ->setEngineCylinder(rand(1000,1600))
                ->setPower(rand(30,75)*$multiplicateur)
                ->setFuel($fuel)
                ->setReleaseYear(rand(2006,2023))
                ->setTransmission($transmission)
                ->setDescription($description)
                ->setOptions('<p>'.join("<p></p>",$faker->paragraphs(3)).'</p>')
                ->setSeller($user);

                //Gestion des images des produits
                for ($g=1; $g <= rand(3,5) ; $g++) { 
                    $img = $images[$nbPhoto];

                    $image = new Images();
                    $image->setUrl($img)
                        ->setCaption($faker->sentence())
                        ->setCars($car);
                    $manager->persist($image);

                    $nbPhoto = $nbPhoto + 1;
                }

            $manager->persist($car);
        }



        $manager->flush();
    }
}
