<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

final class Grid implements \JsonSerializable
{
    private array $data = [];

    /**
     * Show grids along x axis
     * @link http://c3js.org/reference.html#grid-x-show
     */
    public function setXVisibility(bool $visibility = false): void
    {
        $this->ensureX();
        $this->data['x']['show'] = $visibility;
    }

    /**
     * Set additional grid lines along x axis
     * @link http://c3js.org/reference.html#grid-x-lines
     * @param mixed[] $lines
     */
    public function setXLines(array $lines): void
    {
        $this->ensureX();
        $this->data['x']['lines'] = $lines;
    }

    /**
     * Show grids along y axis
     * @link http://c3js.org/reference.html#grid-y-show
     */
    public function setYVisibility(bool $visibility = false): void
    {
        $this->ensureY();
        $this->data['y']['show'] = $visibility;
    }

    /**
     * Set additional grid lines along y axis
     * @link http://c3js.org/reference.html#grid-y-lines
     * @param mixed[] $lines
     */
    public function setYLines(array $lines): void
    {
        $this->ensureY();

        $this->data['y']['lines'] = $lines;
    }

    /**
     * @return mixed[]
     */
    public function JsonSerialize(): array
    {
        return $this->data;
    }

    private function ensureX(): void
    {
        if (!isset($this->data['x'])) {
            $this->data['x'] = [];
        }
    }

    private function ensureY(): void
    {
        if (!isset($this->data['y'])) {
            $this->data['y'] = [];
        }
    }
}
