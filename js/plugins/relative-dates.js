define(['jquery', 'plugins/date.extend', 'lodash'], function($) {
    $.fn.relativeDate = function(opts){
        var defaults = {
            dateGetter: function(el){
                return $(el).text();
            },
            threshold: 'week', // day, week, month, year
            format: '{{ dn }}, {{ d }}{{ sx }} {{ mn }} {{ yy }}'
        },
        options = $.extend({}, defaults, opts),
        time_ago_in_words_with_parsing = function(from) {
            var date = new Date(Date.parse(from));
            return time_ago_in_words(date);
        },
        time_ago_in_words = function(from) {
            return distance_of_time_in_words(new Date(), from);
        },
        distance_of_time_in_words = function(to, from) {
            var seconds = ((to - from) / 1000),
                future  = (to < from),

                day     = 1440,
                week    = 10080,
                month   = 43200,
                year    = 525960,

                minutes = Math.abs(Math.floor(seconds / 60)),
                hours   = Math.floor(minutes / 60),
                days    = Math.floor(minutes / day),
                weeks   = Math.floor(minutes / week),
                months  = Math.floor(minutes / month),
                years   = Math.floor(minutes / year),
                date    = new Date(from),

                message = '';

            if (minutes === 0) { message = (future ? 'in less than a minute' : 'less than a minute ago'); }
            else if (minutes == 1) { message = (future ? 'in one minute' : 'a minute ago'); }
            // between 1 and 45 minutes
            else if (minutes < 45) { message = (future ? 'in {{ m }} minutes' : '{{ m }} minutes ago'); }
            // between 45 and 90 minutes (3/4 - 1.5 hours)
            else if (minutes < 90) { message = (future ? 'in about an hour' : 'about an hour ago'); }
            // between 1.5 and 24 hours
            else if (minutes < day) { message =  (future ? 'in about {{ h }} hours' : 'about {{ h }} hours ago'); }
            // between one and two days
            else if (minutes < 2 * day) { message = (future ? 'tomorrow' : 'yesterday'); }
            else if(options.threshold == 'day') message = options.format;
            // under a week
            else if (minutes < week) { message = (future ? 'next' : 'on') + ' {{ wd }}'; }
            else if(options.threshold == 'week') message = options.format;
            // under a month
            else if (minutes < month) { message = (future ? 'in {{ d }} days' : '{{ d }} days ago'); }
            else if(options.threshold == 'month') message = options.format;
            // between one and two months
            else if (minutes < 2 * month) { message = (future ? 'in about a month' : 'about a month ago'); }
            // under a year
            else if (minutes < year) { message = (future ? 'in {{ mo }} months' : '{{ mo }} months ago'); }
            else if(options.threshold == 'year') message = options.format;
            // between one and two years
            else if (minutes < 2 * year) { message = (future ? 'in about a year' : 'about a year ago'); }

            // otherwise just print the number of years
            else { message = (future ? 'in over {{ y }} years' : 'over {{ y }} years ago'); }

            return _.template(message, {
                m:  minutes,
                h:  hours,
                d:  days,
                dn: date.getWeekday(),
                sx: date.getSuffix(),
                wd: date.getWeekday(),
                w:  weeks,
                mo: months,
                mn: date.getMonthName(),
                y:  years,
                yy: date.getFullYear()
            });
        };

        return $(this).each(function(){
            date_str = options.dateGetter(this);
            $(this).html(time_ago_in_words_with_parsing(date_str));
        });
    };
});