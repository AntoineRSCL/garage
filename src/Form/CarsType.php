<?php

namespace App\Form;

use App\Entity\Cars;
use App\Form\ImageType;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CarsType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class, $this->getConfiguration('Marque', "Donnez la marque de la voiture"))
            ->add('model', TextType::class, $this->getConfiguration('Modele', "Donnez le modèle de la voiture"))
            ->add('coverImage', UrlType::class, $this->getConfiguration('Url de l\'image', "Donnez l'adresse de l'image de votre voiture"))
            ->add('kilometers', IntegerType::class, $this->getConfiguration('Nombre de km', "Donnez le nombre de kilomètres de la voiture"))
            ->add('price', MoneyType::class, $this->getConfiguration('Prix', "Donnez le prix de la voiture"))
            ->add('owners', IntegerType::class, $this->getConfiguration('Nombre d\' anciens propriétaires', "Donnez le nombre d'anciens propriétaires de la voiture"))
            ->add('engineCylinder', IntegerType::class, $this->getConfiguration('Cylindrée', "Donnez le nombre du cylindrée de la voiture"))
            ->add('power', IntegerType::class, $this->getConfiguration('Nombre de chevaux', "Donnez le nombre de chevaux de la voiture"))
            ->add('fuel', TextType::class, $this->getConfiguration('Donnez le carburant', "Donnez le type de carburant de la voiture"))
            ->add('releaseYear', IntegerType::class, $this->getConfiguration('Année de sortie', "Donnez l'année de sortie de la voiture"))
            ->add('transmission', TextType::class, $this->getConfiguration('Transmission', "Donnez le type de transmission de la voiture"))
            ->add('description', TextType::class, $this->getConfiguration('Description', "Donnez une description de la voiture"))
            ->add('options', TextareaType::class, $this->getConfiguration('Options', "Donnez les options de la voiture"))
            ->add('urlBrand', UrlType::class, $this->getConfiguration('Url de l\'image de la marque', "Donnez l'adresse de l'image de la marque de la voiture"))
            ->add('images', CollectionType::class,[
                'entry_type'=>ImageType::class,
                'allow_add'=> true, //pour le data prototype
                'allow_delete'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
