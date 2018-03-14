<?php

namespace FDevs\DataExtractor\Model;

use FDevs\DataExtractor\ExtractedInterface;

class Extracted implements ExtractedInterface
{
    /**
     * @var \Iterator
     */
    private $data;

    /**
     * {@inheritdoc}
     */
    public function getExtractedData(): \Iterator
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function setExtractedData(\Iterator $data): ExtractedInterface
    {
        $this->data = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->data->current();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->data->next();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->data->key();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->data->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->data->rewind();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return \count(iterator_to_array($this->data));
    }
}
