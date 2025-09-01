# Security Policy

## Supported Versions

We support security updates for the following versions of this SMM backend server:

| Version | Supported          |
| ------- | ------------------ |
| Latest  | :white_check_mark: |
| < Latest| :x:                |

## Security Features

This application implements several security measures:

- **Authentication**: Laravel Sanctum for API token management
- **CORS Protection**: Configurable origins and headers
- **Rate Limiting**: Applied to sensitive endpoints (login, registration, orders)
- **Security Headers**: CSP, HSTS, X-Frame-Options, and more
- **Input Validation**: Strict validation on all API endpoints
- **Secure Defaults**: Production-ready configuration examples

## Security Configuration

### Environment Variables

Ensure the following security-related environment variables are properly configured:

```bash
# Set to production
APP_ENV=production
APP_DEBUG=false

# Use HTTPS in production
APP_URL=https://yourdomain.com

# Configure CORS properly
CORS_ALLOWED_ORIGINS="https://yourdomain.com,https://www.yourdomain.com"

# Set token expiration (in minutes)
SANCTUM_TOKEN_EXPIRATION=1440

# Use strong database passwords
DB_PASSWORD=strong_password_here

# Keep API keys secure
SOCGRESS_API_KEY=your_secure_key
JUSTANOTHERPANEL_API_KEY=your_secure_key
```

### Docker Security

- Container runs as non-root user `appuser`
- Minimal attack surface with only required packages
- Regular security updates recommended

### API Security

- All sensitive endpoints are rate-limited
- API keys are validated using timing-safe comparison
- Input validation on all requests
- Automatic token revocation on login

## Reporting a Vulnerability

**Please do not report security vulnerabilities through public GitHub issues.**

To report a security vulnerability:

1. **Email**: Send details to [security@yourdomain.com] (replace with actual email)
2. **Response Time**: We aim to respond within 48 hours
3. **Investigation**: Security issues are prioritized and investigated immediately
4. **Disclosure**: We follow responsible disclosure practices

### What to Include

When reporting a vulnerability, please include:

- Description of the vulnerability
- Steps to reproduce the issue
- Potential impact assessment
- Any suggested fixes (if available)

### Response Process

1. **Acknowledgment**: We'll confirm receipt of your report
2. **Investigation**: Our team will investigate and validate the issue
3. **Fix Development**: We'll develop and test a fix
4. **Release**: Security fixes are released as soon as possible
5. **Credit**: We'll credit reporters (if desired) in our security advisories

## Security Best Practices

### For Deployment

- Always use HTTPS in production
- Keep all dependencies updated
- Use strong, unique passwords for all accounts
- Implement proper logging and monitoring
- Regular security audits recommended
- Use environment-specific configuration files

### For Development

- Never commit sensitive information to version control
- Use `.env` files for configuration (not tracked in git)
- Keep development and production environments separate
- Regularly update dependencies
- Follow Laravel security best practices

## Contact

For security concerns that don't constitute vulnerabilities, please contact us through:
- GitHub Issues (for non-sensitive matters)
- Email: [contact@yourdomain.com] (replace with actual email)
