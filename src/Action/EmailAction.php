<?php

namespace App\Action;

use App\Services\Configuration;
use PHPMailer\PHPMailer\PHPMailer;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class EmailAction
{
    public function __invoke(ServerRequest $request, Response $response)
    {
        $params = $request->getParams();

        $params['subject'] = $params['type'] == 'contact-me' ? 'Contact Me' : 'Message';
        $params['body']    = $this->generateBody($params['message'] , $params['type']);

        if($this->sendMail($params)) {
            $data = ['feedback' => 'success'];
        } else {
            $data = ['feedback' => 'failed'];
        }

        return $response->withJson($data);
    }

    protected function sendMail($params)
    {
        /**
         * @var PHPMailer $mailer
         */
        $mailer = Configuration::getMailConfiguration();

        if(!$mailer) {
            return false;
        }

        $mailer->setFrom($params['email'], $params['name']);
        $mailer->Subject = 'AM HERE WEB Contact -  ' .$params['subject'];
        $mailer->msgHTML($params['body']);
        $mailer->AltBody = 'HTML messaging not supported';

        if(!$mailer->send()){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param $message
     * @param $type
     * @return String $body
     */
    private function generateBody($message, $type)
    {


//todo: Build Email Body
        return $body;
    }
}
