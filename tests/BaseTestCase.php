<?php

declare(strict_types=1);

namespace Mosquito\Test;

use Mosquito\Bot;
use Mosquito\BotConfiguration;
use PHPUnit\Framework\TestCase;

/**
 * Base class for unit tests.
 *
 */
class BaseTestCase extends TestCase
{

    /**
     * @var Bot
     */
    protected $bot;

    public function __construct()
    {
        parent::__construct();
        $bot = new Bot('');
        $bot->config()->setParseMode(BotConfiguration::PARSE_MODE_HTML);
        $bot->config()->setUpdateMode(BotConfiguration::WEBHOOK_MODE);
        $bot->config()->enableRedis([]);
        $this->bot = $bot;
    }

}
