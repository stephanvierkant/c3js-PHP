<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

final class Point implements \JsonSerializable
{
    private array $data = [];

    /**
     * Whether to show each point in line
     *
     * @link http://c3js.org/reference.html#point-show
     */
    public function setVisibility(bool $visibility = true): void
    {
        $this->data['show'] = $visibility;
    }

    /**
     * The radius size of each point
     *
     * @link http://c3js.org/reference.html#point-r
     */
    public function setR(float $r = 2.5): void
    {
        $this->data['r'] = $r;
    }

    /**
     * Whether to expand each point on focus
     *
     * @link http://c3js.org/reference.html#point-focus-expand-enabled
     */
    public function setFocusExpandEnabled(bool $enabled = true): void
    {
        $this->ensureFocusExpand();
        $this->data['focus']['expand']['enabled'] = $enabled;
    }

    /**
     * The radius size of each point on focus
     *
     * @link http://c3js.org/reference.html#point-focus-expand-r
     */
    public function setFocusExpandR(float $r): void
    {
        $this->ensureFocusExpand();
        $this->data['focus']['expand']['r'] = $r;
    }

    /**
     * The radius size of each point on selected
     * @param $r
     * @link http://c3js.org/reference.html#point-select-r
     */
    public function setSelectR($r): void
    {
        if (!isset($this->data['select'])) {
            $this->data['select'] = [];
        }

        $this->data['select']['r'] = $r;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }

    private function ensureFocusExpand(): void
    {
        if (!isset($this->data['focus'])) {
            $this->data['focus'] = [];
        }

        if (!isset($this->data['focus']['expand'])) {
            $this->data['focus']['expand'] = [];
        }
    }
}
