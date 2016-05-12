
var availableCountries = [
];

var availableCities = [
];

$(function() {
  $( "#city" ).autocomplete({
    source: availableCities
  });
});

$(function() {
  $( "#country" ).autocomplete({
    source: availableCountries
  });
});

$(document).ready(function() {
    var country = geoplugin_countryName();
    $("#country").val(country);
    var zone = geoplugin_region();
    var district = geoplugin_city();
    $("#city").val(district);

});
