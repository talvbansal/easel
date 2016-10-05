<?php

class ParsedownerTest extends PHPUnit_Framework_TestCase
{
    protected $parsedowner;

    public function setup()
    {
        $this->parsedowner = new Easel\Services\Parsedowner();
    }

    /**
     * @dataProvider conversionsProvider
     */
    public function testConversions($value, $expected)
    {
        $this->assertEquals($expected, $this->parsedowner->toHTML($value));
    }

    public function conversionsProvider()
    {
        return [
            ['text', '<p>text</p>'],
            ["Header 1\n=======", '<h1>Header 1</h1>'],
            ['# Header 1', '<h1>Header 1</h1>'],
            ['## Header 2', '<h2>Header 2</h2>'],
            ['### Header 3', '<h3>Header 3</h3>'],
            ['#### Header 4', '<h4>Header 4</h4>'],
            ['##### Header 5', '<h5>Header 5</h5>'],
            ['###### Header 6', '<h6>Header 6</h6>'],
            ['`hello_world`', '<p><code>hello_world</code></p>'],
            ['``` <?php $var = "Php Code Blocks"; echo $var; ?> ```', '<p><code>&lt;?php $var = "Php Code Blocks"; echo $var; ?&gt;</code></p>'],
            ['*italics text*', '<p><em>italics text</em></p>'],
            ['_italics text_', '<p><em>italics text</em></p>'],
            ['**bold text**', '<p><strong>bold text</strong></p>'],
            ['__bold text__', '<p><strong>bold text</strong></p>'],
            ['---', '<hr />'],
            ['***', '<hr />'],
            ['>note', "<blockquote>\n<p>note</p>\n</blockquote>"],
            ['[Easel](http://github.com/talvbansal/easel "Easel")', '<p><a href="http://github.com/talvbansal/easel" title="Easel">Easel</a></p>'],
            ['Intra-word *emp*hasis', '<p>Intra-word <em>emp</em>hasis</p>'],
            ['~~Strikethrough~~', '<p><del>Strikethrough</del></p>'],
            ['![Easel Logo](http://github.com/talvbansal/easel/logo.gif)', '<p><img src="http://github.com/talvbansal/easel/logo.gif" alt="Easel Logo" /></p>'],
            ['- List Item', "<ul>\n<li>List Item</li>\n</ul>"],
            ['1. List Item', "<ol>\n<li>List Item</li>\n</ol>"],
            ['[Easel](http://github.com/talvbansal/easel)', '<p><a href="http://github.com/talvbansal/easel">Easel</a></p>'],
        ];
    }
}
