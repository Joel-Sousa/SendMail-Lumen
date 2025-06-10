<?php

namespace App\Services;

use App\Mail\DataMail;
use App\Repositories\DataRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailer;
use App\Traits\MailTrait;
use PHPMailer\PHPMailer\PHPMailer;
use DateTime;
use DateTimeZone;

class DataService
{

    public function sendMail($request)
    {
        $data = $request->all();

        try {

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = $data['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $data['user'];
            $mail->Password   = $data['pass'];
            $mail->SMTPSecure = $data['encryption'];
            $mail->Port       = $data['port'];

            $mail->setFrom($data['originAddress'], getenv('APP_NAME'));
            $mail->addAddress($data['destinationAddress'], '');

            $mail->isHTML(true);
            $mail->Subject = $data['subject'];
            $mail->Body    = view('mail.mail', compact('data'));

            $arrFile = [];

            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $arrFile['pathName'] = $request->file('file')->getPathname();
                $arrFile['originalName'] = $request->file('file')->getClientOriginalName();

                $mail->addAttachment($arrFile['pathName'], $arrFile['originalName']);
            }

            $mail->send();

            $message = "§[" . self::getDate() . "] local.INFO | Email enviado! \n";
            error_log($message, 3, dirname(__DIR__, 2) . '/public/mail_log.log');

            $data['status'] = $message;
            $data['data'] = $data;

            return $data;
        } catch (\Exception $e) {

            $log = 'message: ' . $e->getMessage() . ' | ';
            $log .= 'code: ' . $e->getCode() . ' | ';
            $log .= 'trace: ' . $e->getTraceAsString() . ' | ';

            $message = "§[" . self::getDate() . "] local.ERROR | Email Nao enviado! \n";

            error_log($message.$log, 3, dirname(__DIR__, 2) . '/public/mail_log.log');

            $data['status'] = $message;

            return $data;
        }
    }

    public function cleanLog()
    {
        $logFile = dirname(__DIR__, 2) . '/public/mail_log.log';

        if (file_exists($logFile) && is_writable($logFile)) {
            file_put_contents($logFile, null);
            $data['status'] = "Log limpo com sucesso!";
        } else {
            $data['status'] = "Erro: o arquivo não existe ou não tem permissão de escrita.";
        }

        return $data;
    }

    private static function getDate(){
        $data = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $data->setTimezone(new DateTimeZone('Etc/GMT+3'));
        return $data->format('Y-m-d H:i:s');
    }
}
