# Railway Deployment Setup Checklist

## 1. Railway Project Configuration

### Database Setup
- Add MySQL service to your Railway project
- Note the credentials that will be auto-generated

### Environment Variables (Railway Dashboard)
Set these variables in your Railway project settings:

```
CI_ENVIRONMENT=production
app.baseURL=https://<your-project-name>.up.railway.app/
database.default.hostname=${{MySQL.MYSQL_HOST}}
database.default.port=${{MySQL.MYSQL_PORT}}
database.default.database=${{MySQL.MYSQL_DB}}
database.default.username=${{MySQL.MYSQL_USER}}
database.default.password=${{MySQL.MYSQL_PASSWORD}}
```

## 2. Application Setup

### First Deployment
1. Push code to GitHub
2. Railway auto-builds from Dockerfile
3. Once deployed, SSH into container or use logs to verify

### Database Migrations
After first successful deployment:
```bash
php spark migrate
```

### File Permissions
The `writable/` directory should have correct permissions:
- Logs: `writable/logs/`
- Cache: `writable/cache/`
- Uploads: `writable/uploads/`
- Session: `writable/session/`

## 3. Debugging

### Check Rails Logs
- Go to Railway Dashboard → Your Project → Logs
- Look for PHP errors, Apache errors, or connection issues

### Common Issues

#### Application Not Responding
- Check if MySQL database is connected (verify credentials)
- Verify baseURL is correct
- Check if writable directories have write permissions
- Look for PHP errors in logs

#### Database Connection Failed
- Ensure MySQL service is added to Railway project
- Verify database credentials in environment variables
- Check if database schema exists (may need to run migrations)

#### File Permission Errors
- Ensure writable/ directories exist and are writable
- Docker image should set permissions correctly

## 4. Local Testing (Optional)

Test Docker image locally before deploying:
```bash
docker build -t infrastruktur-app .
docker run -p 8080:80 \
  -e CI_ENVIRONMENT=production \
  -e app.baseURL=http://localhost:8080/ \
  infrastruktur-app
```

Then visit: http://localhost:8080

## 5. Next Steps

1. Configure all environment variables in Railway
2. Add MySQL database service
3. Deploy/redeploy
4. Check logs for errors
5. Run migrations if needed
6. Verify writable directories
