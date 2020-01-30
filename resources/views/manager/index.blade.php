@extends('layouts.app')

<script>
    window.onload = function() {
        // ------------------ ADD ACTION ------------------------------------

        $('#newsCreateModal').on('show.bs.modal', function (e) {
            $('#inputCreate').val( '' );
            $('#textareaCreate').val( '' );
        });

        // Bind click to OK button within popup
        $('#newsCreateModal').on('click', '.btn-ok', function(e) {

            var $modalDiv = $(e.delegateTarget);
            var id = $(this).attr('data-record-id');

            var title = $('#inputCreate').val( );
            var full_text = $('#textareaCreate').val();
            var category_id = $('#categoryCreate').val();

            $modalDiv.addClass('loading');
            $.ajax({
                url: '/manager/',
                data: {title:title, full_text:full_text, category_id:category_id, _token: '{{csrf_token()}}' },
                type: 'POST',
                success: function(result) {
                    $modalDiv.modal('hide').removeClass('loading');
                    // load new rows
                    $.get( "/manager").done(function( data ) {
                        $( "#rows" ).html( data );
                    });
                }
            });
        });


        // ------------------ UPDATE ACTION ------------------------------------

        $('#newsEditModal').on('show.bs.modal', function (e) {
            // bypass id from Delete button to Confirm button
            $('.btn-ok', this).attr('data-record-id', e.relatedTarget.dataset.id);

            // load title and text
            $.get( "/manager/"+e.relatedTarget.dataset.id)
                .done(function( data ) {
                    $('#inputEdit').val( data.title );
                    $('#textareaEdit').val( data.full_text );
                    $('#categoryEdit').val( data.category_id );
                });
        });

        // Bind click to OK button within popup
        $('#newsEditModal').on('click', '.btn-ok', function(e) {

            var $modalDiv = $(e.delegateTarget);
            var id = $(this).attr('data-record-id');

            var title = $('#inputEdit').val( );
            var full_text = $('#textareaEdit').val();
            var category_id = $('#categoryEdit').val();

            $modalDiv.addClass('loading');
            $.ajax({
                url: '/manager/' + id,
                data: {title:title, full_text:full_text, category_id:category_id, _token: '{{csrf_token()}}' },
                type: 'PUT',
                success: function(result) {
                    $modalDiv.modal('hide').removeClass('loading');
                    // load new rows
                    $.get( "/manager").done(function( data ) {
                        $( "#rows" ).html( data );
                    });
                }
            });
        });
        // ------------------ DELETE ACTION ------------------------------------

        // bypass id from Delete button to Confirm button
        $('#newsDeleteModal').on('show.bs.modal', function(e) {
            $('.btn-ok', this).attr('data-record-id', e.relatedTarget.dataset.id);
        });

        // Bind click to OK button within popup
        $('#newsDeleteModal').on('click', '.btn-ok', function(e) {

            var $modalDiv = $(e.delegateTarget);
            var id = $(this).attr('data-record-id');

            console.log(id);
            $modalDiv.addClass('loading');
            $.ajax({
                url: '/manager/' + id,
                data: { _token: '{{csrf_token()}}' },
                type: 'DELETE',
                success: function(result) {
                    $modalDiv.modal('hide').removeClass('loading');
                    // load new rows
                    $.get( "/manager").done(function( data ) {
                        $( "#rows" ).html( data );
                    });
                }
            });
        });
    }
</script>



<div class="row">
    <div class="col">
        <button type="button" data-target="#newsCreateModal"class="btn btn-primary" data-toggle="modal">
            Add new record
        </button>
        <a class="btn btn-outline-secondary" href="/" role="button">Home</a>

        <div id="newsCreateModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <select class="selectpicker custom-select" id="categoryCreate" name="filterByCategorySelect">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="inputCreate">Title</label><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="inputCreate" value="Title here"/>
                        <label for="textareaCreate">Text</label><textarea id="textareaCreate" class="form-control" id="exampleFormControlTextarea1" rows="7">Modal body text goes here</textarea>
                    </div>
                    <div class="modal-footer">
                        <button data-record-id="" type="button" class="btn btn-primary btn-ok">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<div class="row">
    <div class="col">


        <div id="newsEditModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select class="selectpicker custom-select" id="categoryEdit" name="filterByCategorySelect">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="inputEdit">Title</label><input id="inputEdit"type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="Title here"/>
                        <label for="textareaEdit">Text</label><textarea id="textareaEdit" class="form-control" id="exampleFormControlTextarea1" rows="7">Modal body text goes here</textarea>
                    </div>
                    <div class="modal-footer">
                        <button data-record-id="" type="button" class="btn btn-primary btn-ok">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="newsDeleteModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button data-record-id="" type="button" class="btn btn-primary btn-ok">Confirm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">News</th>
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody id="rows">

                @each('manager.row', $news, 'newsRecord', 'manager.empty')

            </tbody>
        </table>
    </div>>
</div>



