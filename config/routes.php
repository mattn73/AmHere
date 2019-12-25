<?php

use Slim\App;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
};