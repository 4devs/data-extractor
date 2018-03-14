<?php

namespace FDevs\DataExtractor\Extension\Data;


use FDevs\DataExtractor\Extension\DataExtensionInterface;
use FDevs\DataExtractor\ExtractedInterface;
use League\Pipeline\Pipeline;
use Psr\Container\ContainerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PipelineExtension implements DataExtensionInterface
{
    /**
     * @var ContainerInterface
     */
    private $pipelineRegistry;

    /**
     * PipelineExtension constructor.
     *
     * @param ContainerInterface $pipelineRegistry
     */
    public function __construct(ContainerInterface $pipelineRegistry)
    {
        $this->pipelineRegistry = $pipelineRegistry;
    }

    /**
     * @inheritDoc
     */
    public function process(ExtractedInterface $data, array $options = []): ExtractedInterface
    {
        $className = \get_class($data);
        if ($this->pipelineRegistry->has($className)) {
            $data = $this->getPipeline($className)->process($data);
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * @param string $name
     *
     * @return Pipeline
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function getPipeline(string $name): Pipeline
    {
        return $this->pipelineRegistry->get($name);
    }
}