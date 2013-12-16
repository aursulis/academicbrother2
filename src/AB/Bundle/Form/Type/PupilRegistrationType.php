<?php
namespace AB\Bundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\True;

class PupilRegistrationType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName');
        $builder->add('lastName');
        $builder->add('email', 'email', array(
            'required' => 'true'
        ));
        $builder->add('plainPassword', 'repeated', array(
                'type' => 'password',
//                'first_options' => array('label' => 'Slaptažodis:'),
//                'second_options' => array('label' => 'Pakartoti:'),
                'invalid_message' => 'Slaptažodžiai nesutampa',
            )
        );

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

        $builder->add('terms', 'checkbox', array(
                'mapped' => false,
                "constraints" => new True(array(
                            "message" => "Please accept the Terms and conditions in order to register")
                    ))
        );
        $builder->add('save', 'submit');


//        $builder->addEventListener(
//            FormEvents::PRE_SUBMIT,
//            function(FormEvent $event) {
//                $form = $event->getForm();
//
//
//                $data = $event->getData();
//
//
//
//
//
//            }
//        );
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