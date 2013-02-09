<?php
require_once dirname(__FILE__) . '/../../library/Text/LTSV.php';

class Text_LTSVTest extends PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $ltsv = Text_LTSV::generate(array(
            array('hoge' => 'foo', 'fuga' => 'bar', 'piyo' => 'baz'),
            array('time' => '20:30:58'),
        ));
        $this->assertSame("hoge:foo\tfuga:bar\tpiyo:baz\ntime:20:30:58", $ltsv);
    }

    public function testGenerateLine()
    {
        $ltsv = Text_LTSV::generateLine(array('hoge' => 'foo', 'fuga' => 'bar', 'piyo' => 'baz'));
        $this->assertSame("hoge:foo\tfuga:bar\tpiyo:baz", $ltsv);
    }

    public function testParse()
    {
        $array = Text_LTSV::parse("hoge:foo\tfuga:bar\tpiyo:baz\ntime:20:30:58");
        $this->assertSame(array(
            array('hoge' => 'foo', 'fuga' => 'bar', 'piyo' => 'baz'),
            array('time' => '20:30:58'),
        ), $array);
    }

    public function testParseLine()
    {
        $assoc = Text_LTSV::parseLine("hoge:foo\tfuga:bar\tpiyo:baz\n");
        $this->assertSame(array('hoge' => 'foo', 'fuga' => 'bar', 'piyo' => 'baz'), $assoc);
    }

    public function testParseLineWithWants()
    {
        $assoc = Text_LTSV::parseLine("hoge:foo\tfuga:bar\tpiyo:baz\n", array('wants' => array('hoge', 'piyo')));
        $this->assertSame(array('hoge' => 'foo', 'piyo' => 'baz'), $assoc);
    }

    public function testParseLineWithIgnores()
    {
        $assoc = Text_LTSV::parseLine("hoge:foo\tfuga:bar\tpiyo:baz\n", array('ignores' => array('fuga')));
        $this->assertSame(array('hoge' => 'foo', 'piyo' => 'baz'), $assoc);
    }
}
