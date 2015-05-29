/*
 * Demo of packaging PHP files up with Browserify+Uniter
 *
 * MIT license.
 */
'use strict';

var fs = require('fs'),
    globby = require('globby'),
    path = require('path'),
    files = globby.sync([
        __dirname + '/../php/**/*.php',
        '!' + __dirname + '/../php/src/Demo/PhpQuery/**',
        '!' + __dirname + '/../php/src/Demo/QueryPath/**'
    ]),
    fileData = {},
    root = __dirname + '/..';

files.forEach(function (filePath) {
    fileData[path.relative(root, filePath)] = fs.readFileSync(filePath).toString();
});

fs.writeFileSync(
    __dirname + '/../dist/fileData.js',
    'module.exports = ' + JSON.stringify(fileData) + ';'
);
