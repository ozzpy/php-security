
<p align="center">
<a href="https://secthemall.com"><img width="400" src="https://secthemall.com/img/sta_logo_white.png"></a><br><br>
<img src="https://img.shields.io/badge/style-GPL-blue.svg?style=flat&label=license">
<img src="https://img.shields.io/badge/style-5.x-green.svg?style=flat&label=PHP">
<img src="https://img.shields.io/badge/style-7.x-green.svg?style=flat&label=PHP">
<a href="https://twitter.com/secthemall"><img src="https://img.shields.io/twitter/follow/secthemall.svg?style=social&label=Follow&maxAge=2592000"></a>
</p>

<br >

# About PHP-Security
SECTHEMALL PHP-Security is a web application framework that attempts to take the pain out of protecting your PHP applications. It is centrally orchestrated and it distributes your black and white list to all your PHP applications. Super easy installation, just type: `bash <(curl -sSL 'https://secthemall.com/webapp/setup.txt')`

<br>

# Why SECTHEMALL PHP-Security
> The purpose of **SECTHEMALL PHP-Security** is to centralize your application logs, and makes you able to take control of what happen on your applications, not only in terms of security (like: successful login, login failed, brute-force attempts, session hijacking, unexpected behaviours, etc...) but also for functional purposes (for example: user John Doe [Country: Italy, IP: 10.0.0.1] purchased Pro package [Browser: Safari, OS: Mac OS X, Platform: Tablet])
> 
> Imagine that your company has **10 different PHP applications**. Once install SECTHEMALL PHP-Security you see that an IP address **try to guess the admin password** on one of them. You can login to your dashboard and **block that IP address on all your applications**, sending a customizable courtesy page to the user that says: "sorry, you were blocked. For more information, please contact the website administrator." 
>
> Always from the SECTHEMALL dashboard, you can **define a rule that automatically blocks an IP address** that tries to guess the admin password for more than 5 times, and distributes this block to all others applications.
>
> You can use it for both internet or intranet applications (on a **docker container** or not). It's 100% CloudFlare compatible: this means that you'll see the **real user's IP address**, or you can block all connections from "Non-CloudFlare" IP addresses (this grant you that all traffic will come just from cloudflare servers).

<br>

# Table of contents
- [About PHP-Security](#about-php-security)
- [Why SECTHEMALL PHP-Security](#why-secthemall-php-security)
- [How does it work?](#how-does-it-work)
  - [A little preview](#a-little-preview)
- [Requirements](#requirements)
- [Installation](#installation)
- [Quick start](#quick-start)
- [The PHP client](#the-php-client)
- [Features](#features)
  - [Blacklist IP from dashboard](#blacklist-ip-from-dashboard)
  - [Blacklist a whole country](#blacklist-a-whole-country)
  - [Block access from non-CloudFlare IPs](#block-access-from-non-cloudflare-ips)
  - [Hide versions and software type](#hide-versions-and-software-type)
    - [Without SECTHEMALL](#without-secthemall)
    - [With SECTHEMALL](#with-secthemall)
  - [Prevent Session Hijacking](#prevent-session-hijacking)
  
<br>

# How does it work?
![](https://secthemall.com/webapp/images/php-howitworks.gif?v=3)

## A little preview
> ![sec1](https://secthemall.com/webapp/images/php-sec-1.png)

> ![sec2](https://secthemall.com/webapp/images/php-sec-2.png)

<br>
<br>

# Requirements
- PHP
- OpenSSL
- cURL
- wget

<br>

# Installation
```bash
bash <(curl -sSL 'https://secthemall.com/webapp/setup.txt')
```
The script will ask you to insert your SECTHEMALL username and password (if you don't have one, visit https://secthemall.com/signup/) and to choose an alias name for the node that you are configuring. After this, it downloads all required PHP files and tells you how to include the core functions to your application.

<br>

# Upgrade
```bash
cd secthemall-webapp-client/
bash <(curl -sSL 'https://secthemall.com/webapp/upgrade.txt')
```

<br>

# Quick start
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
The `secthemall_sendlog()` function automatically collect all useful information about the user (like real IP address, all request headers, the used browser and operating system, etc...). The only parameter is an Array that could contains the following variables:

<table>
<tr><td>msg</td><td>Could contains a description of the event. For example, <code>User password has been changed</code></td></tr>
<tr><td>username</td><td>If set, SECTHEMALL index the username for searching purpose. If not, it'll be set to `unknown`</td></tr>
<tr><td>severity</td><td>could be one of the following: <code>low, medium, high, critical</code></td></tr>
</table>

On your dashboard, you'll see all log you send with a huge amount of additional information like: Geograhpic location, Full request headers, Browser, Operating System, Platform type, etc...

<br>

# The PHP client
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

<br>

# Features

## Blacklist IP from dashboard
![SECTHEMALL Dashboard](https://secthemall.com/webapp/images/php-sec.gif?t=4)

<br>

## Blacklist a whole country

<br>

## Block access from non-CloudFlare IPs
In order to block access from all non-CloudFlare IP addresses, edit the `config.php` file at `secthemall-webapp-client/inc/config.php` and set the `noncf_block` variable to `true`.

<br>

## Hide versions and software type
*from http://php.net/manual/en/security.hiding.php*
> In general, security by obscurity is one of the weakest forms of security. But in some cases, every little bit of extra security is desirable. A few simple techniques can help to hide PHP, possibly slowing down an attacker who is attempting to discover weaknesses in your system.

PHP-Security hides, by default, the `Server` banner and the `X-Powered-By` header that, sometimes, it includes critical information about software used and versioning:

### Without SECTHEMALL
> `$ curl -I http://localhost:9443/index.php`<br>HTTP/1.1 200 OK<br>**Server: nginx/1.10.0 (Ubuntu)**<br>Date: Sun, 28 May 2017 10:21:23 GMT<br>Content-Type: text/html; charset=UTF-8<br>Connection: keep-alive<br>**X-Powered-By: PHP/7.0.15-0ubuntu0.16.04.4**<br>

### With SECTHEMALL
> `$ curl -I http://localhost:9443/index.php`<br>HTTP/1.1 200 OK<br>Date: Sun, 28 May 2017 10:24:41 GMT<br>Content-Type: text/html; charset=UTF-8<br>Connection: keep-alive<br>**Server: secthemall**<br>

<br>

## Prevent Session Hijacking
