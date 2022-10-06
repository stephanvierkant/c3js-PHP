<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP\Charts;

final class Donut implements \JsonSerializable
{
    private array $data = [];

    /**
     * Show or hide label on each donut piece
     * @param $visibility
     * @link http://c3js.org/reference.html#donut-label-show
     */
    public function setLabelVisibility($visibility = true): void
    {
        $this->ensureLabel();
        $this->data['label']['show'] = $visibility;
    }

    /**
     * Set formatter for the label on each donut piece
     *
     * @link http://c3js.org/reference.html#donut-label-format
     */
    public function setLabelFormat(string $format): void
    {
        $this->ensureLabel();
        $this->data['label']['format'] = $format;
    }

    /**
     * Set threshold to show/hide labels
     *
     * @link http://c3js.org/reference.html#donut-label-threshold
     */
    public function setLabelThreshold(float $threshold = 0.05): void
    {
        $this->ensureLabel();
        $this->data['label']['threshold'] = $threshold;
    }

    /**
     * Enable or disable expanding donut pieces
     *
     * @link http://c3js.org/reference.html#donut-expand
     */
    public function setExpand(bool $expand = true): void
    {
        $this->data['expand'] = $expand;
    }

    /**
     * Set width of donut chart
     *
     * @link http://c3js.org/reference.html#donut-width
     */
    public function setWidth(int $width): void
    {
        $this->data['width'] = $width;
    }

    /**
     * Set title of donut chart
     *
     * @link http://c3js.org/reference.html#donut-title
     */
    public function setTitle(string $title = ''): void
    {
        $this->data['title'] = $title;
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
