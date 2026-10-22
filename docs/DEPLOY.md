# Deploying Green Miles Travel

Recommended: Ubuntu LTS VPS with PHP-FPM 8.3+, required extensions, Composer, Node (for builds), Nginx, SSL, SQLite or MySQL, a managed email SMTP provider, Cloudflare.

1. Own and control the domain, hosting, DNS, Cloudflare, and email credentials in the client's own accounts.
2. Install packages, `composer install --no-dev --optimize-autoloader` and `npm ci && npm run build` (if package lock exists; use `npm install` otherwise) during deployment. Store built assets in `public/build/`.
3. Configure `.env` with `APP_ENV=production`, `APP_DEBUG=false`, canonical HTTPS `APP_URL`, strong `APP_KEY`, SMTP credentials, approved numbers, `ENQUIRY_TO_EMAIL`, Cloudflare `TURNSTILE_SITE_KEY` and `TURNSTILE_SECRET_KEY`.
4. Create the database and storage directories. For SQLite, store `database/database.sqlite` outside web-accessible folders; file and its directory must be writable by the PHP-FPM user. At higher concurrency switch to MySQL.
5. Run `php artisan migrate --force`, `php artisan storage:link`, `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`.
6. Web server document root must be the project's **`public/` directory only**, never the repository root. Deny hidden files and PHP execution under uploaded `storage/` files. Enable HTTPS redirection and secure cookies.
7. Run Laravel's scheduler via cron: `* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1` to purge old closed enquiries.
8. Configure off-site encrypted backups of SQLite/MySQL and `storage/app/public` (nightly DB, weekly files). **Test restoration** monthly.
9. Add appropriate Cloudflare rate limits, verify TLS and security headers, verify login MFA, run contact form end-to-end from a separate network and check delivered SMTP messages.
10. Verify text, event dates, actual packages, real photography permissions, image alt text, location, full business contact details, prices, legal policies and sitemap with real business ownership.

### Nginx example

```
server {
    listen 80;
    server_name travel.example.com;
    root /var/www/green-miles-travel/public;
    index index.php;
    location / { try_files $uri $uri/ /index.php?$query_string; }
    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock; # adjust PHP socket on your host
    }
    location ~ /\. { deny all; }
    location ~* ^/storage/.*\.php$ { deny all; }
}
```

Configure TLS, HSTS (only after HTTPS is proven), a tested CSP, image cache headers, `X-Content-Type-Options`, `Referrer-Policy` and `Permissions-Policy` at your edge/reverse proxy. Test the live site's exact headers; this example is not a hardened drop-in.

### Production decision points

- The system currently stores lightweight relational data, not payment credentials. For visitor payments, implement secure gateway + refund/GST policies in a new phase.
- If `QUEUE_CONNECTION=sync`, transactional email is synchronous. For traffic spikes use a background queue and worker.
- The screenshot-derived starter photos are temporary. Replace them with full-resolution owned assets.
- Complete cross-browser, accessibility and formal penetration/security checks before putting customer data in production.
