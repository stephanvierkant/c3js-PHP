<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP\Charts;

final class Pie implements \JsonSerializable
{
    private array $data = [];

    /**
     * Show or hide label on each pie piece
     * @param $visibility
     * @link http://c3js.org/reference.html#pie-label-show
     */
    public function setLabelVisibility($visibility = true): void
    {
        $this->ensureLabel();
        $this->data['label']['show'] = $visibility;
    }

    /**
     * Set formatter for the label on each pie piece
     *
     * @link http://c3js.org/reference.html#pie-label-format
     */
    public function setLabelFormat(string $format): void
    {
        $this->ensureLabel();
        $this->data['label']['format'] = $format;
    }


    /**
     * Set threshold to show/hide labels
     *
     * @link http://c3js.org/reference.html#pie-label-threshold
     */
    public function setLabeltThreshold(float $threshold = 0.05): void
    {
        $this->ensureLabel();
        $this->data['label']['threshold'] = $threshold;
    }

    /**
     * Enable or disable expanding pie pieces
     *
     * @link http://c3js.org/reference.html#pie-expand
     */
    public function setExpand(bool $expand = true): void
    {
        $this->data['expand'] = $expand;
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
