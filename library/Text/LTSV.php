<?php
class Text_LTSV
{
    public static function generate($array)
    {
        $buf = array();
        for ($i = 0, $l = count($array); $i < $l; $i++) {
            $buf[] = self::generateLine($array[$i]);
        }
        return implode("\n", $buf);
    }

    public static function generateLine($assoc)
    {
        $kvs = array();
        foreach ($assoc as $k => $v) {
            $kvs[] = "${k}:${v}";
        }
        return implode("\t", $kvs);
    }

    public static function parse($data, $options = array())
    {
        $array = array();
        $lines = explode("\n", $data);
        foreach ($lines as $line) {
            $array[] = self::parseLine($line, $options);
        }
        return $array;
    }

    public static function parseLine($line, $options = array())
    {
        $hasWants = array_key_exists('wants', $options);
        if ($hasWants) {
            $wants = $options['wants'];
        }

        $hasIgnores = array_key_exists('ignores', $options);
        if ($hasIgnores) {
            $ignores = $options['ignores'];
        }

        $assoc = array();
        $kvs = explode("\t", array_shift(explode("\n", $line, 2)));
        foreach ($kvs as $kv) {
            $splitted = explode(':', $kv, 2);
            if (count($splitted) < 2) {
                continue;
            }
            list($k, $v) = $splitted;

            if ($hasWants && !in_array($k, $wants)) {
                continue;
            }
            if ($hasIgnores && in_array($k, $ignores)) {
                continue;
            }
            $assoc[$k] = $v;
        }
        return $assoc;
    }
}
