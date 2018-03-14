<?php

namespace FDevs\DataExtractor;

interface ExtractorInterface
{
    /**
     * @param mixed                   $target
     * @param array                   $context
     * @param ExtractedInterface|null $extracted
     *
     * @return ExtractedInterface
     */
    public function extract($target, array $context = [], ExtractedInterface $extracted = null): ExtractedInterface;
}
