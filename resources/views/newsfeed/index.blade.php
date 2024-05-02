<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script> --}}

    @vite(['resources/css/app.css', 'resources/scss/app.scss'])
  </head>
<body>
    <h1>Newsfeed</h1>

    <div id="newsfeeds">
        @foreach($newsfeeds as $newsfeed)
            <div class="newsfeed" data-id="{{ $newsfeed->id }}">
                <p>{{ $newsfeed->content }}</p>
                <button class="load-comments">Load Comments</button>
                <div class="comments" style="display:none;"></div>
                <form class="comment-form" style="display:none;">
                    @csrf
                    <input id="input1" type="text" name="content" >
                    <button type="submit">Post Comment</button>
                </form>
            </div>
        @endforeach
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            // 加載 comment
            $('.load-comments').click(function() {
                var newsfeedId = $(this).closest('.newsfeed').data('id');
                var commentsDiv = $(this).siblings('.comments');
                var commentform = $(this).siblings('.comment-form');
                var loadComments = $(this).closest('.load-comments');
                $.ajax({
                    url: '/newsfeed/' + newsfeedId + '/comments',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response.comments);
                        commentsDiv.html('');
                        $.each(response.comments, function(index, value){
                            commentsDiv.append('<div>' + value.content + '</div>');
                        });
                        commentsDiv.show();
                        commentform.show();
                        loadComments.hide();
                    }
                });
            });

            // 提交 comment
            $('.comment-form').submit(function(event) {
                event.preventDefault();
                var newsfeedId = $(this).closest('.newsfeed').data('id');
                var formData = $(this).serialize();
                $.ajax({
                    url: '/newsfeed/' + newsfeedId + '/comments',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        loadComments(newsfeedId);
                    }
                });
            });

            //重新加載 comments
            function loadComments(newsfeedId) {
                var commentsDiv = $('.newsfeed[data-id="' + newsfeedId + '"]').find('.comments');
                var commentform = $(this).siblings('.comment-form');
                $.ajax({
                    url: '/newsfeed/' + newsfeedId + '/comments',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        commentsDiv.html('');
                        $.each(response.comments, function(index, value){
                            commentsDiv.append('<div>' + value.content + '</div>');
                        });
                        commentsDiv.show();
                        commentform.show();
                        $('input[name=content]').val('');
                    }
                });
            }
        });
    </script>
</body>
</html>
