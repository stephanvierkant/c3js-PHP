<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP\Charts;

final class Gauge implements \JsonSerializable
{
    public const TYPE_TIMESERIES = 'timeseries';
    public const TYPE_CATEGORY = 'category';
    public const TYPE_INDEXED = 'indexed';

    private array $data = [];

    /**
     * Show or hide label on gauge
     * @link http://c3js.org/reference.html#gauge-label-show
     */
    public function setLabelVisibility(bool $visibility = true): void
    {
       $this->ensureLabel();
        $this->data['label']['show'] = $visibility;
    }

    /**
     * Set formatter for the label on gauge
     * @link http://c3js.org/reference.html#gauge-label-format
     */
    public function setLabelFormat(string $format): void
    {
        $this->ensureLabel();
        $this->data['label']['format'] = $format;
    }


    /**
     * Enable or disable expanding gauge
     * @link http://c3js.org/reference.html#gauge-expand
     */
    public function setExpand(bool $expand = true): void
    {
        $this->data['expand'] = $expand;
    }

    /**
     * Set min value of the gauge
     * @link http://c3js.org/reference.html#gauge-min
     */
    public function setMin(int $min = 0): void
    {
        $this->data['min'] = $min;
    }

    /**
     * Set max value of the gauge
     * @link http://c3js.org/reference.html#gauge-max
     */
    public function setMax(int $max = 100): void
    {
        $this->data['max'] = $max;
    }

    /**
     * Set units of the gauge
     * @link http://c3js.org/reference.html#gauge-units
     */
    public function setUnits(string $units): void
    {
        $this->data['units'] = $units;
    }

    /**
     * Set width of gauge chart
     * @link http://c3js.org/reference.html#gauge-width
     */
    public function setWidth(int $width): void
    {
        $this->data['width'] = $width;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }

    private function ensureLabel(): void
    {
        if (!isset($this->data['label'])) {
            $this->data['label'] = [];
        }
    }
}
