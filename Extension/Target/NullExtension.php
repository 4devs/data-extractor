<?php

namespace FDevs\DataExtractor\Extension\Target;

use FDevs\DataExtractor\Extension\TargetExtensionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NullExtension implements TargetExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function prepareTarget($target, array $options)
    {
        return $target;
    }

    /**
     * {@inheritdoc}
     */
    public function supportTarget($target): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?string
    {
        return null;
    }
}
