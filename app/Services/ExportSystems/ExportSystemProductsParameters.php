<?php

namespace App\Services\ExportSystems;

use App\Enum\DefaultStatusEnum;
use App\Models\ExportSystem;

class ExportSystemProductsParameters
{
    private ExportSystem      $exportSystem;
    private string            $name;
    private DefaultStatusEnum $status;
    private string            $uniqueId;
    private ?float            $price = null;
    private ?int              $min   = null;
    private ?int              $max   = null;
    private object            $data;

    /**
     * @return \App\Models\ExportSystem
     */
    public function getExportSystem(): ExportSystem
    {
        return $this->exportSystem;
    }

    /**
     * @param \App\Models\ExportSystem $exportSystem
     *
     * @return ExportSystemProductsParameters
     */
    public function setExportSystem(ExportSystem $exportSystem): ExportSystemProductsParameters
    {
        $this->exportSystem = $exportSystem;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return ExportSystemProductsParameters
     */
    public function setName(string $name): ExportSystemProductsParameters
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \App\Enum\DefaultStatusEnum
     */
    public function getStatus(): DefaultStatusEnum
    {
        return $this->status;
    }

    /**
     * @param \App\Enum\DefaultStatusEnum $status
     *
     * @return ExportSystemProductsParameters
     */
    public function setStatus(DefaultStatusEnum $status): ExportSystemProductsParameters
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueId
     *
     * @return ExportSystemProductsParameters
     */
    public function setUniqueId(string $uniqueId): ExportSystemProductsParameters
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     *
     * @return ExportSystemProductsParameters
     */
    public function setPrice(?float $price): ExportSystemProductsParameters
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * @param int|null $min
     *
     * @return ExportSystemProductsParameters
     */
    public function setMin(?int $min): ExportSystemProductsParameters
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * @param int|null $max
     *
     * @return ExportSystemProductsParameters
     */
    public function setMax(?int $max): ExportSystemProductsParameters
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @return object
     */
    public function getData(): object
    {
        return $this->data;
    }

    /**
     * @param object $data
     *
     * @return ExportSystemProductsParameters
     */
    public function setData(object $data): ExportSystemProductsParameters
    {
        $this->data = $data;

        return $this;
    }


}
