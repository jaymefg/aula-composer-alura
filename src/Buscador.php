<?php

namespace BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpClient;

    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;

        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {

        $resposta = $this->httpClient->request('GET', $url, ['verify' => false]);
        
        $html = $resposta->getBody();
        
        $this->crawler->addHtmlContent($html);
        
        $cursosDom = $this->crawler->filter('span.card-curso__nome');
        
        $cursos = [];
        
        foreach ($cursosDom as $value) {
            $cursos[] = $value->textContent;
        }

        return $cursos;
    }

    public static function imprimir()
    {
        echo "<p>Imprimindo!</p>";
    }
}
