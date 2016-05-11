
    // We will use the question_id when posting an answer so save globally.
    var question_id;


    // Show the 'voting' box as a modal
    function showModal(clicked_id) {
        // We have the 'clicked_id' which is the question_id so save to global
        question_id = clicked_id;
        getQuestion(clicked_id);
        jQuery.noConflict();
        $('#deleteModal').modal('show');
        return false;
    }

    // Get the question the user clicked 'delete' ... we will do a confirm delete.
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
                        $('#question_id').val(data['id']);
                        $('#question').text(data['question']);
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
