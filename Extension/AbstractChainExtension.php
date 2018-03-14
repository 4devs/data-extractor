<?php

namespace FDevs\DataExtractor\Extension;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractChainExtension implements ExtensionInterface
{
    /**
     * @return iterable|ExtensionInterface[]
     */
    abstract protected function getExtensions(): iterable;

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        foreach ($this->getExtensions() as $extension) {
            $extension->configureOptions($resolver);
        }
    }
}
