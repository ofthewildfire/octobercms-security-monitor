# Security Monitor for OctoberCMS

Adds instant alerts for backend password reset requests.

## Features

- Tracks IP and browser info on backend password reset requests
- Emails the account owner with details

## Install

Via Composer:
```
composer require ofthewildfire/securitymonitor
```

Or manually:
1. Copy to `plugins/ofthewildfire/securitymonitor/`
2. Run: `php artisan october:migrate`

No extra setup needed.

## Requirements

- OctoberCMS 3.x
- PHP 8.0+

## License

MIT