<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

final class Axis implements \JsonSerializable
{
    public const TYPE_TIMESERIES = 'timeseries';
    public const TYPE_CATEGORY = 'category';
    public const TYPE_INDEXED = 'indexed';

    public const POSITION_H_INNER_RIGHT = 'inner-right';
    public const POSITION_H_INNER_CENTER = 'inner-center';
    public const POSITION_H_INNER_LEFT = 'inner-left';
    public const POSITION_H_OUTER_RIGHT = 'outer-right';
    public const POSITION_H_OUTER_CENTER = 'outer-center';
    public const POSITION_H_OUTER_LEFT = 'outer-left';

    public const POSITION_V_INNER_TOP = 'inner-top';
    public const POSITION_V_INNER_MIDDLE = 'inner-middle';
    public const POSITION_V_INNER_BOTTOM = 'inner-bottom';
    public const POSITION_V_OUTER_TOP = 'outer-top';
    public const POSITION_V_OUTER_MIDDLE = 'outer-middle';
    public const POSITION_V_OUTER_BOTTOM = 'outer-bottom';

    private array $data = [];

    /**
     * Switch x and y axis position
     * @link http://c3js.org/reference.html#axis-rotated
     */
    public function setRotated(bool $rotated = false): void
    {
        $this->data['rotated'] = $rotated;
    }

    /**
     * Show or hide x axis
     * @link http://c3js.org/reference.html#axis-x-show
     */
    public function setXVisibility(bool $visibility = false): void
    {
        $this->ensureX();
        $this->data['x']['show'] = $visibility;
    }

    /**
     * Set type of x axis
     * @link http://c3js.org/reference.html#axis-x-type
     */
    public function setXType(string $type = self::TYPE_INDEXED): void
    {
        $this->ensureX();
        $this->data['x']['type'] = $type;
    }

    /**
     * Set how to treat the timezone of x values
     * @link http://c3js.org/reference.html#axis-x-localtime
     */
    public function setXLocaltime(bool $localtime = true): void
    {
        $this->ensureX();
        $this->data['x']['localtime'] = $localtime;
    }

    /**
     * Set category names on category axis
     * @link http://c3js.org/reference.html#axis-x-categories
     * @param mixed[] $categories
     */
    public function setXCategories(array $categories): void
    {
        $this->ensureX();
        $this->data['x']['categories'] = $categories;
    }

    /**
     * Centerise ticks on category axis.
     * @link http://c3js.org/reference.html#axis-x-tick-centered
     */
    public function setXTickCentered(bool $centered = false): void
    {
        $this->ensureXTick();
        $this->data['x']['tick']['centered'] = $centered;
    }

    /**
     * A function to format tick value
     * @param string $format d3.format
     * @link http://c3js.org/reference.html#axis-x-tick-format
     */
    public function setXTickFormat(string $format): void
    {
        $this->ensureXTick();
        $this->data['x']['tick']['format'] = $format;
    }

    /**
     * Setting for culling ticks
     * @link http://c3js.org/reference.html#axis-x-tick-culling
     */
    public function setXTickCulling(bool $culling): void
    {
        $this->ensureXTick();
        $this->data['x']['tick']['culling'] = $culling;
    }


    /**
     * The number of tick texts will be adjusted to less than this value
     * @link http://c3js.org/reference.html#axis-x-tick-culling-max
     */
    public function setXTickCullingMax(int $max = 10): void
    {
        $this->ensureXTick();

        if (!isset($this->data['x']['tick']['culling'])) {
            $this->data['x']['tick']['culling'] = [];
        }

        $this->data['x']['tick']['culling']['max'] = $max;
    }

    /**
     * The number of x axis ticks to show
     * @link http://c3js.org/reference.html#axis-x-tick-count
     */
    public function setXTickCount(int $count): void
    {
        $this->ensureXTick();
        $this->data['x']['tick']['count'] = $count;
    }

    /**
     * Fit x axis ticks
     * @link http://c3js.org/reference.html#axis-x-tick-fit
     */
    public function setXTickFit(bool $fit = true): void
    {
        $this->ensureXTick();
        $this->data['x']['tick']['fit'] = $fit;
    }

    /**
     * Set the x values of ticks manually
     * @link http://c3js.org/reference.html#axis-x-tick-values
     * @param mixed[] $values
     */
    public function setXTickValues(array $values): void
    {
        $this->ensureXTick();
        $this->data['x']['tick']['values'] = $values;
    }

    /**
     * Rotate x axis tick text
     * @link http://c3js.org/reference.html#axis-x-tick-rotate
     */
    public function setXTickRotate(int $angle = 0): void
    {
        $this->ensureXTick();
        $this->data['x']['tick']['rotate'] = $angle;
    }

