<?php

namespace FDevs\DataExtractor\Extracted;

use FDevs\DataExtractor\ExtractedInterface;

interface FactoryInterface
{
    /**
     * @param array $options
     *
     * @return ExtractedInterface
     */
    public function create(array $options): ExtractedInterface;
}
