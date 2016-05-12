
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

    $('#image').bootstrapFileInput();

});
