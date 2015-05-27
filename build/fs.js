/*
 * Demo of packaging PHP files up with Browserify+Uniter
 *
 * MIT license.
 */
'use strict';

var fs = require('fs'),
    glob = require('glob'),
    path = require('path'),
    files = glob.sync(__dirname + '/../php/**/*.php'),
    fileData = {},
    root = __dirname + '/..';

files.forEach(function (filePath) {
    fileData[path.relative(root, filePath)] = fs.readFileSync(filePath).toString();
});

fs.writeFileSync(
    __dirname + '/../dist/fileData.js',
    'module.exports = ' + JSON.stringify(fileData) + ';'
);
