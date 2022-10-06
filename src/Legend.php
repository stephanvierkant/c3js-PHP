<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

final class Legend implements \JsonSerializable
{
    public const POSITION_BOTTOM = 'bottom';
    public const POSITION_RIGHT = 'right';
    public const POSITION_INSET = 'inset';

    public const INSET_TOP_LEFT = 'top-left';
    public const INSET_TOP_RIGHT = 'top-right';
    public const INSET_BOTTOM_LEFT = 'bottom-left';
    public const INSET_BOTTOM_RIGHT = 'bottom-right';

    private array $data = [];

    /**
     * Show or hide legend
     *
     * @link http://c3js.org/reference.html#legend-show
     */
    public function setVisibility(bool $visibility = true): void
    {
        $this->data['show'] = $visibility;
    }

    /**
     * Hide legend
     * @param bool|string|array $hidden
     * @link http://c3js.org/reference.html#legend-hide
     */
    public function setHidden($hidden = false): void
    {
        $this->data['hide'] = $hidden;
    }

    /**
     * Change the position of legend
     * @param POSITION_BOTTOM|POSITION_RIGHT|POSITION_INSET $position
     * @link http://c3js.org/reference.html#legend-position
     */
    public function setPosition($position = self::POSITION_BOTTOM): void
    {
        $this->data['position'] = $position;
    }

    /**
     * Change inset legend anchor
     * @param INSET_TOP_LEFT|INSET_TOP_RIGHT|INSET_BOTTOM_LEFT|INSET_BOTTOM_RIGHT $anchor
     * @link http://c3js.org/reference.html#legend-inset
     * @see setInsetX()
     * @see setInsetY()
     * @see setInsetStep()
     */
    public function setInsetAnchor($anchor = self::INSET_TOP_LEFT): void
    {
        $this->ensureInset();
        $this->data['inset']['anchor'] = $anchor;
    }

    /**
     * Change inset legend x
     *
     * @link http://c3js.org/reference.html#legend-inset
     * @see setInsetAnchor()
     * @see setInsetY()
     * @see setInsetStep()
     */
    public function setInsetX(int $x = 10): void
    {
        $this->ensureInset();
        $this->data['inset']['x'] = $x;
    }

    /**
     * Change inset legend y
     *
     * @link http://c3js.org/reference.html#legend-inset
     * @see setInsetAnchor()
     * @see setInsetX()
     * @see setInsetStep()
     */
    public function setInsetY(int $y = 0): void
    {
        $this->ensureInset();
        $this->data['inset']['y'] = $y;
    }

    /**
     * Change inset legend step
     *
     * @link http://c3js.org/reference.html#legend-inset
     * @see setInsetAnchor()
     * @see setInsetX()
     * @see setInsetY()
     */
    public function setInsetStep(int $step): void
    {
        $this->ensureInset();
        $this->data['inset']['step'] = $step;
    }

    /**
     * Set click event handler to the legend item
     * @param Callback $callback
     * @link http://c3js.org/reference.html#legend-item-onclick
     */
    public function setItemOnClick(Callback $callback): void
    {
        $this->ensureItem();
        $this->data['item']['onclick'] = $callback;
    }

    /**
     * Set mouseover event handler to the legend item
     * @param Callback $callback
     * @link http://c3js.org/reference.html#legend-item-onmouseover
     */
    public function setItemOnMouseOver(Callback $callback): void
    {
        $this->ensureItem();
        $this->data['item']['onmouseover'] = $callback;
    }

    /**
     * Set mouseout event handler to the legend item
     * @param Callback $callback
     * @link http://c3js.org/reference.html#legend-item-onmouseout
     */
    public function setItemOnMouseOut(Callback $callback): void
    {
        $this->ensureItem();
        $this->data['item']['onmouseout'] = $callback;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }

    private function ensureInset(): void
    {
        if (!isset($this->data['inset'])) {
            $this->data['inset'] = [];
        }
    }

    private function ensureItem(): void
    {
        if (!isset($this->data['item'])) {
            $this->data['item'] = [];
        }
    }
}
