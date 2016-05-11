
//highlight first list group option (if non active yet)
if ( $('.list-group a.active').length === 0 ) {
    $('.list-group a').first().addClass('active');
}

console.log(userInfo);

var $li = $('.list-group a').click(function() {
    $li.removeClass('active');
    $(this).addClass('active');

    $('#userName').text(userInfo[0].first + ' ' + userInfo[0].last);

/*
    $('#largePicture').attr("src", userInfo[this.id].largePicture);
    $('#userName').text(userInfo[this.id].firstName + ' ' + userInfo[this.id].lastName);
    $('#email').text(userInfo[this.id].email);
    $('#phone').text(userInfo[this.id].phone);
    $('#cell').text(userInfo[this.id].cell);
    $('#address').text(userInfo[this.id].address);
    $('#city').text(userInfo[this.id].city);
    $('#state').text(userInfo[this.id].state);
    $('#zip').text(userInfo[this.id].zip);
    $('#country').text(userInfo[this.id].country);
*/
});


$('.list-group a').first().addClass('active');
