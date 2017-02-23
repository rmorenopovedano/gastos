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

class MesFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                )), true);
//            ->add('search', SubmitType::class, array('label' => 'Buscar'));
    }
    


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_movimiento';
    }


}
