 Text_LTSV
===

[LTSV](http://ltsv.org/) parser and generator for PHP.


 Installation
---

```
$ TODO
```


 Usage
---

```php
require_once 'Text/LTSV.php';

$assoc = Text_LTSV::parseLine("hoge:foo\tfuga:bar\tpiyo:baz");
echo $assoc['hoge']; //=> foo
echo $assoc['fuga']; //=> bar
echo $assoc['piyo']; //=> baz

$array = Text_LTSV::parse("hoge:foo\tfuga:bar\npiyo:baz");
echo count($array); //=> 2
echo $array[1]['piyo']; //=> baz

echo Text_LTSV::generateLine(array('hoge' => 'foo', 'fuga' => 'bar', 'piyo' => 'baz'));
//=> hoge:foo\tfuga:bar\tpiyo:baz

echo Text_LTSV::generate(array(
  array('hoge' => 'foo', 'fuga' => 'bar'),
  array('piyo' => 'baz'),
));
//=> hoge:foo\tfuga:bar\npiyo:baz
```


 License
---
Copyright (c) 2013 Takamasa Aoi. See LICENSE in this directory.
