<?php

use Slim\App;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Action\EmailAction;

return function (App $app) {

    $container = $app->getContainer();
    $app->post('/send-email', function ($request, $response) use ($container) {
        return  EmailAction::index($request, $response, $container);
    });
};
