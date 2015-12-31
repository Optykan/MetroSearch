function SecondsToHMS(d) {
    d = Number(d);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);
    var min = format(m);
    var sec = format(s);
    val = min + ':' + sec;
    return val;
}

function format(num) {
    if (num > 0) {
        if (num >= 10)
            val = num;
        else
            val = '0' + num;
    } else
        val = '00';

    return val;
}