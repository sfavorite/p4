


    // Add additional possibilities
        $('#add').click(function (event) {
            event.preventDefault();
            // How many textboxes have been added.
            var n = $('.text').length + 1;

            // Add a new input
            $('#possibility').append('<label></label><div><input class="form-control" type="text" name="possibility[]" placeholder="Enter a voting possibility..."><br><button class="delete btn btn-danger">Delete</button></div>');

            // How many boxes do we have...5 should be the max.
            // If so disable the Add possibility button
            if (n > 2) {
                $('#add').attr('disabled', 'disabled');
            };
        });

        $('body').on('click', '.delete', function(event) {
            // Remove the selected input box
            $(this).parent('div').remove();

            // Make sure the Add possibility button is not disabled.
            $('#add').removeAttr('disabled');
            return false;
        });


    // Get the question the user clicked on
    function getQuestion(clicked_id) {
        try {
            $.ajax({
                type: 'GET',
                data: {id: clicked_id},
                url: window.location.protocol + "//" + window.location.host + '/question/',
                cache: false,
                dataType: 'json',

                success: function(data) {
                    // If the record wasn't found show the error.
                    if (data['id'] === 'Record not found') {
                        $('#question').text(data['id']);
                    // No error so show the question and options.
                    } else {
                        // Remove any options already in the select and put the fisrt one back.
                        var select = $('#options');
                        select.empty().append('<option value="">Give your opinion...</option>');
                        $('#question').text(data['question'])
                        for (i = 0; i < data.possibility.length; ++i) {
                            var these_options = '<option value="' + data.possibility[i].id + '">' + data.possibility[i].instance + '</option>';
                            $(these_options).appendTo('#options');
                        }
                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
        } catch(e) {
            console.log('Try ajax get failed');
        }
    }
