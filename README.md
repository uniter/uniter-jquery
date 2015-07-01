Uniter PHP app demo
===================

Easily write client-side logic in PHP by compiling to JavaScript:

[
![App demo using PHP with Uniter and jQuery](https://uniter.github.io/uniter-jquery/img/app_demo.gif)
](https://uniter.github.io/uniter-jquery/)

[
![App demo using PHP with Uniter and jQuery](https://uniter.github.io/uniter-jquery/img/app_demo.gif)
](https://uniter.github.io/uniter-jquery/)

PHP and JS files are compiled down to a single JS bundle file.

Compile with Browserify:

```javascript
composer install
npm install
npm run build
```

or compile with Webpack:

```javascript
composer install
npm install
npm run webpack
```

and then open `index.html` in a browser.

Run the tests
-------------

Tests are written with PHPUnit:

```shell
composer install
vendor/bin/phpunit
```
