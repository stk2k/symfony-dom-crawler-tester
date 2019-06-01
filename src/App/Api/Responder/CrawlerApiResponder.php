<?php
namespace SymfonyDomCrawlerTester\App\Api\Responder;

use DOMDocument;
use DOMNode;

use Symfony\Component\DomCrawler\Crawler;

class CrawlerApiResponder extends ApiResponder
{
    /**
     * @param string $html
     * @param string $selector
     */
    public function filter(string $html, string $selector)
    {
        $crawler = new Crawler();

        $crawler->addHTMLContent($html, "UTF-8");

        $result = [];
        foreach($crawler->filter($selector)as $item){
            /** @var DOMNode $item */
            $result[] = $this->outerHTML($item);
        };

        $this->successResponse([
            'selector' => $selector,
            'result' => $result
        ]);
    }

    function outerHTML($e) {
        $doc = new DOMDocument();
        $doc->appendChild($doc->importNode($e, true));
        $html = $doc->saveHTML();
        return $value = mb_convert_encoding($html, 'UTF-8', 'HTML-ENTITIES');
    }
}