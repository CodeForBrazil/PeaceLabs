# PeaceLabs
This space is design to co-create PeaceLabs.co, platform that uses collaboration technologies, such as crowdsourcing and crowdfunding, to improve the chances of success of social, environmental and economic community projects.

After several social projects developed, crowdfunded & executed over 2014 #CheerForPeace, a startup social enterprise, learned that crowdfunding successfully is a very difficult task & that this is especially true for social projects.

So to solve this problem, in its latest iteration, the startup is now launching a new product called PeaceLabs, a platform for Peace Ambassadors to co-create projects in the sustainability & social responsibility arena with collaboration technologies for crowdsourcing the community's input while helping improve the success rate of crowdfunding "Peace Projects."

https://youtu.be/wHIkLzUbwxA

Welcome to PeaceLabs.co! We are happy to count on you and all Peace Ambassadors around the world to develop this community!

General files at: https://drive.google.com/a/peacelabs.co/folderview?id=0B2fJ6Nq0nCZlfkZsQzJTZWVSc1ZucFJDQmxsN2EtRF9KYU9nMENPMzdEY25zTzAtTzhXNW8&usp=sharing

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
