<?php

namespace App\Twig\Runtime;

use App\Service\MarkdownParser;
use Carbon\Carbon;
use Twig\Extension\RuntimeExtensionInterface;

class AgoExtensionRuntime implements RuntimeExtensionInterface
{
    private MarkdownParser $markdownParser;

    public function __construct(MarkdownParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function getDiff($value):string
    {
        return Carbon::make($value)->locale('ru')->diffForHumans();
    }
}
