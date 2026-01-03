<?php

namespace Birenjung\LogWatcher\Commands;

use Illuminate\Console\Command;
use Birenjung\LogWatcher\Support\LogPathResolver;
use Birenjung\LogWatcher\Support\Colorizer;

class WatchLogCommand extends Command
{
    protected $signature = 'log:watch 
        {channel? : Log channel to watch} 
        {--verbose : Show full stack traces and framework noise}';

    protected $description = 'Watch a Laravel log channel with colored output';

    public function handle(): int
    {
        $channel = $this->argument('channel')
            ?? config('log-watcher.default_channel', config('logging.default'));

        $path = LogPathResolver::resolve($channel);

        $this->info("Watching log channel: {$channel}");
        $this->line(str_repeat('-', 60));

        if (! $this->option('verbose')) {
            $this->comment('Clean mode enabled. Use --verbose to show full stack traces.');
        }

        $this->watch($path);

        return self::SUCCESS;
    }

    /**
     * Unified watcher for all OS families.
     */
    protected function watch(string $path): void
    {
        $lines = (int) config('log-watcher.tail_lines', 50);

        $command = match (PHP_OS_FAMILY) {
            'Windows' => "powershell -Command \"Get-Content -Path '{$path}' -Wait -Tail {$lines}\"",
            default   => "tail -n {$lines} -f {$path}",
        };

        $handle = popen($command, 'r');

        if (! $handle) {
            $this->error('Unable to open log file for reading.');
            return;
        }

        while (! feof($handle)) {
            $line = fgets($handle);

            if ($line === false) {
                continue;
            }

            if (! $this->option('verbose') && $this->shouldSkipLine($line)) {
                continue;
            }

            $this->output->write(
                Colorizer::colorize($line)
            );
        }

        pclose($handle);
    }

    /**
     * Determines whether a line should be hidden in clean mode.
     */
    protected function shouldSkipLine(string $line): bool
    {
        // Skip stack trace lines: "#0 /path/..."
        if (preg_match('/^\s*#\d+/', $line)) {
            return true;
        }

        // Skip vendor/framework noise
        if (str_contains($line, DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR)) {
            return true;
        }

        // Skip empty or whitespace-only lines
        if (trim($line) === '') {
            return true;
        }

        return false;
    }
}
