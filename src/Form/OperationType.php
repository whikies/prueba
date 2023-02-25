<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Service\Operation;

class OperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('operation', ChoiceType::class, [
                'choices'  => array_combine(Operation::values(), Operation::values()),
                'choice_label' => function ($choice, $key, $value) {
                    return new TranslatableMessage("form.label_choice_{$value}");
                },
                'required' => true,
                'placeholder' => 'form.label_placeholder_choice',
                'label' => 'form.label_operation',
                'constraints' => [
                    new Assert\NotBlank()
                ],
                'attr' => [
                    'class' => 'select-operation',
                ],
            ])
            ->add('operatorA', IntegerType::class, [
                'required' => true,
                'label' => 'form.label_operator_a',
                'attr' => [
                    'step' => 0.1,
                    'class' => 'input-operator-a',
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ],
            ])
            ->add('operatorB', IntegerType::class, [
                'required' => false,
                'label' => 'form.label_operator_b',
                'attr' => [
                    'step' => 0.1,
                    'class' => 'input-operator-b',
                ],
                'constraints' => [
                    new Assert\Callback(function (int|float|null $value, ExecutionContextInterface $context, mixed $payload) {
                        if (!in_array($context->getRoot()->get('operation')->getData(), ['squareRoot', 'cubeRoot']) && $value === null) {
                            $context->buildViolation('This value should not be blank.')
                                ->addViolation();
                        }
                    })
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'btn.label_calc',
            ])
        ;
    }
}
