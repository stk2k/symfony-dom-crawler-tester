<?php
namespace SymfonyDomCrawlerTester\App\Api\Responder;

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

        $result = $crawler->filter($selector);

        $this->successResponse([
            'selector' => $selector,
            'result' => $result->html()
        ]);
    }
}