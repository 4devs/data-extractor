<?php

namespace FDevs\DataExtractor\Extension\Data;

use FDevs\DataExtractor\Extension\AbstractChainExtension;
use FDevs\DataExtractor\Extension\DataExtensionInterface;
use FDevs\DataExtractor\ExtractedInterface;

class ChainExtension extends AbstractChainExtension implements DataExtensionInterface
{
    /**
     * @var iterable|DataExtensionInterface[]
     */
    private $extensions;

    /**
     * ChainExtension constructor.
     *
     * @param DataExtensionInterface[]|iterable $extensions
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
    public function process(ExtractedInterface $data, array $options = []): ExtractedInterface
    {
        foreach ($this->extensions as $extension) {
            $data = $extension->process($data, $options);
        }

        return $data;
    }
}
