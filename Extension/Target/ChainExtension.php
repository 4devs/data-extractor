<?php

namespace FDevs\DataExtractor\Extension\Target;

use FDevs\DataExtractor\Extension\AbstractChainExtension;
use FDevs\DataExtractor\Extension\TargetExtensionInterface;

class ChainExtension extends AbstractChainExtension implements TargetExtensionInterface
{
    /**
     * @var array|TargetExtensionInterface[]
     */
    private $extensions = [];

    /**
     * ChainExtension constructor.
     *
     * @param array|TargetExtensionInterface[] $extensions
     */
    public function __construct(iterable $extensions = [])
    {
        $this->extensions = $extensions;
    }

    /**
     * {@inheritdoc}
     */
    protected function getExtensions(): iterable
    {
        return $this->extensions;
    }

    /**
     * {@inheritdoc}
     */
    public function prepareTarget($target, array $options)
    {
        foreach ($this->extensions as $extension) {
            $target = $extension->prepareTarget($target, $options);
        }

        return $target;
    }

    /**
     * {@inheritdoc}
     */
    public function supportTarget($target): bool
    {
        $support = true;
        foreach ($this->extensions as $ext) {
            $support = $ext->supportTarget($target);
            if (false === $support) {
                break;
            }
        }

        return $support;
    }
}
