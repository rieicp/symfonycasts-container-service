<?php


namespace AppBundle\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser;

    public function __construct(MarkdownParserInterface $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parse($str)
    {
        //$cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $key = md5($str);
        if ($cache->contains($key)) {
            return $cache->fetch($key);
        }

        sleep(1); // fake how slow this could be

        $str = $this->markdownParser->transform($str);
        $cache->save($key, $str);

        return $str;
    }
}
