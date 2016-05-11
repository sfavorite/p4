
//highlight first list group option (if non active yet)
if ( $('.list-group a.active').length === 0 ) {
    $('.list-group a').first().addClass('active');
}

console.log(userInfo);

var $li = $('.list-group a').click(function() {
    $li.removeClass('active');
    $(this).addClass('active');

    // Since the data is in a javascript objest we need the user ID minus one.
    $('#userName').text(userInfo[this.id-1].first + ' ' + userInfo[this.id-1].last);
    $('#largePicture').attr("src", userInfo[this.id-1].image);
    $('#city').text(userInfo[this.id-1].city.city);
    $('#country').text(userInfo[this.id-1].country.country);
});


$('.list-group a').first().addClass('active');
