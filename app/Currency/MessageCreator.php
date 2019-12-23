<?php

namespace USD2UAH\Currency;

class MessageCreator
{
    public static function createDivisionMessage(string $input, string $one, string $two, string $ex)
    {
        $result = round(floatval($input) / floatval($ex), 2);
        return"На {$input}{$one} будет {$result} {$two}";
    }

    public static function createMultiplyMessage(string $input, string $one, string $two, string $ex)
    {
        $result = round(floatval($input) * floatval($ex), 2);
        return"За {$input}{$one} будет {$result} {$two}";
    }
}