<?php

namespace FDevs\DataExtractor\Type;

use FDevs\DataExtractor\Exception\ExtractNotFoundException;

class ExtractRegistry implements ExtractRegistryInterface
{
    /**
     * @var iterable|ExtractInterface[]
     */
    private $extract;

    /**
     * ExtractRegistry constructor.
     *
     * @param ExtractInterface[]|iterable $extract
     */
    public function __construct(iterable $extract)
    {
        $this->extract = $extract;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtract($target, array $context): ExtractInterface
    {
        foreach ($this->extract as $item) {
            if ($item->support($target, $context)) {
                return $item;
            }
        }

        throw new ExtractNotFoundException($target, $context);
    }
}
