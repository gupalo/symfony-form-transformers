<?php /** @noinspection PhpUndefinedMethodInspection *//** @noinspection PhpParamsInspection */

namespace Gupalo\SymfonyFormTransformers\Tests\FormType;

use Gupalo\SymfonyFormTransformers\Entity\Tsv;
use Gupalo\SymfonyFormTransformers\FormType\TsvType;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TsvTypeTest extends TestCase
{
    use ProphecyTrait;

    private TsvType $tsvType;

    protected function setUp(): void
    {
        $this->tsvType = new TsvType();
    }

    public function testBuildForm(): void
    {
        /** @var FormBuilderInterface $builder */
        $builder = $this->prophesize(FormBuilderInterface::class);

        $builder->add('tsv', TextareaType::class, Argument::type('array'))->shouldBeCalledOnce()->willReturn($builder->reveal());
        $builder->add('save', SubmitType::class, Argument::type('array'))->shouldBeCalledOnce()->willReturn($builder->reveal());

        $this->tsvType->buildForm($builder->reveal(), []);

        self::assertTrue(true);
    }

    public function testConfigureOptions(): void
    {
        /** @var OptionsResolver $resolver */
        $resolver = $this->prophesize(OptionsResolver::class);

        $resolver->setDefaults(['data_class' => Tsv::class])->shouldBeCalledOnce()->willReturn($resolver->reveal());

        $this->tsvType->configureOptions($resolver->reveal());

        self::assertTrue(true);
    }
}
