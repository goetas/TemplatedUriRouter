Hautelook Templated URI Bundle
==============================

Symfony2 Bundle that provides a [RFC-6570][RFC-6570] compatible router and URL Generator. Currently it is extremly naive,
and incomplete. However, it does what we need it to do. Contributions are welcome.

[![Build Status](https://secure.travis-ci.org/hautelook/TemplatedUriBundle.png?branch=master)](https://travis-ci.org/hautelook/TemplatedUriBundle)

## Installation

Simply run the following command (assuming you have installed composer.phar or composer binary), or add to your `composer.json` and run composer install:

```bash
$ composer require hautelook/templated-uri-bundle
```

Now add the Bundle to your Kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Hautelook\TemplatedUriBundle\HautelookTemplatedUriBundle(),
        // ...
    );
}
```

## Usage

The bundle exposes a router service (`hautelook.router.template`) that will generate RFC-6570 compliant URLs. Here is a sample
on how you could use it.

```php
$templateLink = $this->get('hautelook.router.template')->generate('hautelook_demo_route',
    array(
        'page'   => '{page}',
        'sort'   => array('{sort}'),
        'filter' => array('{filter}'),
    )
);
```

This will produce a link similar to:

```
/demo?{&page}{&sort%5B%5D*}{&filter%5B%5D*}
```

[RFC-6570]: https://tools.ietf.org/html/rfc6570

