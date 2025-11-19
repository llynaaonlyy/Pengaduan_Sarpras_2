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
⚠️ **PHP Version:** This project is configured for **PHP 8.0** compatibility with Railway. The project files indicate PHP 8.1 support, but Railway's us-west1 region has better support for PHP 8.0.

### Steps to Deploy

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

3. **Add MySQL Database**
   - In Railway project, click "+ Add" 
   - Select "MySQL"
   - Confirm and wait for deployment

4. **Configure Environment Variables**
   - In Railway, go to your project variables
   - Add these variables:
     ```
     CI_ENVIRONMENT=production
     app.baseURL=https://your-app.railway.app/
     database.default.hostname=${{MySQL.MYSQL_HOST}}
     database.default.database=${{MySQL.MYSQL_DB}}
     database.default.username=${{MySQL.MYSQL_USER}}
     database.default.password=${{MySQL.MYSQL_PASSWORD}}
     database.default.port=${{MySQL.MYSQL_PORT}}
     ```

5. **Alternative Regions**
   - If deployment fails in us-west1, try other Railway regions like us-east1 or eu-west1
   - Different regions may have different PHP version availability

5. **Run migrations (optional)**
   - After first deployment, you may need to run migrations
   - Use Railway CLI or SSH into the container to run migrations:
     ```bash
     php spark migrate
     ```

### Important Notes
- Make sure `.env` file is in `.gitignore` (it is by default)
- The `writable/` directory must have write permissions for logs, cache, and uploads
- Railway automatically sets the `PORT` environment variable
- Your app will be accessible at `https://<your-project-name>.up.railway.app`

### Troubleshooting
- Check Railway logs if deployment fails
- Ensure database credentials are correctly set
- Verify PHP version is 8.1 or higher
- Make sure all required PHP extensions are enabled

