<?php

namespace FDevs\DataExtractor\Extracted;

use FDevs\DataExtractor\ExtractedInterface;
use FDevs\DataExtractor\Model\Extracted;

class ExtractedFactory implements FactoryInterface
{
    /**
     * @var string
     */
    private $className;

    /**
     * ExtractedFactory constructor.
     *
     * @param string $className
     */
    public function __construct(string $className = Extracted::class)
    {
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $options): ExtractedInterface
    {
        return new $this->className();
    }
}
