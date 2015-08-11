# Configuration

## Database

Create database using last version from `db/dump` directory.
Execute scripts from `db/scripts`

## Environment

### Environment Variable

Define the environment name in an environment variable.
For example you can add the following line to the `web/.htaccess`:

```
SetEnv ENVIRONMENT development
```

In that case, you may want to configure git so the `.htaccess` file doesn't appear in the modified files to commit:

```
$ git update-index --assume-unchanged web/.htaccess 
```


### Environment Configuration Directory

1. Add a directory with the environment name in `web/application/config`
2. Copy of the config files with server specific values like `database.php`, `email.php` and `environment.php`
3. Edit those files


# Documentation

For more information about using PHP on Heroku, see these Dev Center articles:

- [PHP on Heroku](https://devcenter.heroku.com/categories/php)
