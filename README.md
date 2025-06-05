# Security Monitor Plugin for OctoberCMS

Monitor suspicious password reset attempts with IP tracking and instant email alerts.

## Features

- **IP Address Tracking**: Capture the IP address of password reset requests
- **Instant Email Alerts**: Notify users immediately when their account reset is requested
- **Security Logging**: Log all password reset attempts for audit trails
- **User Agent Detection**: Track browser/device information for better security analysis
- **Zero Configuration**: Works out of the box after installation

## How It Works

1. When someone requests a password reset for any backend user
2. The plugin captures their IP address and browser information
3. An email is sent to the account owner with security details
4. The event is logged for security auditing

## Why This Matters

- **Detect Unauthorized Access Attempts**: Know immediately if someone tries to reset your password
- **Track Attack Patterns**: Identify suspicious IP addresses and repeated attempts
- **Enhanced Security**: Turn potential security threats into actionable intelligence
- **Peace of Mind**: Stay informed about all authentication activities

## Installation

1. Download and extract to `plugins/ofthewildfire/securitymonitor/`
2. Run `php artisan october:up` to install
3. The plugin works automatically - no configuration needed!

## Compatibility

- OctoberCMS 3.x
- PHP 8.0+

## Support

For issues and feature requests, please visit our GitHub repository.

## License

This plugin is open-source software licensed under the MIT license.# octobercms-security-monitor
