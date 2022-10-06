<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

final class Chart
{
    /**
     * @var \Astroanu\C3jsPHP\Data[]|\Astroanu\C3jsPHP\Axis[]|\Astroanu\C3jsPHP\Grid[]|\Astroanu\C3jsPHP\Legend[]|\Astroanu\C3jsPHP\Tooltip[]|\Astroanu\C3jsPHP\Subchart[]|\Astroanu\C3jsPHP\Zoom[]|\Astroanu\C3jsPHP\Point[]|\Astroanu\C3jsPHP\Charts\Line[]|\Astroanu\C3jsPHP\Charts\Area[]|\Astroanu\C3jsPHP\Charts\Bar[]|\Astroanu\C3jsPHP\Charts\Pie[]|\Astroanu\C3jsPHP\Charts\Donut[]|\Astroanu\C3jsPHP\Charts\Gauge[]
     */
    private array $options = [];
    /**
     * @var mixed[][]|null
     */
    private ?array $data = null;
    private ?\Astroanu\C3jsPHP\Callback $oninit = null;
    private ?\Astroanu\C3jsPHP\Callback $onrendered = null;
    private ?\Astroanu\C3jsPHP\Callback $onmouseover = null;
    private ?\Astroanu\C3jsPHP\Callback $onmouseout = null;
    private ?\Astroanu\C3jsPHP\Callback $onresize = null;
    private ?\Astroanu\C3jsPHP\Callback $onresized = null;

    /**
     * The CSS selector or the element which the chart will be set to
     *
     * @link http://c3js.org/reference.html#bindto
     */
    public function bindTo(string $selector): self
    {
        $this->options['bindto'] = $selector;
        return $this;
    }

    /**
     * The desired width of the chart element
     *
     * @link http://c3js.org/reference.html#size-width
     */
    public function setSizeWidth(int $width): self
    {
        $this->ensureSize();
        $this->options['size']['width'] = $width;
        return $this;
    }

    /**
     * The desired height of the chart element
     *
     * @link http://c3js.org/reference.html#size-height
     */
    public function setSizeHeight(int $height): self
    {
        if (!isset($this->data['size'])) {
            $this->data['size'] = [];
        }

        $this->options['size']['height'] = $height;
        return $this;
    }

    /**
     * Set the padding on the top of the chart
     *
     * @link http://c3js.org/reference.html#padding-top
     */
    public function setPaddingTop(int $padding): self
    {
        $this->ensurePadding();
        $this->options['padding']['top'] = $padding;
        return $this;
    }

    /**
     * Set the padding on the right of the chart
     *
     * @link http://c3js.org/reference.html#padding-right
     */
    public function setPaddingRight(int $padding): self
    {
        $this->ensurePadding();
        $this->options['padding']['right'] = $padding;
        return $this;
    }

    /**
     * Set the padding on the bottom of the chart
     *
     * @link http://c3js.org/reference.html#padding-bottom
     */
    public function setPaddingBottom(int $padding): self
    {
        $this->ensurePadding();
        $this->options['padding']['bottom'] = $padding;
        return $this;
    }

    /**
     * Set the padding on the left of the chart
     *
     * @link http://c3js.org/reference.html#padding-left
     */
    public function setPaddingLeft(int $padding): self
    {
        $this->ensurePadding();
        $this->options['padding']['left'] = $padding;
        return $this;
    }

    /**
     * Set custom color pattern
     * @param string[] $pattern CSS hex colors
     *
     * @link http://c3js.org/reference.html#color-pattern
     */
    public function setColorPattern(array $pattern): self
    {
        if (!isset($this->data['color'])) {
            $this->data['color'] = [];
        }

        $this->options['color']['pattern'] = $pattern;
        return $this;
    }

    /**
     * Indicate if the chart should have interactions
     *
     * @link http://c3js.org/reference.html#interaction-enabled
     */
    public function setInteractionEnabled(bool $interaction = true): self
    {
        $this->options['interaction']['enabled'] = $interaction;
        return $this;
    }

    /**
     * Set duration of transition for chart animation
     * @param int $duration Duration of transition in milliseconds
     *
     * @link http://c3js.org/reference.html#transition-duration
     */
    public function setTransitionDuration(int $duration = 350): self
    {
        $this->options['transition']['duration'] = $duration;
        return $this;
    }

    /**
     * Set a callback to execute when the chart is initialized
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#oninit
     */
    public function setOnInit(Callback $callback): self
    {
        $this->oninit = $callback;
        return $this;
    }

    /**
     * Set a callback which is executed when the chart is rendered
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#onrendered
     */
    public function setOnRendered(Callback $callback): self
    {
        $this->onrendered = $callback;
        return $this;
    }

    /**
     * Set a callback to execute when mouse enters the chart
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#onmouseover
     */
    public function setOnMouseOver(Callback $callback): self
    {
        $this->onmouseover = $callback;
        return $this;
    }

    /**
     * Set a callback to execute when mouse leaves the chart
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#onmouseout
     */
    public function setOnMouseOut(Callback $callback): self
    {
        $this->onmouseout = $callback;
        return $this;
    }

