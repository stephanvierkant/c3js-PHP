<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

final class Callback implements \JsonSerializable
{
    private string $script;

    /**
     * @param string $script
     */
    public function __construct($script)
    {
        $this->script = $script;
    }

    public function getScript(): string
    {
        return $this->script;
    }

    public function setScript(string $script): void
    {
        $this->script = $script;
    }

    public function JsonSerialize(): string
    {
        return $this->script;
    }
}
