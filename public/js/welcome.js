
$(document).ready(function() {
    var size = 1;

    var refreshID = setInterval(function () {
        $('.answer').css("font-size", size);
        size += 1;
        if (size > 70) {
            clearInterval(refreshID);
        };
    }, 20);

});
