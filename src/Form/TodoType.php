<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title', TextType::class, [
            'label' => 'title',
        ]);

        $transform = function ($data) { return $data; };
        $reverseTransform = function ($data) {
            return new Todo($data['title'], new \DateTime());
        };
        $builder->addModelTransformer(new CallbackTransformer($transform, $reverseTransform));
    }
}
