<?php

namespace CurrencyUaBot\Currency;

use CurrencyUaBot\Traits\Cacheable;

class CurrencyEntity
{
    use Cacheable;

    /** @var string */
    protected $source = '';

    /** @var string */
    protected $name = '';

    /** @var float */
    private $buy = 0.00;

    /** @var float */
    private $sale = 0.00;

    public function __construct(string $source, string $name, float $sale, float $buy)
    {
        $this->source = $source;
        $this->name = $name;
        $this->sale = $sale;
        $this->buy = $buy;
    }

    /**
     * @return float
     */
    public function getSale(): float
    {
        return $this->sale;
    }

    /**
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    public function toArray(): array
    {
        return [
            "source" => $this->source,
            "name" => $this->name,
            "sale" => $this->sale,
            "buy" => $this->buy,
        ];
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }
}