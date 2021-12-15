$(document).ready(function () {

    window.setInterval(() => {
        let time = new Date();
        let hr = time.getHours();
        let min = time.getMinutes();
        var sec = time.getSeconds();
        let when = 'am';
        if (hr > 12) {
            hr = hr - 12;
            when = 'pm';
        }
        if (hr < 10) {
            hr = '0' + hr;
        }
        if (min < 10) {
            min = '0' + min;
        }
        if (sec < 10) {
            sec = '0' + sec;
        }

        $(".time").html(' ' + hr + ':' + min + ' : ' + sec + ' ' + when);
    }, 1000);

});