// Once the page is fully loaded start a timer to check
// for new questions every 1 minute
$(document).ready(function () {
    setInterval(getQuestionCount, 20000);
});

// Get the count of questions by category
function getQuestionCount() {
    try {
        $.ajax({
            type: 'GET',
            //data: {equality: select.value},
            url: window.location.protocol + "//" + window.location.host + '/questionCount/',
            cache: false,
            dataType: 'json',
            success: function(data) {
                for (var i = 0; i < data.length; ++i) {
                    $('#' + i).text(data[i]);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    } catch(e) {
        console.log('Ajax get failed');
    }
}