    /**
     * Show x axis outer tick
     * @link http://c3js.org/reference.html#axis-x-tick-outer
     */
    public function setXTickOuter(bool $outer = true): void
    {
        $this->ensureXTick();
        $this->data['x']['tick']['outer'] = $outer;
    }

    /**
     * Set max value of x axis range
     * @link http://c3js.org/reference.html#axis-x-max
     */
    public function setXMax(int $max): void
    {
        $this->ensureX();
        $this->data['x']['max'] = $max;
    }

    /**
     * Set min value of x axis range
     * @link http://c3js.org/reference.html#axis-x-min
     */
    public function setXMin(int $min): void
    {
        $this->ensureX();
        $this->data['x']['min'] = $min;
    }

    /**
     * Set left padding for x axis
     * @link http://c3js.org/reference.html#axis-x-padding
     * @see setXPaddingRight()
     */
    public function setXPaddingLeft(int $left): void
    {
        $this->ensureXPadding();
        $this->data['x']['padding']['left'] = $left;
    }

    /**
     * Set right padding for x axis
     * @link http://c3js.org/reference.html#axis-x-padding
     * @see setXPaddingLeft()
     */
    public function setXPaddingRight(int $right): void
    {
        $this->ensureXPadding();
        $this->data['x']['padding']['right'] = $right;
    }

    /**
     * Set height of x axis
     * @param int $height Height in pixel
     * @link http://c3js.org/reference.html#axis-x-height
     */
    public function setXHeight(int $height): void
    {
        $this->ensureX();
        $this->data['x']['height'] = $height;
    }

    /**
     * Set default extent for subchart and zoom
     * @link http://c3js.org/reference.html#axis-x-extent
     * @param mixed[] $extent
     */
    public function setXExtent(array $extent): void
    {
        $this->ensureX();
        $this->data['x']['extent'] = $extent;
    }

    /**
     * Set label text on x axis
     * @link http://c3js.org/reference.html#axis-x-label
     * @see setXLabelPosition()
     */
    public function setXLabelText(string $text): void
    {
        $this->ensureXLabel();
        $this->data['x']['label']['text'] = $text;
    }

    /**
     * Set label text position on x axis
     * @param POSITION_H_INNER_RIGHT|POSITION_H_INNER_CENTER|POSITION_H_INNER_LEFT|POSITION_H_OUTER_RIGHT|POSITION_H_OUTER_CENTER|POSITION_H_OUTER_LEFT|POSITION_V_INNER_TOP|POSITION_V_INNER_MIDDLE|POSITION_V_INNER_BOTTOM|POSITION_V_OUTER_TOP|POSITION_V_OUTER_MIDDLE|POSITION_V_OUTER_BOTTOM $const
     * @link http://c3js.org/reference.html#axis-x-label
     * @see setXLabelText()
     */
    public function setXLabelPosition($const): void
    {
        $this->ensureXLabel();
        $this->data['x']['label']['position'] = $const;
    }

    /**
     * Show or hide y axis
     * @link http://c3js.org/reference.html#axis-y-show
     */
    public function setYVisibility(bool $visibility = true): void
    {
        $this->ensureY();
        $this->data['y']['show'] = $visibility;
    }

    /**
     * Show y axis inside of the chart
     * @link http://c3js.org/reference.html#axis-y-inner
     */
    public function setYInner(bool $inner = false): void
    {
        $this->ensureY();
        $this->data['y']['inner'] = $inner;
    }

    /**
     * Set max value of y axis
     * @link http://c3js.org/reference.html#axis-y-max
     */
    public function setYMax(int $max): void
    {
        $this->ensureY();
        $this->data['y']['max'] = $max;
    }

    /**
     * Set min value of y axis
     * @link http://c3js.org/reference.html#axis-y-min
     */
    public function setYMin(int $min): void
    {
        $this->ensureY();
        $this->data['y']['min'] = $min;
    }

    /**
     * Change the direction of y axis
     * @link http://c3js.org/reference.html#axis-y-inverted
     */
    public function setYInverted(bool $inverted = false): void
    {
        $this->ensureY();
        $this->data['y']['inverted'] = $inverted;
    }

    /**
     * Set center value of y axis
     * @link http://c3js.org/reference.html#axis-y-center
     */
    public function setYCenter(int $center): void
    {
        $this->ensureY();
        $this->data['y']['center'] = $center;
    }

    /**
     * Set label on y axis
     * @link http://c3js.org/reference.html#axis-y-label
     * @see setYLabelPosition()
     */
    public function setYLabelText(string $text): void
    {
        $this->ensureYLabel();
        $this->data['y']['label']['text'] = $text;
    }

