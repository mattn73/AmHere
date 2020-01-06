<?php

use Slim\App;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Action\EmailAction;

return function (App $app) {
    $app->post('/send-email', EmailAction::class);
};
