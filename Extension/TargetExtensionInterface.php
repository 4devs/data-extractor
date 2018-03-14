<?php

namespace FDevs\DataExtractor\Extension;

interface TargetExtensionInterface extends ExtensionInterface
{
    /**
     * @param mixed $target
     * @param array $options
     *
     * @return mixed
     */
    public function prepareTarget($target, array $options);

    /**
     * @param mixed $target
     *
     * @return bool
     */
    public function supportTarget($target): bool;
}
