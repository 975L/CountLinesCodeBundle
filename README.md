CountLinesCodeBundle
====================

CountLinesCodeBundle does the following:

- counts the number of lines of code written in Symfony project.

It goes through specified directories and counts the number of lines specified in the extensions files.

CountLinesCodeBundle was forked from https://github.com/BastienL/Symfony2Loc.

[CountLinesCodeBundle dedicated web page](https://975l.com/en/pages/count-lines-code-bundle).

[CountLinesCodeBundle API documentation](https://975l.com/apidoc/c975L/CountLinesCodeBundle.html).

Bundle installation
===================

Step 1: Download the Bundle
---------------------------
**We strongly recommend to use this only on the dev part**

Use [Composer](https://getcomposer.org) to install the library
```bash
    composer require-dev c975l/countlinescode-bundle
```

Step 2: Define folders and extensions to look for
-------------------------------------------------
Then, in the `/config/packages/dev/count_lines_codes.yaml` file of your project, define the following:

```yml
c975LCountLinesCode:
    #List of folders you want to look for
    folders: ['src', 'templates', 'tests', 'public/css', 'public/js']
    #List of extensions you want to look for
    extensions: ['css', 'js', 'php', 'sh', 'sql', 'twig']
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

**If this project help you to reduce time to develop, you can [buy me a coffee](https://www.buymeacoffee.com/LaurentMarquet) :)**