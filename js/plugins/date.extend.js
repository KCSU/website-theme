define(['lodash'], function(_) {
    _.extend(Date.prototype, {
        getWeekday: function(short) {
            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                out  = days[this.getDay()];

            if(short !== undefined) {
                out = out.substr(0, 3);
            }

            return out;
        },
        getMonthName: function(short) {
          var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
              out  = months[this.getMonth()];

          if(short !== undefined) {
              out = out.substr(0, 3);
          }

          return out;
        },
        getSuffix: function() {
            var n = this.getDate();
            // If not the 11th and date ends at 1
            if (n != 11 && (n + '').match(/1$/))
                return 'st';
            // If not the 12th and date ends at 2
            else if (n != 12 && (n + '').match(/2$/))
                return 'nd';
            // If not the 13th and date ends at 3
            else if (n != 13 && (n + '').match(/3$/))
                return 'rd';
            else
                return 'th';
        }
    });
});