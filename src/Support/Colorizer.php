<?php

namespace Birenjung\LogWatcher\Support;

class Colorizer
{
    public static function colorize(string $line): string
    {
        $level = self::extractLevel($line);

        return match ($level) {
            'ERROR', 'CRITICAL', 'ALERT', 'EMERGENCY' => "\033[31m{$line}\033[0m",
            'WARNING' => "\033[33m{$line}\033[0m",
            'INFO', 'NOTICE' => "\033[34m{$line}\033[0m",
            'DEBUG' => "\033[36m{$line}\033[0m",
            default => $line,
        };
    }

    protected static function extractLevel(string $line): ?string
    {
        if (preg_match('/\]\s+\w+\.(\w+):/', $line, $matches)) {
            return strtoupper($matches[1]);
        }

        return null;
    }
}
