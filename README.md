# SECTHEMALL PHP Security
A **PHP** SDK that makes you able to connect your web application, API or website to your SECTHEMALL account.

> The purpose of this "SECTHEMALL PHP client" is to make your PHP websites and applications more secure, centralize security events and blacklists. It's 100% CloudFlare compatible and makes you able to take control of all events of your application (like login ok, login failed, brute-force attempts, session hijacking, unexpected behaviours, etc...)
> 
> Imagine that your company has **10 different PHP applications**. Once install SECTHEMALL PHP Security you see that an IP address **try to guess the admin password** on one of them. With this SDK you can **block that IP address on all your applications from your SECTHEMALL dashboard**, sending a customizable courtesy page to the user that says: "sorry, you were blocked. For more information, please contact the website administrator." 
>
> Always from the SECTHEMALL dashboard, you can **define a rule that automatically blocks an IP address** that tries to guess the admin password for more than 5 times, and distributes this block to all others applications.
>
> You can use it for both internet or intranet applications (on a **docker container** or not). It's 100% CloudFlare compatible and this means that you'll see the **real user's IP address**, or you can block all connections from "Non-CloudFlare" IP addresses (this grant you that all traffic will come just from cloudflare servers).

![](https://secthemall.com/webapp/images/php-gif.gif)

## Table of contents

## Requirements
- PHP
- OpenSSL
- cURL
- wget

## Installation
```bash
bash <(curl -sSL 'https://secthemall.com/webapp/setup.txt')
```
The script will ask you to insert your SECTHEMALL username and password (if you don't have one, visit https://secthemall.com/signup/) and to choose an alias name for the node that you are configuring. After this, it downloads all required PHP files and tells you how to include the core functions to your application.

## Quick start
First of all, after you completed the installation, you need to include the core functions script at the top of your index page or of all your PHP application pages:
```php
<?php
    require_once('/var/www/html/secthemall-webapp-client/functions.php');

    // ... your php code ...
?>
```
Now you can send any kind of log to your SECTHEMALL account! for example, you can send a log for each successful login:
```php
<?php
    require_once('/var/www/html/secthemall-webapp-client/functions.php');

    if($auth == 'ok') {
        secthemall_sendlog(array(
            'msg' => 'Login Successful',
            'username' => $_POST['username'],
            'severity' => 'low',
        ));
    }
?>
```
The `secthemall_sendlog()` function automatically collect all useful information about the user (like real IP address, all request headers, the used browser and operating system, etc...). On you dashboard, you will see this log like this:
### Dashboard logs list
![secex1](https://secthemall.com/webapp/images/php-sec-ex1.png)
### Log details
<table><tr><td>
<img src="https://secthemall.com/webapp/images/php-sec-ex2.png" width="400" /></td><td>
For each log you send, SECTHEMALL caught all useful information about the request and the user (for example the used browser, operating system, platform, etc...). If your website uses CloudFlare, it automatically shows you the real user's IP address.
</td></tr></table>

## Start blacklist update client
In order to receive all blacklist updates, you need to run the updatebl.php script: `php updatebl.php --start` or if you want to run it in background `php updatebl.php > /dev/null &`. Following an example output:

```bash
root@mywebapp:/var/www/html# cd secthemall-webapp-client/
root@mywebapp:/var/www/html/secthemall-webapp-client# php updatebl.php --start

(::) SECTHEMALL

If you want to run this client in background:
php updatebl.php > /dev/null &

13:23:43> [INFO ](check) Check blacklist updates...
13:23:44> [INFO ](firewall) Last iptables id from secthemall is: 
13:23:44> [INFO ](firewall) Blacklist is up to date.
13:23:44> [INFO ](country) Last country id from secthemall is: 1495713567000
13:23:44> [INFO ](country) Blacklist is up to date.
13:23:45> [INFO ](webapp) Last id from secthemall is: 0
13:23:45> [WARN ](webapp) Blacklist seems changed, downloading new version...
13:23:45> [OK   ](webapp) Blacklist synchronized.
13:23:45> [INFO ](keep-alive) Sending keep-alive to secthemall...
13:23:46> [INFO ](sleep) I go to sleep for a while.
```
The script can be stopped using `--stop` paramenter. It save it's PID inside a PHP script (`secthemall-webapp-client/inc/pid.php`) to prevent from access it by browsing it. 

The updatebl.php script will synchronize the follwing black and white lists:
- Web Application blacklist
- Global blacklist
- Global whitelist
- Country blacklist

## Screenshot
### Analyze your web applications logs
![sec1](https://secthemall.com/webapp/images/php-sec-1.png)

### Courtesy page for blocked users
![sec2](https://secthemall.com/webapp/images/php-sec-2.png)

## Hide versions and software type
### Without SECTHEMALL
`$ curl -I http://localhost:9443/index.php`<br>
HTTP/1.1 200 OK<br>
**Server: nginx/1.10.0 (Ubuntu)**<br>
Date: Sun, 28 May 2017 10:21:23 GMT<br>
Content-Type: text/html; charset=UTF-8<br>
Connection: keep-alive<br>
**X-Powered-By: PHP/7.0.15-0ubuntu0.16.04.4**<br>

### With SECTHEMALL
`$ curl -I http://localhost:9443/index.php`<br>
HTTP/1.1 200 OK<br>
Date: Sun, 28 May 2017 10:24:41 GMT<br>
Content-Type: text/html; charset=UTF-8<br>
Connection: keep-alive<br>
**Server: secthemall**<br>

## Blocking access from non-CloudFlare IP addresses
In order to block access from all non-CloudFlare IP addresses, edit the `config.php` file at `secthemall-webapp-client/inc/config.php` and set the `noncf_block` variable to `true`.
![cfblock](https://secthemall.com/webapp/images/php-sec-cloudflare.png)
