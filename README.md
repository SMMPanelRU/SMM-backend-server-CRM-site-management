# SMM Backend Server CRM Site Management

## Overview
This repository hosts a backend server and CRM site management system for SMM projects, built with PHP on the Laravel framework.

## Directory Structure
- `.github/`: Contains GitHub workflow configurations like `dependabot.yml`.
- `app/`: Contains core application logic.
- `bootstrap/`: Initial setup files.
- `config/`: Configuration files.
- `database/`: Database schemas and migrations.
- `docker/`: Docker files for containerization.
- `http_requests/`: Handles HTTP requests.
- `lang/en`: English language files.
- `public/`: Publicly accessible files.
- `resources/`: Views and other resources.
- `routes/`: Application routing.
- `storage/`: Storage files.
- `tests/`: Test cases.
- `.env.example`: Example environment configuration file.
- `.gitattributes`: Git attributes file.
- `.gitignore`: Specifies intentionally untracked files to ignore.
- `SECURITY.md`: Security policies.
- `artisan`: Laravel's command-line tool.
- `composer.json` and `composer.lock`: Dependency management files.
- `docker-compose.yml`: Docker compose file.
- `package-lock.json` and `package.json`: Node.js dependency management files.
- `phpunit.xml`: PHPUnit configuration file.
- `postcss.config.js`: PostCSS configuration file.
- `update.sh`: Project update script.
- `vite.config.js`: Vite configuration file.

## Setup
1. Clone the repository to your local machine.
2. Copy `.env.example` to `.env` and update the environment variables as necessary.
3. Run `update.sh` script to set up the necessary dependencies and migrations.
4. Use `docker-compose up` to start the services.
5. Access the application via your web browser.

## Testing
Run tests using the command: `php artisan test`

## Contributing
See `CONTRIBUTING.md` for contribution guidelines.
