<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP\Charts;

final class Area implements \JsonSerializable
{
    private array $data = [];

    /**
     * Set if min or max value will be 0 on area chart
     * @link http://c3js.org/reference.html#area-zerobased
     */
    public function setZerobased(bool $zerobased = true): void
    {
        $this->data['zerobased'] = $zerobased;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }
}
