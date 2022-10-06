<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP\Charts;

final class Line implements \JsonSerializable
{
    public const STEP_TYPE_STEP = 'step';
    public const STEP_TYPE_STEP_BEFORE = 'step-before';
    public const STEP_TYPE_STEP_AFTER = 'step-after';

    private array $data = [];

    /**
     * Set if null data point will be connected or not
     *
     * @link http://c3js.org/reference.html#line-connectNull
     */
    public function setConnectNull(bool $connect = false): void
    {
        $this->data['connectNull'] = $connect;
    }

    /**
     * Change step type for step chart
     *
     * @link http://c3js.org/reference.html#line-step_type
     */
    public function setStepType(string $type = self::STEP_TYPE_STEP): void
    {
        if (!isset($this->data['step'])) {
            $this->data['step'] = [];
        }

        $this->data['step']['type'] = $type;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }
}