    /**
     * Set label position on y axis
     * @param POSITION_H_INNER_RIGHT|POSITION_H_INNER_CENTER|POSITION_H_INNER_LEFT|POSITION_H_OUTER_RIGHT|POSITION_H_OUTER_CENTER|POSITION_H_OUTER_LEFT|POSITION_V_INNER_TOP|POSITION_V_INNER_MIDDLE|POSITION_V_INNER_BOTTOM|POSITION_V_OUTER_TOP|POSITION_V_OUTER_MIDDLE|POSITION_V_OUTER_BOTTOM $const
     * @link http://c3js.org/reference.html#axis-y-label
     * @see setYLabelText()
     */
    public function setYLabelPosition($const): void
    {
        $this->ensureYLabel();
        $this->data['y']['label']['position'] = $const;
    }

    /**
     * Set formatter for y axis tick text
     * @param string $format d3.format
     * @link http://c3js.org/reference.html#axis-y-tick-format
     */
    public function setYTickFormat(string $format): void
    {
        $this->ensureYTick();
        $this->data['y']['tick']['format'] = $format;
    }

    /**
     * Show or hide outer tick
     * @link http://c3js.org/reference.html#axis-y-tick-outer
     */
    public function setYTickOuter($outer): void
    {
        $this->ensureYTick();
        $this->data['y']['tick']['outer'] = $outer;
    }

    /**
     * Set y axis tick values manually
     * @link http://c3js.org/reference.html#axis-y-tick-values
     * @param mixed[] $values
     */
    public function setYTickValues(array $values): void
    {
        $this->ensureYTick();
        $this->data['y']['tick']['values'] = $values;
    }

    /**
     * Set the number of y axis ticks
     * @link http://c3js.org/reference.html#axis-y-tick-count
     */
    public function setYTickCount(int $count): void
    {
        $this->ensureYTick();
        $this->data['y']['tick']['count'] = $count;
    }

    /**
     * Set top padding for y axis
     * http://c3js.org/reference.html#axis-y-padding
     * @see setYPaddingBottom()
     */
    public function setYPaddingTop(int $top): void
    {
        $this->ensureYPadding();
        $this->data['y']['padding']['top'] = $top;
    }

    /**
     * Set bottom padding for y axis
     * http://c3js.org/reference.html#axis-y-padding
     * @see setYPaddingTop()
     */
    public function setYPaddingBottom(int $bottom): void
    {
        $this->ensureYPadding();
        $this->data['y']['padding']['bottom'] = $bottom;
    }

    /**
     * Set default range of y axis
     * @link http://c3js.org/reference.html#axis-y-default
     * @param mixed[] $range
     */
    public function setYDefault(array $range): void
    {
        $this->ensureY();
        $this->data['y']['default'] = $range;
    }

    /**
     * Show or hide y2 axis
     * @link http://c3js.org/reference.html#axis-y2-show
     */
    public function setY2Visibility(bool $visibility = false): void
    {
        $this->ensureY2();
        $this->data['y2']['show'] = $visibility;
    }

    /**
     * Show y2 axis inside of the chart
     * @link http://c3js.org/reference.html#axis-y2-inner
     */
    public function setY2Inner(bool $inner = false): void
    {
        $this->ensureY2();
        $this->data['y2']['inner'] = $inner;
    }

    /**
     * Set max value of y2 axis
     * @link http://c3js.org/reference.html#axis-y2-max
     */
    public function setY2Max(int $max): void
    {
        $this->ensureY2();
        $this->data['y2']['max'] = $max;
    }

    /**
     * Set min value of y2 axis
     * @link http://c3js.org/reference.html#axis-y2-min
     */
    public function setY2Min(int $min): void
    {
        $this->ensureY2();
        $this->data['y2']['min'] = $min;
    }

    /**
     * Change the direction of y2 axis
     * @link http://c3js.org/reference.html#axis-y2-inverted
     */
    public function setY2Inverted(bool $inverted = false): void
    {
        $this->ensureY2();
        $this->data['y2']['inverted'] = $inverted;
    }

    /**
     * Set center value of y2 axis
     * @link http://c3js.org/reference.html#axis-y2-center
     */
    public function setY2Center(int $center): void
    {
        $this->ensureY2();
        $this->data['y2']['center'] = $center;
    }

    /**
     * Set label on y2 axis
     * @link http://c3js.org/reference.html#axis-y2-label
     * @see setY2LabelPosition()
     */
    public function setY2LabelText(string $text): void
    {
        $this->ensureY2Label();
        $this->data['y2']['label']['text'] = $text;
    }

    /**
     * Set label position on y2 axis
     * @param POSITION_H_INNER_RIGHT|POSITION_H_INNER_CENTER|POSITION_H_INNER_LEFT|POSITION_H_OUTER_RIGHT|POSITION_H_OUTER_CENTER|POSITION_H_OUTER_LEFT|POSITION_V_INNER_TOP|POSITION_V_INNER_MIDDLE|POSITION_V_INNER_BOTTOM|POSITION_V_OUTER_TOP|POSITION_V_OUTER_MIDDLE|POSITION_V_OUTER_BOTTOM $const
     * @link http://c3js.org/reference.html#axis-y2-label
     * @see setY2LabelText()
     */
    public function setY2LabelPosition($const): void
    {
        $this->ensureY2Label();
        $this->data['y2']['label']['position'] = $const;
    }

