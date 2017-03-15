SymfonyCountLinesCode
=========

SymfonyCountLinesCode is an extremely simple Symfony bundle that counts the number of lines of code written in Symfony project.

It goes through specified directories and counts the number of lines in the `.php`, `.twig`, `.js` and `.css` files.

SymfonyCountLinesCode was forked from https://github.com/BastienL/Symfony2Loc.


BundleInstallation
==================

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:
**We strongly recommend to use this only on the dev part**

```bash
$ composer require-dev c975l/symfonycountlinescode-bundle "1.*"
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
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            // ...
            $bundles[] = new c975L\SymfonyCountLinesCodeBundle\c975LSymfonyCountLinesCodeBundle();
        }

        // ...
    }

    // ...
}
```

Usage
=====

To use it, just type (at the root of your Symfony2 project): `php bin/console count:loc`
