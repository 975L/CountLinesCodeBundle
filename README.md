CountLinesCodeBundle
====================

CountLinesCodeBundle does the following:

- counts the number of lines of code written in Symfony project.

It goes through specified directories and counts the number of lines specified in the extensions files.

CountLinesCodeBundle was forked from https://github.com/BastienL/Symfony2Loc.

[CountLinesCode Bundle dedicated web page](https://975l.com/en/pages/count-lines-code-bundle).

Bundle installation
===================

Step 1: Download the Bundle
---------------------------
**We strongly recommend to use this only on the dev part**

Add the following to your `composer.json > require-dev section`
```
"require-dev": {
    "c975L/countlinescode-bundle": "1.*"
},
```
Then open a command console, enter your project directory and update composer,
by executing the following command, to download the latest stable version of this bundle:

```bash
$ composer update
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------
Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            // ...
            $bundles[] = new c975L\CountLinesCodeBundle\c975LCountLinesCodeBundle();
        }
    }
}
```

Step 3: Define folders and extensions to look for
-------------------------------------------------
Then define the list of folders and extensions you want to look for in the `app/config_dev.yml` file of your project:

```yml
c975_l_count_lines_code:
    extensions: ['css', 'js', 'php', 'sh', 'sql', 'twig']
    folders: ['app/Resources/views', 'src/AppBundle', 'tests/AppBundle', 'web/css', 'web/js']
```

How to use
----------
To use it, just type (at the root of your Symfony2 project):
```bash
$ php bin/console count:loc
```

TODO
----
Improve counting command