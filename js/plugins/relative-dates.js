define(['jquery', 'plugins/date.extend', 'lodash'], function($) {
    $.fn.relativeDate = function(opts){
        var defaults = {
            dateGetter: function(el){
                return $(el).text();
            },
            threshold: 'week', // day, week, month, year
            format: '{{ day_name }}, {{ day }}{{suffix}} {{ month }} {{ year }}'
        },
        options = $.extend({}, defaults, opts),
        time_ago_in_words_with_parsing = function(from) {
            var date = new Date(Date.parse(from));
            return time_ago_in_words(date);
        },
        time_ago_in_words = function(from) {
            return distance_of_time_in_words(new Date(), from);
        },
        format_date = function(date_obj) {
            return _.template(options.format, {
                'day_name': date_obj.getWeekday(),
                'day': date_obj.getDate(),
                'suffix': date_obj.getSuffix(),
                'month': date_obj.getMonthName(),
                'year': date_obj.getFullYear()
            },
            {
                interpolate : /\{\{(.+?)\}\}/g
            });
        },
        distance_of_time_in_words = function(to, from) {
            var distance_in_seconds = ((to - from) / 1000),
                distance_in_minutes = Math.floor(distance_in_seconds / 60),
                date = new Date(from),

                day   = 1440,
                week  = 10080,
                month = 43200,
                year  = 525960;

            if (distance_in_minutes === 0) { return 'less than a minute ago'; }
            if (distance_in_minutes == 1) { return 'a minute ago'; }
            // between 1 and 45 minutes
            if (distance_in_minutes < 45) { return distance_in_minutes + ' minutes ago'; }
            // between 45 and 90 minutes (3/4 - 1.5 hours)
            if (distance_in_minutes < 90) { return 'about 1 hour ago'; }
            // between 1.5 and 24 hours
            if (distance_in_minutes < day) { return 'about ' + Math.round(distance_in_minutes / 60) + ' hours ago'; }
            // between one and two days
            if (distance_in_minutes < 2 * day) { return 'yesterday'; }
            if(options.threshold == 'day') return format_date(date);
            // under a week
            if (distance_in_minutes < week) { return 'on ' + date.getWeekday(); }
            if(options.threshold == 'week') return format_date(date);
            // under a month
            if (distance_in_minutes < month) { return Math.floor(distance_in_minutes / 1440) + ' days ago'; }
            if(options.threshold == 'month') return format_date(date);
            // between one and two months
            if (distance_in_minutes < 2 * month) { return 'about 1 month ago'; }
            // under a year
            if (distance_in_minutes < year) { return Math.floor(distance_in_minutes / 43200) + ' months ago'; }
            if(options.threshold == 'year') return format_date(date);
            // between one and two years
            if (distance_in_minutes < 2 * year) { return 'about 1 year ago'; }

            // otherwise just print the number of years
            return 'over ' + Math.floor(distance_in_minutes / 525960) + ' years ago';
        };

        return $(this).each(function(){
            date_str = options.dateGetter(this);
            $(this).html(time_ago_in_words_with_parsing(date_str));
        });
    };
});