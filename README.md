# SECTHEMALL PHP Security
A **PHP** SDK that makes you able to connect your web application, API or website to your SECTHEMALL account.

> The purpose of this "SECTHEMALL PHP client" is to make your PHP websites and applications more secure, centralize security events and blacklists. It's 100% CloudFlare compatible and makes you able to take control of all events of your application (like login ok, login failed, brute-force attempts, session hijacking, unexpected behaviours, etc...)
> 
> Imagine that you have **10 different PHP applications** on your company. Once install SECTHEMALL PHP Security you see that an IP address **try to guess the admin password** on one of them. With this SDK you can **block that IP address on all your applications from your SECTHEMALL dashboard**, sending a customizable courtesy page to the user that says: "sorry, you were blocked. For more information, please contact the website administrator." 
>
> Always from the SECTHEMALL dashboard, you can **define a rule that automatically blocks an IP address** that tries to guess the admin password for more than 5 times, and distributes this block to all others your applications.
>
> You can use it for both internet or intranet applications (on a **docker container** or not). It's 100% CloudFlare compatible and this means that you log the **real user's IP address**, or you can block all connections from "Non-CloudFlare" IP addresses (this grant you that all traffic will come just from cloudflare servers).

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

## Quick start

## Start blacklist update client

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
