function error(input) {
    document.getElementById("inputname").className = 'search search-error';
    document.getElementById("error").className = 'error error-active';
    document.getElementById("error").innerHTML = input;
}

function verify(cb) {
    document.getElementById("inputname").className = 'search search-loading';
    document.getElementById("error").className = 'error';
    setTimeout(function () {
        error("error");
    }, 1000);
    /*$.ajax({
        type: "GET",
        url: "verify.php",
        data: $("#form").serialize(),
        success: cb
    });*/
}

function callback(input) {
    document.getElementById("inputname").className = 'search';
    document.getElementById("error").className = 'error';
    if (input.indexOf("=") > 1) {
        var id = input.split("=");
        window.location = "results.php?id=" + id[0];
    } else {
        error(input);
    }
}