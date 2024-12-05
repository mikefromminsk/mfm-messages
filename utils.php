<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/mfm-mail/utils.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/mfm-telegram/utils.php";

function messageSendToAddress($from_address, $to_address, $message, $template)
{
    $to_email_info = mailGetReceiverInfo($to_address);
    $to_telegram_info = telegramGetReceiverInfo($to_address);

    if ($to_email_info == null && $to_telegram_info == null) {
        error("No email or telegram connection for $to_address");
    } else {
        if ($to_email_info != null) {
            $body = fillTemplateBody($template, $to_email_info[name], $to_address, $to_email_info[lang], [message => $message]);
            mailSendToAddress($from_address, $to_address, $body);
        }
        if ($to_telegram_info != null) {
            telegramSendToAddress($to_address, $from_address . ": " . $message);
        }
    }
    return true;
}