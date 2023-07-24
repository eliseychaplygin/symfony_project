<?php

namespace App\Twig\Runtime;

use App\Service\MarkdownParser;
use Carbon\Carbon;
use Twig\Extension\RuntimeExtensionInterface;

class AppExtensionRuntime implements RuntimeExtensionInterface
{
    private MarkdownParser $markdownParser;

    public function __construct(MarkdownParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parseMarkdown($content):string
    {
        return $this->markdownParser->parse($content);
    }
}
