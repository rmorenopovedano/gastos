<?php

namespace AppBundle\Form;

use AppBundle\Entity\Movimiento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class MovimientoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
                    'label'=>"Movimiento",
                    'empty_data'=>null
            ])
            ->add('descripcion', TextType::class)
            ->add('mes', ChoiceType::class, array(
                'choices' => array(
                    Movimiento::ENERO => Movimiento::ENERO,
                    Movimiento::FEBRERO=> Movimiento::FEBRERO,
                    Movimiento::MARZO=> Movimiento::MARZO,
                    Movimiento::ABRIL=> Movimiento::ABRIL,
                    Movimiento::MAYO=> Movimiento::MAYO,
                    Movimiento::JUNIO=> Movimiento::JUNIO,
                    Movimiento::JULIO=> Movimiento::JULIO,
                    Movimiento::AGOSTO=> Movimiento::AGOSTO,
                    Movimiento::SEPTIEMBRE=> Movimiento::SEPTIEMBRE,
                    Movimiento::OCTUBRE=> Movimiento::OCTUBRE,
                    Movimiento::NOVIEMBRE=> Movimiento::NOVIEMBRE,
                    Movimiento::DICIEMBRE=> Movimiento::DICIEMBRE,
                )), true)
            ->add('cantidad', MoneyType::class, [
                'error_bubbling' => true,
                'constraints' => [
                    new Regex(array('pattern'=>'/\d+(\.\d+)?/','message'=>'must be numeric')),
                ]
            ])
            ->add('tipo', EntityType::class, [
                'class'=>'AppBundle\Entity\TipoMovimiento',
                'choice_label'=>'nombre',
                'label'=>'Tipo',
            ])
            ->add('add', SubmitType::class, array('label' => 'Añadir'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Movimiento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_movimiento';
    }


}
