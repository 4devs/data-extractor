<?php

namespace FDevs\DataExtractor\Exception;

class ExtractNotFoundException extends Exception
{
    /**
     * @var mixed
     */
    private $target;

    /**
     * @var array
     */
    private $context;

    /**
     * {@inheritdoc}
     */
    public function __construct($target, array $context, \Throwable $previous = null)
    {
        $targetType = \is_object($target) ? \get_class($target) : gettype($target);
        $message = \sprintf('Extract by target type "%s" not found', $targetType);
        $this->target = $target;
        $this->context = $context;
        parent::__construct($message, 0, $previous);
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
