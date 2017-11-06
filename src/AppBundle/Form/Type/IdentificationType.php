<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class IdentificationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->setMethod($options["method"])

            ->add('pseudo', TextType::class, 
                  array('required' => true, 'label' => 'Pseudo', 'attr' => array('name' => '_username')))

            ->add('mdp', PasswordType::class, 
                  array('required' => true, 'label' => 'Mot de passe', 'always_empty'=>true, 'attr' => array('name' => '_password')
                ))

            ->add('save', SubmitType::class, array('label' => 'Connexion', 'attr' => array('class' => 'btn btn-primary')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Identification'
        ));
    }
}