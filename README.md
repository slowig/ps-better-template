## About ps-better-template

This repository was created for people who are tired by old way of creating prestashop modules. This package may help to create and maintain module in better condition. Ps-better-template provides you:

- unit testing
- Vue components
- Vue jest unit testing
- Good structure with support of newst features from Prestashop

## How to start

Clone this repository to selected directory

```sh
git clone https://github.com/slowig/ps-better-template your_module
```

Define your namespace in composer.json and run `composer install -o`, of course you can add some packages before it.

```json
 "psr-4": {
    "Company\\Module\\": "src/",
    "Company\\Module\\Tests\\": "tests/"
}
```

Replace old namespaces with the new one in the following places:

- src/Dto/\*
- src/Database/\*
- src/Installer/\*
- src/Installer/\*
- src/Controller/\*
- tests/Database/\*
- tests/Installer/\*
- module.php

Rename `module.php` with module name and also inside this file change this lines with your configuration:

```php
//(1) Replace with your namespace
use Company\Module\Installer\Installer;
//(2) Your module name. Only first letter must be uppercase. Read more about it in presta doc.
class Module extends Module
{
    protected $config_form = false;

    const HOOKS = [];

    public function __construct()
    {
        //(3) This line replace with module name. Must be same as module directory
        $this->name = 'module';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        //(4) Your name
        $this->author = 'Your Name';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        //(5) The following lines replace how you want to name and describe module
        $this->displayName = $this->l('Your module');
        $this->description = $this->l('REPALCE IT WITH YOUR DESCRIPTION');

```

## Define hooks

If you want to define hooks in your module just add them into array `HOOKS` inside module class in `module_name.php`

```php
class Module extends Module
{
    protected $config_form = false;

    const HOOKS = [
        'myHook',
        'actionValidateOrder'
    ];

    //... omitted

    public function hookMyHook() {}
```

## Define your database

Database scripts are stored in `resources/sql`. Each file is executed by `Installer` during installation. Installer provides two variables that you can use in schemas:

- prefix - prestashop database prefix
- engine - default prestashop mysql engine
  Example:

```sql
CREATE TABLE IF NOT EXISTS {prefix}module_table (
    id_module_table INT AUTO_INCREMENT NOT NULL,
    example_column VARCHAR(255) NOT NULL
    PRIMARY KEY(`id_module_table`)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = {engine};

```

## Using Vue

Go to 'dev' directoty and run `npm install`. By running `npm run watch` you can turn watch mode on. If you want to deploy your module use `npm run build` _Important_ After `npm run build` or `npm run watch` all yours files stored in `assets/js` will be removed, keep your scripts in another place for example `assets/scripts`.
Remember to add `app` id of root element in template and delete `node_modules` directory before deployment.

```php
    public function indexAction(Request $request)
    {
        return $this->render('@Modules/'.self::MODULE_NAME.'/views/templates/admin/index.html.twig', [
            'appPath' =>  $this->spaConfiguration->getAppPathJs(),
            'chunkVendors' =>  $this->spaConfiguration->getAppChunkVendorsPathJs(),
        ]);
    }
```

## Unit testing

After `composer install --dev` run in root directory `./vendor/bin/phpunit`.

## Controllers and routing

See in prestashop doc.

## TO-DO

- create generator
- add migrations
- add some helpers to testing

## License

This repository is shared on MIT license.
