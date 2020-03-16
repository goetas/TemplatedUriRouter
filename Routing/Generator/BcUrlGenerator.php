<?php

namespace Hautelook\TemplatedUriRouter\Routing\Generator;

use Symfony\Component\HttpKernel\Kernel;

if (Kernel::MAJOR_VERSION < 5) {
    abstract class BcUrlGenerator extends \Symfony\Component\Routing\Generator\UrlGenerator
    {
    }
} else {
    abstract class BcUrlGenerator extends \Symfony\Component\Routing\Generator\CompiledUrlGenerator
    {
    }
}
