<?php

namespace FDevs\DataExtractor\Extension;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface ExtensionInterface
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver);
}
