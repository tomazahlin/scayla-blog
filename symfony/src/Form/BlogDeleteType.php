<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogDeleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($options['action_url'])
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Delete',
                'attr' => array(
                    'onclick' => 'return confirm("Are you sure you want to delete this blog?")'
                )));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['action_url'])
            ->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
