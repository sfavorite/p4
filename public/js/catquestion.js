
    // We will use the question_id when posting an answer so save globally.
    var question_id;


    // Show the 'voting' box as a modal
    function showModal(clicked_id) {
        // We have the 'clicked_id' which is the question_id so save to global
        question_id = clicked_id;
        getQuestion(clicked_id);
        jQuery.noConflict();
        $('#questionModal').modal('show');
        return false;
    }

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

    // Post the answer the user choose.
    $('#vote').click(function(event) {

        event.preventDefault();

        // Use the global quesiton_id, the option the user choose and our csrf token
        var usersData = { question_id: question_id,
                        possibility_id: $('#options option:selected').val(),
                        '_token': $('meta[name="csrf-token"]').attr('content') };

        try {
            $.ajax({
                type: "POST",
                url: window.location.protocol + "//" + window.location.host + '/answer',
                data: usersData,
                dataType: 'json',
                cache: false,
                success: function(data) {
                    $('#questionModal').modal('hide');
                    $('#successModal').modal('show');
                    return false;
                },
                error: function(data) {
                    console.log('Error: ', data);
                }
            });
        } catch(e) {
            console.log('Something is wrong');
        }

    });
