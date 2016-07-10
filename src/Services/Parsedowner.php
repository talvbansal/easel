<?php
namespace Easel\Services;

class Parsedowner
{
    /**
     * Transform raw text to markdown.
     *
     * @return string $html
     */
    public function toHTML($text)
    {
        return \Parsedown::instance()->text($text);
    }
}
