<?php

namespace Gupalo\SymfonyFormTransformers\Tests\FormType;

use Gupalo\SymfonyFormTransformers\Entity\Tsv;
use Gupalo\SymfonyFormTransformers\FormType\TsvType;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TsvTypeTest extends TestCase
{
    private TsvType $tsvType;

    protected function setUp(): void
    {
        $this->tsvType = new TsvType();
    }

    public function testBuildForm(): void
    {
        /** @var FormBuilderInterface&MockObject $builder */
        $builder = $this->createMock(FormBuilderInterface::class);

        $builder->expects($this->exactly(2))
            ->method('add')
            ->willReturnSelf();

        $this->tsvType->buildForm($builder, []);
    }

    public function testConfigureOptions(): void
    {
        /** @var OptionsResolver&MockObject $resolver */
        $resolver = $this->createMock(OptionsResolver::class);

        $resolver->expects($this->once())
            ->method('setDefaults')
            ->with(['data_class' => Tsv::class])
            ->willReturnSelf();

        $this->tsvType->configureOptions($resolver);
    }
}
