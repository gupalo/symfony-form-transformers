TsvTransformer
==============

Symfony Forms TsvTransformer

How to Install
--------------

Install the `gupalo/symfony-form-transformers` package using [composer](http://getcomposer.org/):

```shell
composer require gupalo/symfony-form-transformers
```

Transformers
------------

* `EmptyStringTransformer`: allows user to pass empty fields which should be empty strings instead of null
* `JsonYamlTransformer`: user views and edits field as YAML but it is stored as JSON in DB and is array in PHP
* `StringArrayTransformer`: user can enter several strings each from new line and they will become an array
* `TsvTransformer`: user copy-pastes from spreadsheet and PHP gets array with named keys (multiline and quoting are not supported)

Basic Usage
-----------

Add transformers to your forms

```php
class YourEntity
{
    private ?array $data = [];
}
///
class YourEntityType extends AbstractType
{
    public function __construct(private JsonYamlTransformer $jsonYamlTransformer)
    {
        $this->jsonYamlTransformer = $jsonYamlTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ...
            ->add('data', TextareaType::class);

        $builder->get('data')->addModelTransformer($this->jsonYamlTransformer);
    }
```

Advanced Usage
--------------

...

See `tests` for more examples. Also look at `src` - the logic is quite simple.

If you have multiline input Tsv, set `TsvHelper::$multiline = true;` 
