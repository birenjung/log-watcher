<?php

namespace Birenjung\LogWatcher\Commands;

use Illuminate\Console\Command;
use Birenjung\LogWatcher\Support\LogPathResolver;
use Birenjung\LogWatcher\Support\Colorizer;

class WatchLogCommand extends Command
{
    protected $signature = 'log:watch {channel?}';
    protected $description = 'Watch a Laravel log channel with colored output';

    public function handle(): int
    {
        $channel = $this->argument('channel')
            ?? config('log-watcher.default_channel');

        $path = LogPathResolver::resolve($channel);

        $this->info("Watching log channel: {$channel}");
        $this->line(str_repeat('-', 60));

        if (PHP_OS_FAMILY === 'Windows') {
            $this->watchWindows($path);
        } else {
            $this->watchUnix($path);
        }

        return self::SUCCESS;
    }

    protected function watchUnix(string $path): void
    {
        $lines = config('log-watcher.tail_lines', 50);

        $handle = popen("tail -n {$lines} -f {$path}", 'r');

        while (! feof($handle)) {
            echo Colorizer::colorize(fgets($handle));
        }
    }

    protected function watchWindows(string $path): void
    {
        $command = "Get-Content -Path \"$path\" -Wait -Tail 50";
        $process = popen("powershell -Command \"$command\"", 'r');

        while (! feof($process)) {
            echo Colorizer::colorize(fgets($process));
        }
    }
}
