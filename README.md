# avans-respectmystudy
Project blok 7 en 8 "Respect My Study"

# Requirements
- PHP (http://php.net/downloads.php)
- Vagrant (https://www.vagrantup.com/downloads.html)
- Composer (https://getcomposer.org/download/)
- VirtualBox/VMware

# Installing
`composer install`

`php vendor/bin/homestead make`

## The Hosts File

You must add the "domains" for your Nginx sites to the  `hosts`  file on your machine. The  `hosts`file will redirect requests for your Homestead sites into your Homestead machine. On Mac and Linux, this file is located at  `/etc/hosts`. On Windows, it is located at  `C:\Windows\System32\drivers\etc\hosts`. The lines you add to this file will look like the following:

```php
192.168.10.10  homestead.test
```

Make sure the IP address listed is the one set in your  `Homestead.yaml`  file. Once you have added the domain to your  `hosts`  file and launched the Vagrant box you will be able to access the site via your web browser:

```php
http://homestead.test
```

## Links
- https://laravel.com/docs/5.7/homestead#per-project-installation

# Running
`vagrant up`

# Running Selenium
## Running Selenium Server
`php artisan selenium:start`

## Running Selenium Tests
`vendor/bin/steward run staging chrome`
