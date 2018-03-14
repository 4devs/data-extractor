<?php

namespace FDevs\DataExtractor\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractExtract implements ExtractInterface
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
