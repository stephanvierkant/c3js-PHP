<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

/**
 * Experimental
 */
final class Subchart implements \JsonSerializable
{
    /**
     * @var mixed[][]|\Astroanu\C3jsPHP\Callback[]
     */
    private array $data = [];

    /**
     * Show sub chart on the bottom of the chart
     *
     * @link http://c3js.org/reference.html#subchart-show
     */
    public function setVisibility(bool $visibility = false): void
    {
        $this->data['show'] = $visibility;
    }

    /**
     * Change the height of the subchart
     *
     * @link http://c3js.org/reference.html#subchart-size-height
     */
    public function setSizeHeight(int $height): void
    {
        if (!isset($this->data['size'])) {
            $this->data['size'] = [];
        }

        $this->data['size']['height'] = $height;
    }

    /**
     * Set callback for brush event
     * @param Callback $callback
     * @link http://c3js.org/reference.html#subchart-onbrush
     */
    public function setOnBrush(Callback $callback): void
    {
        $this->data['onbrush'] = $callback;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }
}
