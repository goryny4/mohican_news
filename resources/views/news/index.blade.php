@extends('layouts.app')

<script>
    window.onload = function() {
        $('#filterByCategorySelect').on('change', function () {
            $.get( "/", {categoryId: $(this).val()})
                .done(function( data ) {
                    $( "#rows" ).html( data );
            });
        });

        $('#newsTextModal').on('show.bs.modal', function (e) {
            $.get( "/news/"+e.relatedTarget.dataset.id)
                .done(function( data ) {
                    console.log(data);
                    $('.modal-title').html( data.title );
                    $('.modal-body').html( data.full_text );
                });
        });
    }
</script>

<div class="row">
    <div class="col">
        <select class="selectpicker custom-select" id="filterByCategorySelect" name="filterByCategorySelect">
            <option value="0">All</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <a class="btn btn-outline-secondary" href="/manager" role="button">Manager</a>
    </div>
</div>

<div class="row">
    <div class="col">
        <div id="newsTextModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
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
            </tr>
            </thead>
            <tbody id="rows">

                @each('news.row', $news, 'newsRecord', 'news.empty')

            </tbody>
        </table>
    </div>>
</div>



