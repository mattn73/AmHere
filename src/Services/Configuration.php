<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Configuration
{
    /**
     * @return bool|PHPMailer
     */
    public static function getMailConfiguration()
    {
        $config = self::getConfig()['mailer'];

        try {
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug  = $config['debug']; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->Host       = $config['host']; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
            $mail->Port       = $config['port']; // TLS onlyGET
            $mail->SMTPSecure = $config['protocol']; // ssl is depracated
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['username'];
            $mail->Password   = $config['password'];
            $mail->addAddress($config['to'], $config['name']);
        } catch (Exception $e) {
            return false;
        }
        return $mail;
    }

    public static function getConfig()
    {
        $config = (include __DIR__ . '/../../config/settings.php');

        return $config;
    }
}
