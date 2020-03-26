<?php

require "../../vendor/autoload.php";

use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface;
use React\EventLoop\LoopInterface;
use Symfony\Component\Dotenv\Dotenv;

$loop = React\EventLoop\Factory::create();

$browser = new Browser($loop);

$dotenv = new Dotenv();
$dotenv->load("../../.env");

$method = "getUpdates";

$timeout = 50;

$params = [
    "offset" => 550495533,
    "limit" => 1000,
    "timeout" => $timeout
];

$bot_key = $_ENV['BOT_KEY'];

$query = http_build_query($params);

$url = "https://api.telegram.org/bot" . $bot_key . "/" . $method . "?" . $query;

$browser = $browser->withOptions(array(
    'timeout' => $timeout
));

function callback($browser)
{
    getNotifications("https://api.telegram.org/bot1082667657:AAGCbRUHWntQcf3c_uf9hfNkLM98UuJWPJE/getUpdates?offset=550495530&limit=1000&timeout=50", $browser);
}

function getNotifications($url, $browser)
{
    $browser->get($url)->then(function (ResponseInterface $response) {
        // response received within 50 seconds. Telegram longpolling
        echo (string)$response->getBody();
        callback();
    });
}

function timer($start, LoopInterface $loop)
{
    //Timer only used to count seconds
    $loop->addPeriodicTimer(1.0, function ($timer) use (&$start, $loop) {
        echo "tick " . $start++ . "\n";
    });
}

timer(0, $loop);

getNotifications($url, $browser);

$loop->run();