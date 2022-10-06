<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

/**
 * Experimental
 */
final class Zoom implements \JsonSerializable
{
    private array $data = [];

    /**
     * Enable zooming
     *
     * @link http://c3js.org/reference.html#zoom-enabled
     */
    public function setEnabled(bool $enabled = false): void
    {
        $this->data['enabled'] = $enabled;
    }

    /**
     * Enable to rescale after zooming
     *
     * @link http://c3js.org/reference.html#zoom-rescale
     */
    public function setRescale(bool $rescale = false): void
    {
        $this->data['rescale'] = $rescale;
    }

    /**
     * Change zoom extent
     *
     * @link http://c3js.org/reference.html#zoom-extent
     * @param mixed[] $extent
     */
    public function setExtent(array $extent = [1, 10]): void
    {
        $this->data['extent'] = $extent;
    }

    /**
     * Set callback that is called when the chart is zooming
     * @param Callback $callback
     * @link http://c3js.org/reference.html#zoom-onzoom
     */
    public function setOnZoom(Callback $callback): void
    {
        $this->data['onzoom'] = $callback;
    }

    /**
     * Set callback that is called when zooming starts
     * @param Callback $callback
     * @link http://c3js.org/reference.html#zoom-onzoomstart
     */
    public function setOnZoomStart(Callback $callback): void
    {
        $this->data['onzoomstart'] = $callback;
    }

    /**
     * Set callback that is called when zooming ends
     * @param Callback $callback
     * @link http://c3js.org/reference.html#zoom-onzoomend
     */
    public function setOnZoomEnd(Callback $callback): void
    {
        $this->data['onzoomend'] = $callback;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }
}
