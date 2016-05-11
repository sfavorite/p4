

$('#country').keyup(function () {
    var val = $(this).val(); // Get what the user has typed to use in the search
    $.ajax({
        type: 'GET',
        url: 'http://p4.scotfavorite.loc/countries',
        cache: false,
        data: { key: val },
        dataType: 'json',
        success: function(data) {
            console.log('availableCountries');
            // Turn the objest to an array (jQuery needs an array)
            for (i = 0; i < data.length; ++i) {
                // If the country is not in the array push it to the end
                if(jQuery.inArray(data[i]['country'], availableCountries) === -1) {
                    availableCountries.push(data[i]['country']);
                }
            }

        },
        error: function(data) {
            console.log(data);
        }
    });

});

$('#city').keyup(function () {
    var val = $(this).val(); // Get what the user has typed to use in the search
    $.ajax({
        type: 'GET',
        url: 'http://p4.scotfavorite.loc/cities',
        cache: false,
        data: { key: val },
        dataType: 'json',
        success: function(data) {
            // Turn the objest to an array (jQuery needs an array)
            for (i = 0; i < data.length; ++i) {
                // If the city is not in the array push it to the end
                if(jQuery.inArray(data[i]['city'], availableCities) === -1) {
                    availableCities.push(data[i]['city']);
                }
            }

        },
        error: function(data) {
            console.log(data);
        }
    });

});
