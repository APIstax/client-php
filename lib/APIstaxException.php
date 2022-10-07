<?php

namespace APIstax;

use Exception;
use Throwable;

class APIstaxException extends Exception
{

    /**
     * @var string[]|null
     */
    private $messages;

    public function __construct($messages = null, Throwable $cause = null)
    {
        parent::__construct(null, null, $cause);
        $this->messages = $messages;
    }

    /**
     * @return string[]|null
     */
    public function getMessages(): ?array
    {
        return $this->messages;
    }
}