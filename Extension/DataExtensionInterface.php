<?php

namespace FDevs\DataExtractor\Extension;

use FDevs\DataExtractor\ExtractedInterface;

interface DataExtensionInterface extends ExtensionInterface
{
    /**
     * @param ExtractedInterface $data
     * @param array              $options
     *
     * @return ExtractedInterface
     */
    public function process(ExtractedInterface $data, array $options = []): ExtractedInterface;
}
