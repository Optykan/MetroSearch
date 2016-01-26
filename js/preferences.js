function setCookie(cname, cvalue) {
    var d = new Date();
    var t = d.getTime() + (86400 * 30);
    var expires = "expires=" + Date.parse(t);
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "y/y/y/rgba(155, 89, 182,0.8)/rgba(155, 89, 182,0.8)";
}

function loadPref() {
    var pref = getCookie("pref").split("/");
    console.log(pref);
    var nodes = document.getElementsByClassName("prefSwitch");
    for (var i = 0; i < 3; i++) {
        if (pref[i] == "y") {
            nodes[i].checked = true;
        }
    }
}

function savePref() {
    var sav = "";
    var nodes = document.getElementsByClassName("prefSwitch");
    for (var i = 0; i < 3; i++) {
        if (nodes[i].checked) {
            sav += "y/";
        } else {
            sav += "n/";
        }
    }
    for (var i = 3; i < nodes.length; i++) {
        if (!!nodes[i].value)
            sav += nodes[i].value + "/";
        else
            sav += "rgba(155, 89, 182,0.8)/";
    }
    setCookie("pref", sav.substr(0, sav.length - 1));
}

function hoverCol(elem) {
    var rgba = /rgba?\(((25[0-5]|2[0-4]\d|1\d{1,2}|\d\d?)\s*,\s*?){2}(25[0-5]|2[0-4]\d|1\d{1,2}|\d\d?)\s*,?\s*([01]\.?\d*?)?\)/i;
    var hex = /\b[0-9A-F]{6}/i;
    var hexthree = /\b[0-9A-F]{3}/i;
    if (!!elem.value.match(rgba) || !!elem.value.match(hex) || !!elem.value.match(hexthree)) {
        console.log(elem.value);
        elem.style.border = "1px solid " + elem.value;
    } else {
        elem.style.border = "1px solid black";
    }
}