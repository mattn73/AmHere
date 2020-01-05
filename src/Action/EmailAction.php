<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class EmailAction
{
    public function __invoke(ServerRequest $request, Response $response)
    {

        $response->getBody()->write('Hello, World!');

        return $response;
    }
}