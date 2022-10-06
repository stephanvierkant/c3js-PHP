<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

/**
 * Show rectangles inside the chart
 *
 * @link http://c3js.org/reference.html#regions
 */
final class Region implements \JsonSerializable
{
    public const AXIS_X = 'x';
    public const AXIS_Y = 'y';
    public const AXIS_Y2 = 'y2';

    private array $data = [];

    /**
     * @param AXIS_X|AXIS_Y|AXIS_Y2 $axis
     */
    public function setAxis($axis): void
    {
        $this->data['axis'] = $axis;
    }

    public function setX(int $x): void
    {
        $this->data['x'] = $x;
    }

    public function setY(int $y): void
    {
        $this->data['y'] = $y;
    }

    public function setClass(string $class): void
    {
        $this->data['class'] = $class;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }
}
