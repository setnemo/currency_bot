<?php

namespace USD2UAH\Currency;

class MessageCreator
{
    public static function createDivisionMessage(string $input, string $one, string $two, string $ex)
    {
        return $input . $one . ' to ' . $two . ': ' . round(floatval($input) / floatval($ex), 2);
    }

    public static function createMultiplyMessage(string $input, string $one, string $two, string $ex)
    {
        return $input . $one . ' to ' . $two . ': ' . round(floatval($input) * floatval($ex), 2);
    }
}