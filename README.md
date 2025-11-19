# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

## Deployment to Railway

### Prerequisites
- Railway account (https://railway.app)
- Git installed
- GitHub repository with your code

### Important Notes for Railway Deployment
⚠️ **PHP Version:** This project is configured for **PHP 8.2** which is stable and well-supported in Railway.

### Recommended: Deploy with Dockerfile (Most Reliable)

Railway has better support for Docker deployments. The project includes a `Dockerfile` that uses Apache 2.4 with PHP 8.2.

### Steps to Deploy with GitHub + Railway

1. **Push your code to GitHub**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/yourusername/your-repo.git
   git push -u origin main
   ```

2. **Create a Railway project**
   - Go to https://railway.app and log in
   - Click "New Project" → "Deploy from GitHub repo"
   - Select your repository

3. **Railway will automatically detect Dockerfile**
   - If Railway doesn't auto-detect, click "Settings" → "Build" and select "Dockerfile"

4. **Add MySQL Database**
   - In Railway project, click "+ Add Service"
   - Select "MySQL"
   - Confirm and wait for deployment

5. **Configure Environment Variables**
   - In Railway, go to your project's "Variables" section
   - Add these environment variables:
     ```
     CI_ENVIRONMENT=production
     app.baseURL=https://<your-project-name>.up.railway.app/
     database.default.hostname=${{MySQL.MYSQL_HOST}}
     database.default.database=${{MySQL.MYSQL_DB}}
     database.default.username=${{MySQL.MYSQL_USER}}
     database.default.password=${{MySQL.MYSQL_PASSWORD}}
     database.default.port=${{MySQL.MYSQL_PORT}}
     ```

6. **Run Migrations (Optional)**
   - After first successful deployment:
   - Use Railway CLI or shell to run: `php spark migrate`

### Alternative: Manual Docker Deployment

If you prefer to test locally:
```bash
docker build -t infrastruktur-app .
docker run -p 8080:80 infrastruktur-app
```

### Troubleshooting
- Check Railway logs if deployment fails
- Ensure database credentials are correctly set
- Verify `.env` file is NOT in Git (should be in `.gitignore`)
- Make sure `writable/` directory has proper permissions
- Railway automatically sets the `PORT` environment variable to 80 (HTTP)

### Troubleshooting
- Check Railway logs if deployment fails
- Ensure database credentials are correctly set
- Verify PHP version is 8.1 or higher
- Make sure all required PHP extensions are enabled

