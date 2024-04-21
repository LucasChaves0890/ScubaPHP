<?php

namespace Helper;

trait FlashMessageTrait
{
    private function setMessage($messageName, $message) {
        $_SESSION[$messageName] = $message;
    }
}
