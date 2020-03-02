<?php

namespace CurrencyUaBot\Message;

class MessageCreator
{
    public static function createDivisionMessage(string $input, string $one, string $two, string $ex)
    {
        $result = round(floatval($input) / floatval($ex), 2);
        return "{$input}{$one} => {$result} {$two}";
    }

    public static function createMultiplyMessage(string $input, string $one, string $two, string $ex)
    {
        $result = round(floatval($input) * floatval($ex), 2);
        return "{$input}{$one} => {$result} {$two}";
    }
}