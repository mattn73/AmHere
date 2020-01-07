<?php

namespace App\Action;

use App\Services\Configuration;
use PHPMailer\PHPMailer\PHPMailer;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class EmailAction
{
    public static function index(ServerRequest $request, Response $response, $container)
    {
        $params = $request->getParams();

        $params['subject'] = $params['type'] == 'contact-me' ? 'Contact Me' : 'Message';
        $params['body']    = self::generateBody($params, $params['type'], $container);

        if (self::sendMail($params)) {
            $data = ['feedback' => 'success'];
        } else {
            $data = ['feedback' => 'failed'];
        }

        return $response->withJson($data);
    }

    protected static function sendMail($params)
    {
        /**
         * @var PHPMailer $mailer
         */
        $mailer = Configuration::getMailConfiguration();

        if (!$mailer) {
            return false;
        }

        $mailer->setFrom($params['email'], $params['name']);
        $mailer->Subject = 'AM HERE WEB Contact -  ' . $params['subject'];
        $mailer->msgHTML($params['body']);
        $mailer->AltBody = 'HTML messaging not supported';

        if (!$mailer->send()) {
            return false;
        } else {
            return true;
        }
    }


    private static function generateBody($params, $type, $container)
    {
        if ($type == 'contact-me') {
            $body = $container->get('view')->fetch('contact.twig',
                [
                    'name'      => $params['name'],
                    'telephone' => $params['phone'],
                    'email'     => $params['email'],
                    'looking'   => $params['looking'],
                ]);
        } else {
            $body = $container->get('view')->fetch('message.twig',
                [
                    'name'    => $params['name'],
                    'email'   => $params['email'],
                    'message' => $params['body'],
                ]);
        }

//todo: Build Email Body
        return $body;
    }
}
