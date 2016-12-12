/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */
'use strict';

var $ = require('jquery'),
    fileData = require('../dist/fileData.js'),
    hasOwn = {}.hasOwnProperty,
    uniter = require('uniter'),
    phpEngine = uniter.createEngine('PHP'),
    output = document.getElementById('output');

function getFileData(path) {
    if (!hasOwn.call(fileData, path)) {
        throw new Error('Unknown file "' + path + '"');
    }

    return fileData[path];
}

// Set up a PHP module loader
phpEngine.configure({
    include: function (path, promise) {
        promise.resolve(getFileData(path));
    }
});

// Expose jQuery, window, Math and Console to PHPland
phpEngine.expose($, 'jQuery');
phpEngine.expose(window, 'window');
phpEngine.expose(console, 'console');
phpEngine.expose(Math, 'jsMath');

// Write content HTML to the DOM
phpEngine.getStdout().on('data', function (data) {
    document.body.insertAdjacentHTML('beforeEnd', data);
});

// Go!
phpEngine.execute('<?php require("php/app.php");').fail(function (error) {
    console.warn('ERROR: ' + error.toString());
});
