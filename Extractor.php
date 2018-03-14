<?php

namespace FDevs\DataExtractor;

use FDevs\DataExtractor\Extension\Data;
use FDevs\DataExtractor\Extension\DataExtensionInterface;
use FDevs\DataExtractor\Extension\Target;
use FDevs\DataExtractor\Extension\TargetExtensionInterface;
use FDevs\DataExtractor\Type\ExtractInterface;
use FDevs\DataExtractor\Type\ExtractRegistryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Extractor implements ExtractorInterface
{
    /**
     * @var ExtractRegistryInterface
     */
    private $extractRegistry;

    /**
     * @var ContainerInterface
     */
    private $extractFactoryRegistry;

    /**
     * @var ContainerInterface
     */
    private $dataExtensions;

    /**
     * @var ContainerInterface
     */
    private $targetExtensions;

    /**
     * @var TargetExtensionInterface
     */
    private $targetExtension;

    /**
     * @var DataExtensionInterface
     */
    private $dataExtension;

    /**
     * @var OptionsResolver[]
     */
    private $optionsResolver;

    /**
     * Extractor constructor.
     *
     * @param ExtractRegistryInterface $extractRegistry
     * @param ContainerInterface       $extractFactoryRegistry
     * @param ContainerInterface       $dataExtensions
     * @param ContainerInterface       $targetExtensions
     */
    public function __construct(ExtractRegistryInterface $extractRegistry, ContainerInterface $extractFactoryRegistry, ContainerInterface $dataExtensions, ContainerInterface $targetExtensions)
    {
        $this->extractRegistry = $extractRegistry;
        $this->extractFactoryRegistry = $extractFactoryRegistry;
        $this->dataExtensions = $dataExtensions;
        $this->targetExtensions = $targetExtensions;
        $this->targetExtension = new Target\NullExtension();
        $this->dataExtension = new Data\NullExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function extract($target, array $context = [], ExtractedInterface $extracted = null): ExtractedInterface
    {
        $extract = $this->extractRegistry->getExtract($target, $context);
        $extractName = \get_class($extract);
        $options = $this->resolve($extractName, $extract, $context);
        $extracted = $extracted ?? $this->createExtracted($extractName, $options);
        $target = $this->getTargetExtension($extractName)->prepareTarget($target, $options);

        $extracted = $extract->extract($target, $options, $extracted);

        return $this->getDataExtension($extractName)->process($extracted, $options);
    }

    /**
     * @param string $extractName
     * @param array  $options
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     *
     * @return ExtractedInterface
     */
    private function createExtracted(string $extractName, array $options): ExtractedInterface
    {
        $factory = $this->extractFactoryRegistry->has($extractName) ? $this->extractFactoryRegistry->get($extractName) : new Extracted\ExtractedFactory();

        return $factory->create($options);
    }

    /**
     * @param string           $name
     * @param ExtractInterface $extract
     * @param array            $context
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     *
     * @return array
     */
    private function resolve(string $name, ExtractInterface $extract, array $context = [])
    {
        if (!isset($this->optionsResolver[$name])) {
            $this->optionsResolver[$name] = new OptionsResolver();
            $extract->configureOptions($this->optionsResolver[$name]);

            $dataExtension = $this->getDataExtension($name);
            if (null !== $dataExtension) {
                $dataExtension->configureOptions($this->optionsResolver[$name]);
            }
            $targetExtension = $this->getTargetExtension($name);
            if (null !== $targetExtension) {
                $targetExtension->configureOptions($this->optionsResolver[$name]);
            }
        }

        return $this->optionsResolver[$name]->resolve($context);
    }

    /**
     * @param string $extractName
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     *
     * @return DataExtensionInterface
     */
    private function getDataExtension(string $extractName): DataExtensionInterface
    {
        return $this->dataExtensions->has($extractName) ? $this->dataExtensions->get($extractName) : $this->dataExtension;
    }

    /**
     * @param string $extractName
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     *
     * @return TargetExtensionInterface
     */
    private function getTargetExtension(string $extractName): TargetExtensionInterface
    {
        return $this->targetExtensions->has($extractName) ? $this->targetExtensions->get($extractName) : $this->targetExtension;
    }
}
