<?php

namespace Birenjung\LogWatcher\Support;

class Colorizer
{
    public static function colorize(string $line): string
    {
        return match (true) {
            str_contains($line, '.ERROR')   => "\033[31m{$line}\033[0m",
            str_contains($line, '.WARNING') => "\033[33m{$line}\033[0m",
            str_contains($line, '.INFO')    => "\033[32m{$line}\033[0m",
            str_contains($line, '.DEBUG')   => "\033[36m{$line}\033[0m",
            default => $line,
        };
    }
}
