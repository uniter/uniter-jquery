Uniter PHP app demo
===================

A demo of a PHP application, with PHP and JS files compiled down to a single JS bundle file.

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
