Uniter PHP app demo
===================

An app with client-side logic written in PHP.

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
