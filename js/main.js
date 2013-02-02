/*
    KCSU Website Theme
    ==================

    @url       http://github.com/kcsu/website-theme
    @license   GNU General Public License v3.0 http://opensource.org/licenses/GPL-3.0

    Copyright (C) 2012 Gideon Farrell

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    Javascript Entry Point
    ----------------------

    This file defines all the paths for the application, and bootstraps it.

    @file    main.js
    @package js
    @author  Gideon Farrell <me@gideonfarrell.co.uk>
 */



// Basic configuration
require.config({
    paths: {
        'jquery':     'jquery-1.8.3'
    }
});

// Initialise application
require(
    [
        'lodash', 'jquery', 'Holder',
        'bootstrap/dropdown', 'bootstrap/alert', 'bootstrap/collapse',
        'plugins/relative-dates'
    ],
    function(_, $) {
        _.templateSettings = {
            interpolate : /\{\{(.+?)\}\}/g
        };
        $('.date.relative').relativeDate();
    }
);