<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

final class Tooltip implements \JsonSerializable
{
    private array $data = [];

    /**
     * Show or hide tooltip
     * @link http://c3js.org/reference.html#tooltip-show
     */
    public function setVisibility(bool $visibility = true): void
    {
        $this->data['show'] = $visibility;
    }

    /**
     * Set if tooltip is grouped or not for the data points
     * @link http://c3js.org/reference.html#tooltip-grouped
     */
    public function setGrouped(bool $grouped = true): void
    {
        $this->data['grouped'] = $grouped;
    }

    /**
     * Set format for the title of tooltip
     * @link http://c3js.org/reference.html#tooltip-format-title
     */
    public function setFormatTitle(string $title): void
    {
        $this->ensureFormat();
        $this->data['format']['title'] = $title;
    }

    /**
     * Set format for the name of each data in tooltip
     * @link http://c3js.org/reference.html#tooltip-format-name
     */
    public function setFormatName(string $name): void
    {
        $this->ensureFormat();
        $this->data['format']['name'] = $name;
    }

    /**
     * Set format for the value of each data in tooltip
     * @link http://c3js.org/reference.html#tooltip-format-value
     */
    public function setFormatValue(string $value): void
    {
        $this->ensureFormat();
        $this->data['format']['value'] = $value;
    }

    /**
     * Set custom position for the tooltip
     * @link http://c3js.org/reference.html#tooltip-position
     */
    public function setPosition(string $position): void
    {
        $this->data['position'] = $position;
    }

    /**
     * Set custom HTML for the tooltip
     * @link http://c3js.org/reference.html#tooltip-contents
     */
    public function setContents(string $contents): void
    {
        $this->data['contents'] = $contents;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }

    private function ensureFormat(): void
    {
        if (!isset($this->data['format'])) {
            $this->data['format'] = [];
        }
    }
}
