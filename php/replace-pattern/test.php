<?php

include __DIR__ . '/snippet.php';

class RequestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerRoute
     */
    public function testRoute($route, $expectedPattern)
    {
        $regexp = replacePattern($route, ['**', '*'], ['.*', '[^/]*']);
        $this->assertEquals($expectedPattern, $regexp);
    }

    public function providerRoute()
    {
        return array(
            array('/route/*', '/route/[^/]*'),
            array('/route/\*', '/route/*'),
            array('/route/\\\\\*', '/route/\*'),
            array('/route/**/*.php', '/route/.*/[^/]*.php'),
        );
    }
}