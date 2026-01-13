<?php

namespace Birenjung\LogWatcher\Support;

use Illuminate\Support\Facades\Config;
use RuntimeException;

class LogPathResolver
{
    public static function resolve(string $channel): string
    {
        $channels = Config::get('logging.channels');

        if (! isset($channels[$channel])) {
            throw new RuntimeException("Log channel [$channel] not found.");
        }

        $config = $channels[$channel];

        // ✅ Handle stack channels  - ok
        if (($config['driver'] ?? null) === 'stack') {
            foreach ($config['channels'] as $nestedChannel) {
                if (! isset($channels[$nestedChannel])) {
                    continue;
                }

                $nestedConfig = $channels[$nestedChannel];

                if (isset($nestedConfig['path'])) {
                    return $nestedConfig['path'];
                }
            }

            throw new RuntimeException(
                "Stack channel [$channel] does not contain any file-based channels."
            );
        }

        // ✅ Normal file-based channels
        if (! isset($config['path'])) {
            throw new RuntimeException("Channel [$channel] is not file-based.");
        }

        return $config['path'];
    }
}
