<?php

namespace App\Infrastructure;

/**
 * Class ApiWeatherDecorator
 * @package App\Infrastructure
 */
class ApiWeatherDecorator
{
    /**
     * @var array
     */
    private $data;

    /**
     * ApiWeatherDecorator constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param array $data
     *
     * @return ApiWeatherDecorator
     */
    public static function create(array $data): self
    {
        return new self($data);
    }

    /**
     * @return array
     */
    public function decorate(): array
    {
        return [
            'total' => Util::getProperty($this->data, 'total', 0),
            'items' => Util::getProperty($this->data, 'data', []),
            'per_page' => Util::getProperty($this->data, 'per_page', 0),
        ];
    }
}
