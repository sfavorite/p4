<div id='sessionModal' class="modal fade in" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="voteForm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="sessionModal">&times;</button>
            </div>


                <div class="modal-body">
                    <h2 class="text-center">{{ Session::get('message') }}</h2>

                </div>

                <div class="modal-footer">
                    <div class="form-group">
                        <div class="btn-group">
                            <button id="cancel" data-dismiss="modal" class="btn btn-info btn-block">Cancel</button>

                        </div>
                    </div>
                </div>

        </div>

    </div>
</div>
