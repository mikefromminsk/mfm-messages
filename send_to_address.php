<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/mfm-messages/utils.php";

$from_address = get_required(from_address);
$to_address = get_required(to_address);
$message = get_required(message);
$template = get_required(template);
$site_domain = get_required(site_domain);

$response[success] = messageSendToAddress($from_address, $to_address, $message, $template, $site_domain);

commit($response);