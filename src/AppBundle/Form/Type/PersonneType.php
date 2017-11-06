<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PersonneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod($options["method"])

            ->add('pseudo_personne', TextType::class, 
                  array('required' => true, 'label' => 'Pseudo'))

            ->add('mdp_personne', PasswordType::class, 
                  array('required' => true, 'label' => 'Mot de passe'))

            ->add('type_personne', ChoiceType::class, 
                  array('choices' => array('Client' => 'Client', 'Magasinier' => 'Magasinier'), 'required' => true, 'label' => 'Type de personne'))

            ->add('save', SubmitType::class, 
                  array('label' => 'Ajouter', 'attr' => array('class' => 'btn btn-primary')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Personne'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_personne';
    }


}
