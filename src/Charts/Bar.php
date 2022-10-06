<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP\Charts;

final class Bar implements \JsonSerializable
{
    private array $data = [];

    /**
     * Change the width of bar chart
     * @link http://c3js.org/reference.html#bar-width
     */
    public function setWidth(int $width): void
    {
        $this->data['width'] = $width;
    }

    /**
     * Change the width of bar chart by ratio
     * @link http://c3js.org/reference.html#bar-width-ratio
     */
    public function setWidthRatio(float $ratio): void
    {
        $this->data['ratio'] = $ratio;
    }

    /**
     * Set if min or max value will be 0 on bar chart
     * @link http://c3js.org/reference.html#bar-zerobased
     */
    public function setZerobased(bool $zerobased = true): void
    {
        $this->data['zerobased'] = $zerobased;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }
}
