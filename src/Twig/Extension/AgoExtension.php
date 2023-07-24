<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\AgoExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AgoExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('ago', [AgoExtensionRuntime::class, 'getDiff']),
        ];
    }
}
