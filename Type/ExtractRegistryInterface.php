<?php

namespace FDevs\DataExtractor\Type;

use FDevs\DataExtractor\Exception\ExtractNotFoundException;

interface ExtractRegistryInterface
{
    /**
     * @param mixed $target
     * @param array $context
     *
     * @throws ExtractNotFoundException
     *
     * @return ExtractInterface
     */
    public function getExtract($target, array $context): ExtractInterface;
}
