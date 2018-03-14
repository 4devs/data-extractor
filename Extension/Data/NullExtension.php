<?php

namespace FDevs\DataExtractor\Extension\Data;

use FDevs\DataExtractor\Extension\DataExtensionInterface;
use FDevs\DataExtractor\ExtractedInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NullExtension implements DataExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ExtractedInterface $data, array $options = []): ExtractedInterface
    {
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
