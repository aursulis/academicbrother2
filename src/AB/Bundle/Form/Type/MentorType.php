<?php
namespace AB\Bundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MentorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName');
        $builder->add('lastName');
        $builder->add('email', 'email', array(
            'required' => 'true'
        ));
        $builder->add('homeCity');
        $builder->add('about');

        $builder->add('schoolName');
        $builder->add('schoolGraduationYear');
        $builder->add('schoolCity');

        $builder->add('courses', 'collection', array(
        			  'type' => new CourseType(),
        			  'allow_add' => true,
        			  'allow_delete' => true,
                      'options'  => array(
                        'required'  => true,
                        //'attr'      => array('class' => 'email-box')
                      ),
		));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AB\Bundle\Entity\Mentor'
        ));
    }

    public function getName()
    {
        return 'mentor';
    }
}