<?php

require_once 'vendor\autoload.php';

use GuzzleHttp\Client;
use BuscadorDeCursos\Buscador;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;

$html2 = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <p>Hello Crawler!</p>
    </body>
</html>
HTML;
Uteis::imprimir();
teste();

$cliente = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscador = new Buscador($cliente, $crawler);
$cursos = $buscador->buscar('cursos-online-programacao/java');

foreach ($cursos as $value) {
    echo '<p>' . $value . '</p>';
}
