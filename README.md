Absolutely — below is a **complete, polished, v0.1.0–ready README.md**, written to be **copied verbatim into VS Code**.

No placeholders, no explanations, no commentary — just the README content.

---

````md
# birenjung/log-watcher

> **A lightweight, terminal-first log watcher for Laravel developers who think in channels, not dashboards.**

`birenjung/log-watcher` is a small, focused developer tool that lets you watch Laravel logs in real time — directly from the terminal — with full awareness of Laravel’s logging channels.

It is designed for developers who prefer **clarity, predictability, and control** over UI-heavy tooling.

---

## Philosophy

This package follows a few simple principles:

- **Terminal-first**  
  No UI, no dashboard, no browser tab.

- **Channel-centric**  
  Laravel logs are channels, not just files.  
  This package treats channels as first-class citizens.

- **Minimal & composable**  
  Do one thing well. Let developers compose workflows with standard tools.

- **Predictable behavior**  
  No hidden side effects. No log mutation. No database usage.

If you like small, sharp tools that fit naturally into your development workflow, this package is for you.

---

## What this package is

- A **real-time log watcher** for Laravel
- A **developer-only** tool
- A **terminal-based** alternative to manual `tail -f`
- A **channel-aware** wrapper around Laravel’s logging system

---

## What this package is NOT

- ❌ Not a replacement for **Laravel Pail**
- ❌ Not a UI or TUI log viewer
- ❌ Not a debugging dashboard (use Telescope for that)
- ❌ Not production tooling
- ❌ Not opinionated about your workflow

This package intentionally stays small.

---

## Requirements

- PHP **8.2+**
- Laravel **12.x**

---

## Installation

```bash
composer require birenjung/log-watcher --dev
````

This is a **dev-only package** and is automatically disabled outside the `local` environment.

---

## Usage

### Watch the default log channel

```bash
php artisan log:watch
```

If your default channel is `stack`, it will be automatically resolved to the first file-based channel.

---

### Watch a specific channel

```bash
php artisan log:watch daily
```

Supported channel types:

* `single`
* `daily`
* `stack` (auto-resolved)
* Any custom **file-based** channel

---

## Colored Output

Log levels are detected from Laravel’s log format and colored accordingly:

| Level            | Color  |
| ---------------- | ------ |
| DEBUG            | Cyan   |
| INFO             | Blue   |
| WARNING          | Yellow |
| ERROR / CRITICAL | Red    |

This makes it easy to scan logs without filtering or UI.

---

## Common Questions

### Why do I see database or application errors?

Because this tool shows **real application logs**.

If your application throws an exception (for example, a database connection error), it will appear here.
This package does **not** suppress, transform, or hide logs.

---

### Why not just use Laravel Pail?

Laravel Pail is a great tool, but it is **opinionated and UI-driven**.

`log-watcher` is:

* terminal-native
* channel-focused
* minimal by design
* easy to integrate into custom workflows (tmux, SSH, CI, pipes)

They complement each other rather than compete.

---

### Why not just use `tail -f`?

Because `tail -f`:

* does not understand Laravel channels
* does not handle `stack`
* is not portable across environments
* does not provide semantic log-level coloring

`log-watcher` adds Laravel awareness without adding complexity.

---

## Laravel Version Support

This package is designed specifically for Laravel’s modern bootstrap system.

* Laravel **12.x**
* PHP **8.2+**

---

## Development Status

* **v0.1.0** — Initial stable release
* API intentionally small
* Backwards compatibility prioritized

Future versions may add optional features such as filtering or composition helpers, but the core philosophy will remain unchanged.

---

## License

MIT

---

## Final Note

This package is intentionally **not trying to be everything**.

If you want a powerful dashboard, use Telescope.
If you want a simple, predictable, terminal-native log watcher — this exists for you.

```

---

If you want next steps, I can help you with:

- a **short comparison section vs Pail** (1 table)
- a **CHANGELOG.md** for v0.1.0
- a **v0.2 roadmap** that preserves brand purity
- a **Packagist description** (short + long)

Just tell me what you want to polish next.
```
