<?php
namespace AB\Bundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PupilRegistrationType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName');
        $builder->add('lastName');
        $builder->add('homeCity');
        $builder->add('schoolName');
        $builder->add('schoolGraduationYear');
        $builder->add('schoolCity');
        $builder->add('schoolGrade', 'number');

        $builder->add('courseCategory');
        $builder->add('universityRegion', 'choice', array (
            'choices' => array('England' => 'Anglija',
                'London' => 'Londonas',
                'Scotland' => 'Škotija',
                'Other' => 'kitas/bet kuris'
            )
        ));
        $builder->add('courseName');
        $builder->add('motivation');
        $builder->add('about');
        $builder->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AB\Bundle\Entity\Pupil'
        ));
    }

    public function getName()
    {
        return 'pupil_registration';
    }
}