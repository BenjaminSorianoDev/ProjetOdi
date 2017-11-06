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

class ProduitsStocksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
        $builder
            ->setMethod($options["method"])

            ->add('quantite_produit',NumberType::class, 
                  array('required' => true, 'label' => 'Quantité'))	

            ->add('quantite_min_produit', NumberType::class, 
                  array('required' => true, 'label' => 'Quantité minimale (seuil d\'alerte)'))

            ->add('date_peremption_produit', DateTimePickerType::class , 
                  array('required' => true, 'label' => 'Date Limite', 'format' => 'dd/MM/yyyy'))

            ->add('save', SubmitType::class, 
                  array('label' => 'Enregistrer', 'attr' => array('class' => 'btn btn-primary')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array('stock')
        ));
    }
}