<?php

use Slim\Views\Twig;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use DI\Container;
use Twig\Loader\FilesystemLoader;

require __DIR__.'/../vendor/autoload.php';

$container = new Container();

AppFactory::setContainer($container);
$app = AppFactory::create();

$container = $app->getContainer();

$loader = new FilesystemLoader(__DIR__ . '/../templates');

$container->set('view', function(ContainerInterface $container) use ($loader){
    return new Twig($loader);
});

$app->get('/', function ($request, $response, $args) {
    return $this->get('view')->render($response, 'hello.twig');
})->setName('home.page');

$app->run();