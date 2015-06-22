# Silex Skeleton ORM [![Latest Stable Version](https://poser.pugx.org/madebydavid/silex-skeleton-orm/v/stable.svg)](https://packagist.org/packages/madebydavid/silex-skeleton-orm) 

## A simple Silex skeleton project with Twig, Doctrine, ORM, Bootstrap, jQuery and other common components.

To view the full list of dependancies, have a look at the [composer.json](composer.json) file.

Based on [Fabien Potencier's Silex Skeleton](https://github.com/silexphp/Silex-Skeleton), but with more up to date dependencies and a different structure.

### To install with composer

#### 1. Install composer if you don't have it already:
```bash
$ curl -sS https://getcomposer.org/installer | php
```

#### 2. Grab this project as your base
```bash
$ php composer.phar create-project madebydavid/silex-skeleton-orm silex-project
$ cd silex-project
```

#### 3. Configure the database in the [dev config file](config/dev.php):
```php
$app['config'] = array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'dbname'    => 'skeleton-dev',
        'user'      => 'root',
        'password'  => ''
    )
);
```
#### 4. Create the database which you have just configured:
```bash
$ mysqladmin -uroot create skeleton-dev
```

#### 5. Create your model
You can create your model with [Doctrine YAML documents](http://doctrine2.readthedocs.org/en/stable/reference/yaml-mapping.html) in the [config/doctrine/schema](config/doctrine/schema) directory, make a new file called Model.EntityName.dcm.yml for each entity:

```
#config/doctrine/schema/Model.Person.dcm.yml
Model\Person:
    type: entity
    table: person
    fields:
        id:
            type: integer
            id: true
            generator:
                strategy: AUTO
        name:
            type: string
            length: 255
        created:
            type: datetime
            columnDefinition: TIMESTAMP DEFAULT CURRENT_TIMESTAMP
```

#### 6. Generate the Entity classes from the YAML:
```bash
$ ./console orm:generate-entities src/
```

#### 7. Create the schema:
```bash
$ ./console orm:schema-tool:create
```