    /**
     * Set a callback to execute when user resizes the screen
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#onresize
     */
    public function onResize(Callback $callback): self
    {
        $this->onresize = $callback;
        return $this;
    }

    /**
     * Set a callback to execute when screen resize finished
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#onresized
     */
    public function onResized(Callback $callback): self
    {
        $this->onresized = $callback;
        return $this;
    }

    /**
     * Attach a Data object to the Chart
     * @param Data $data
     */
    public function setData(Data $data): self
    {
        $this->options['data'] = $data;
        return $this;
    }

    /**
     * Attach a Axis object to the Chart
     * @param Axis $axis
     */
    public function setAxis(Axis $axis): self
    {
        $this->options['axis'] = $axis;
        return $this;
    }

    /**
     * Attach a Grid object to the Chart
     * @param Grid $grid
     */
    public function setGrid(Grid $grid): self
    {
        $this->options['grid'] = $grid;
        return $this;
    }

    /**
     * Attach a Region object to the Chart
     * @param Region $region
     *
     * @see setRegions()
     */
    public function addRegion(Region $region): self
    {
        $this->ensureRegions();
        $this->options['regions'][] = $region;
        return $this;
    }

    /**
     * Set Chart Regions
     * @param Region[] $regions
     *
     * @see addRegion()
     */
    public function setRegions(array $regions): self {
        $this->ensureRegions();
        $this->options['regions'] = $regions;
        return $this;
    }

    /**
     * Attach a Legend object to the Chart
     * @param Legend $legend
     */
    public function setLegend(Legend $legend): self
    {
        $this->options['legend'] = $legend;
        return $this;
    }

    /**
     * Attach a Tooltip object to the Chart
     * @param Tooltip $tooltip
     */
    public function setTooltip(Tooltip $tooltip): self
    {
        $this->options['tooltip'] = $tooltip;
        return $this;
    }

    /**
     * Attach a Subchart object to the Chart
     * @param Subchart $subchart
     */
    public function setSubChart(Subchart $subchart): self
    {
        $this->options['subchart'] = $subchart;
        return $this;
    }

    /**
     * Attach a Zoom object to the Chart
     * @param Zoom $zoom
     */
    public function setZoom(Zoom $zoom): self
    {
        $this->options['zoom'] = $zoom;
        return $this;
    }

    /**
     * Attach a Point object to the Chart
     * @param Point $point
     */
    public function setPoint(Point $point): self
    {
        $this->options['point'] = $point;
        return $this;
    }

    /**
     * Attach a Line object to the Chart
     * @param Charts\Line $line
     */
    public function setLine(Charts\Line $line): self
    {
        $this->options['line'] = $line;
        return $this;
    }

    /**
     * Attach a Area object to the Chart
     * @param Charts\Area $area
     */
    public function setArea(Charts\Area $area): self
    {
        $this->options['area'] = $area;
        return $this;
    }

    /**
     * Attach a Bar object to the Chart
     * @param Charts\Bar $bar
     */
    public function setBar(Charts\Bar $bar): self
    {
        $this->options['bar'] = $bar;
        return $this;
    }

    /**
     * Attach a Pie object to the Chart
     * @param Charts\Pie $pie
     */
    public function setPie(Charts\Pie $pie): self
    {
        $this->options['pie'] = $pie;
        return $this;
    }

    /**
     * Attach a Donut object to the Chart
     * @param Charts\Donut $donut
     */
    public function setDonut(Charts\Donut $donut): self
    {
        $this->options['donut'] = $donut;
        return $this;
    }

    /**
     * Attach a Gauge object to the Chart
     * @param Charts\Gauge $gauge
     */
    public function setGauge(Charts\Gauge $gauge): self
    {
        $this->options['gauge'] = $gauge;
        return $this;
    }

    /**
     * Get the rendered JavaScript
     * @param string $var (optional) Returning javascript variable name
     * @param bool $pretty (optional) Render prettyfied javascript
     */
    public function getRendering(string $var = 'chart', bool $pretty = false): string
    {
        $result = 'var ' . $var . ' = c3.generate(';

        if ($pretty) {
            $body = json_encode($this->options, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
        } else {
            $body = json_encode($this->options, JSON_NUMERIC_CHECK);
        }

        $body = str_replace('"function', 'function', $body);
        $body = str_replace('}"', '}', $body);
        $body = str_replace('\/', '/', $body);
        $body = str_replace('\"', '"', $body);

        $result .= $body;

        return $result . ');';
    }

    /**
     * Renders the JavaScript directly onto the HTML document
     * @param string $var (optional) Returning javascript variable name
     * @param bool $pretty (optional) Render prettyfied javascript
     */
    public function render(string $var = 'chart', bool $pretty = false): void
    {
        echo $this->getRendering($var, $pretty);
    }

    private function ensureSize(): void
    {
        if (!isset($this->data['size'])) {
            $this->data['size'] = [];
        }
    }

    private function ensurePadding(): void
    {
        if (!isset($this->data['padding'])) {
            $this->data['padding'] = [];
        }
    }

    private function ensureRegions(): void
    {
        if (!isset($this->data['regions'])) {
            $this->data['regions'] = [];
        }
    }
}
