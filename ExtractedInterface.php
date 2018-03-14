<?php

namespace FDevs\DataExtractor;

interface ExtractedInterface extends \Iterator, \Countable
{
    /**
     * @return \Iterator
     */
    public function getExtractedData(): \Iterator;

    /**
     * @param \Iterator $data
     *
     * @return ExtractedInterface
     */
    public function setExtractedData(\Iterator $data): self;
}
