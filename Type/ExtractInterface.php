<?php

namespace FDevs\DataExtractor\Type;

use FDevs\DataExtractor\ExtractedInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface ExtractInterface
{
    /**
     * @param mixed $target
     * @param array $context
     *
     * @return bool
     */
    public function support($target, array $context): bool;

    /**
     * @param mixed              $target
     * @param array              $options
     * @param ExtractedInterface $data
     *
     * @return ExtractedInterface
     */
    public function extract($target, array $options, ExtractedInterface $data): ExtractedInterface;

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver);
}
