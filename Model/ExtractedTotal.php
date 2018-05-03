<?php

namespace FDevs\DataExtractor\Model;

use FDevs\DataExtractor\TotalInterface;

class ExtractedTotal extends Extracted implements TotalInterface
{
    /**
     * @var int
     */
    private $total = 0;

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     *
     * @return ExtractedTotal
     */
    public function setTotal(int $total): ExtractedTotal
    {
        $this->total = $total;

        return $this;
    }
}
