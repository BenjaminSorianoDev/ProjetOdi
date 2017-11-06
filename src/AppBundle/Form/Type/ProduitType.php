<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\Type\DateTimePickerType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $builder
            ->setMethod($options["method"])

            ->add('ref_produit',TextType::class, 
                  array('required' => true, 'label' => 'Référence'))  
            
            ->add('nom_produit',TextType::class, 
                  array('required' => true, 'label' => 'Nom'))	

            ->add('description_produit', TextType::class, 
                  array('required' => true, 'label' => 'Description'))

            ->add('categorie_produit', ChoiceType::class, 
                  array('choices' => array('Papeterie' => 'Papeterie', 'Plastique' => 'Plastique'), 'required' => true, 'label' => 'Catégorie'))

            ->add('quantite_produit',NumberType::class, 
                  array('required' => true, 'label' => 'Quantité')) 

            ->add('quantite_min_produit', NumberType::class, 
                  array('required' => true, 'label' => 'Quantité minimale (seuil d\'alerte)'))

            ->add('date_peremption_produit', DateTimePickerType::class , 
                  array('required' => true, 'label' => 'Date Limite', 'format' => 'dd/MM/yyyy'))

            ->add('prix_produit', NumberType::class, 
                  array('required' => true, 'label' => 'Prix'))

            ->add('photo_produit', FileType::class,
                  array('required' => false, 'label' => 'Photo', 'data_class' => null))

            ->add('visible_produit', ChoiceType::class, 
                  array('choices' => array('Visible' => 1, 'Invisible' => 0), 'required' => true, 'label' => 'Catégorie'))

            ->add('save', SubmitType::class, 
                  array('label' => 'Ajouter', 'attr' => array('class' => 'btn btn-primary')));
    }
}