birenjung/log-watcher

Debug without breaking flow.

birenjung/log-watcher is a lightweight, terminal-first log watcher for Laravel developers who prefer clarity over clutter.

It lets you watch Laravel logs in real time — directly from the terminal — with awareness of Laravel’s logging channels, without dashboards, UIs, or unnecessary noise.

Why this exists

During active development, debugging often becomes repetitive:

Trigger a request

Switch to the browser

Hit a dd() or dump output

Go back to the editor

Repeat

While dd() is extremely useful, it forces context switching — especially during intense debugging where focus matters.

This package exists to make debugging less disruptive.

Instead of stopping execution and switching screens, you can:

log what matters

observe behavior in real time

stay inside the terminal

avoid unrelated framework or system noise

The goal is not to replace debugging tools, but to make everyday debugging calmer, simpler, and more focused.

Philosophy

This package follows a few simple principles:

Terminal-first
No UI, no dashboard, no browser tab.

Channel-centric
Laravel logs are channels, not just files.
Channels are treated as first-class citizens.

Minimal by design
Do one thing well. No feature creep.

Predictable behavior
No hidden side effects. No log mutation. No database usage.

Simplicity is the style.
Honesty is the policy.

What this package is

A real-time log watcher for Laravel

A developer-only tool

A terminal-native alternative to tail -f

A channel-aware wrapper around Laravel’s logging system

What this package is NOT

❌ Not a replacement for Laravel Pail

❌ Not a UI or TUI log viewer

❌ Not a debugging dashboard (use Telescope for that)

❌ Not production tooling

❌ Not opinionated about your workflow

This package intentionally stays small.

dd() vs log-watcher
dd()	log-watcher
Stops execution	Keeps application running
Requires browser access	Works entirely in terminal
Forces screen switching	No context switching
One-time snapshot	Real-time observation
Can block debugging flow	Designed to preserve flow

They serve different purposes — and work best together.

Requirements

PHP 8.2+

Laravel 12.x

Installation
composer require birenjung/log-watcher --dev


This is a dev-only package, intended for local and development environments.

Quick Start (30 seconds)
php artisan log:watch


That’s it.

Watches your default Laravel log channel

Runs in clean mode by default

Prints logs as they happen

If nothing appears, it simply means no new logs were written yet.

Usage
Watch the default log channel
php artisan log:watch


This watches Laravel’s default logging channel
(logging.default in config/logging.php).

If the default channel is stack, it is automatically resolved to the first file-based channel.

Watch a specific channel
php artisan log:watch daily


Supported channel types:

single

daily

stack (auto-resolved)

Any custom file-based channel

Non-file channels (Slack, Syslog, etc.) are intentionally unsupported.

Clean Mode (default)

By default, log-watcher runs in clean mode.

php artisan log:watch


Clean mode:

Hides framework and vendor stack traces

Hides internal exception noise

Shows only meaningful application logs

Keeps the terminal readable during debugging

You will see:

Clean mode enabled. Use --full to show full stack traces.


This is intentional.

Full Mode

To see everything — including raw stack traces and framework internals:

php artisan log:watch --full


Use this when you need deep visibility.

Important note

log-watcher shows real application logs.

If your app throws an exception (for example, a database connection error), it will appear here.
Nothing is hidden, transformed, or suppressed.

If nothing appears, it simply means no new logs were written yet.

Colored Output

Log levels are detected and colored automatically:

Level	Color
DEBUG	Cyan
INFO	Blue
WARNING	Yellow
ERROR / CRITICAL	Red

This makes scanning logs easier without filters or UI.

Laravel Version Support

Laravel 12.x

PHP 8.2+

Designed for Laravel’s modern bootstrap system.

Development Status

v0.1.0 — Initial stable release

v0.1.3 — Clean mode and full mode support

API intentionally small

Backwards compatibility prioritized

Future versions may add optional features, but the core philosophy will remain unchanged.

License

MIT

Final note

This package is not trying to be everything.

If you want a dashboard, use Telescope.
If you want UI-driven tooling, use Pail.

If you want a simple, honest, terminal-native way to observe logs without breaking flow — this exists for you.

