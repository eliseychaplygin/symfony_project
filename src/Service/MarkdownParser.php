<?php

namespace App\Service;

use Michelf\MarkdownExtra;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Service\Attribute\Required;

class MarkdownParser
{

    private CacheInterface $cache;
    private MarkdownExtra $parser;
    private LoggerInterface $logger;

    public function __construct(CacheInterface $cache, MarkdownExtra $parser, LoggerInterface $logger)
    {
        $this->cache = $cache;
        $this->parser = $parser;
        $this->logger = $logger;
    }

    public function parse(string $source): string
    {
        if (stripos($source, 'красн') !== false){
            $this->logger->info('Кажется и это статья о красной точке');
        }

        return $this->cache->get('markdown_' . md5($source), function () use ($source) {
                return $this->parser->transform($source);
            });
    }
}