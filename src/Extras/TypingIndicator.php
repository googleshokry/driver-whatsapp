<?php

namespace BotMan\Drivers\Whatsapp\Extras;

use BotMan\BotMan\Interfaces\WebAccess;

class TypingIndicator implements WebAccess
{
    /** @var int */
    protected $timeout;

    /**
     * @param float $timeout
     * @return TypingIndicator
     */
    public static function create(float $timeout = 1)
    {
        return new static($timeout);
    }

    /**
     * TypingIndicator constructor.
     * @param int $timeout
     */
    public function __construct(int $timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * Get the instance as a Whatsapp accessible array.
     * This will be used within the WhatsappDriver.
     *
     * @return array
     */
    public function toWebDriver()
    {
        return [
            'type' => 'typing_indicator',
            'timeout' => $this->timeout,
        ];
    }
}