    /**
     * Set formatter for y2 axis tick text
     * @param string $format d3.format
     * @link http://c3js.org/reference.html#axis-y2-tick-format
     */
    public function setY2TickFormat(string $format): void
    {
        $this->ensureY2Tick();
        $this->data['y2']['tick']['format'] = $format;
    }

    /**
     * Show or hide outer tick
     * @param $outer
     * @link http://c3js.org/reference.html#axis-y2-tick-outer
     */
    public function setY2TickOuter($outer): void
    {
        $this->ensureY2Tick();
        $this->data['y2']['tick']['outer'] = $outer;
    }

    /**
     * Set y2 axis tick values manually
     * @link http://c3js.org/reference.html#axis-y2-tick-values
     * @param mixed[] $values
     */
    public function setY2TickValues(array $values): void
    {
        $this->ensureY2Tick();
        $this->data['y2']['tick']['values'] = $values;
    }

    /**
     * Set the number of y2 axis ticks
     * @link http://c3js.org/reference.html#axis-y2-tick-count
     */
    public function setY2TickCount(int $count): void
    {
        $this->ensureY2Tick();
        $this->data['y2']['tick']['count'] = $count;
    }

    /**
     * Set top padding for y2 axis
     * http://c3js.org/reference.html#axis-y2-padding
     * @see setY2PaddingBottom()
     */
    public function setY2PaddingTop(int $top): void
    {
        $this->ensureY2Padding();
        $this->data['y2']['padding']['top'] = $top;
    }

    /**
     * Set bottom padding for y2 axis
     * @param int $bottom
     * http://c3js.org/reference.html#axis-y2-padding
     * @see setY2PaddingTop()
     */
    public function setY2PaddingBottom(int $bottom): void
    {
        $this->ensureY2Padding();
        $this->data['y2']['padding']['bottom'] = $bottom;
    }

    /**
     * Set default range of y2 axis
     * @link http://c3js.org/reference.html#axis-y2-default
     * @param mixed[] $range
     */
    public function setY2Default(array $range): void
    {
        $this->ensureY2();
        $this->data['y2']['default'] = $range;
    }

    /**
     * @param $fit
     * @fixme Undocumented. Is this really working?
     */
    public function setYTickFit($fit): void
    {
        $this->ensureYTick();
        $this->data['y']['tick']['fit'] = $fit;
    }

    /**
     * @param $angle
     * @fixme Undocumented. Is this really working?
     */
    public function setYTickRotate($angle): void
    {
        $this->ensureYTick();
        $this->data['y']['tick']['rotate'] = $angle;
    }

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

    private function ensureXLabel(): void
    {
        $this->ensureX();

        if (!isset($this->data['x']['label'])) {
            $this->data['x']['label'] = [];
        }
    }

    private function ensureXPadding(): void
    {
        $this->ensureX();

        if (!isset($this->data['x']['padding'])) {
            $this->data['x']['padding'] = [];
        }
    }

    private function ensureXTick(): void
    {
        $this->ensureX();

        if (!isset($this->data['x']['tick'])) {
            $this->data['x']['tick'] = [];
        }
    }

    private function ensureY(): void
    {
        if (!isset($this->data['y'])) {
            $this->data['y'] = [];
        }
    }

    private function ensureYLabel(): void
    {
        $this->ensureY();

        if (!isset($this->data['y']['label'])) {
            $this->data['y']['label'] = [];
        }
    }

    private function ensureYTick(): void
    {
        $this->ensureY();

        if (!isset($this->data['y']['tick'])) {
            $this->data['y']['tick'] = [];
        }
    }

    private function ensureYPadding(): void
    {
        $this->ensureY();

        if (!isset($this->data['y']['padding'])) {
            $this->data['y']['padding'] = [];
        }
    }

    private function ensureY2(): void
    {
        if (!isset($this->data['y2'])) {
            $this->data['y2'] = [];
        }
    }

    private function ensureY2Label(): void
    {
        $this->ensureY2();

        if (!isset($this->data['y2']['label'])) {
            $this->data['y2']['label'] = [];
        }
    }

    private function ensureY2Tick(): void
    {
        $this->ensureY2();

        if (!isset($this->data['y2']['tick'])) {
            $this->data['y2']['tick'] = [];
        }
    }

    private function ensureY2Padding(): void
    {
        $this->ensureY2();

        if (!isset($this->data['y2']['padding'])) {
            $this->data['y2']['padding'] = [];
        }
    }
}
