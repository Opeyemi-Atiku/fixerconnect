@extends('layouts.layouts')

@section('title', $blog->title)
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/blog.css')}}" />
@section('content')
<section>
  <div class="block">
    <div class="container">
      <div class="blog-single">
        <div class="bs-thumb"><img src="https://admin.fixer-connect.vipcarportal.com/storage/storage/{{$blog->image}}" width="100%" height="300px" alt="" /></div>



        <div class="col-lg-8 offset-2">
          <ul class="post-metas"><li><a href="#" title=""><i class="la la-user"></i>{{$blog->author}}</a></li><li><a href="#" title=""><i class="la la-calendar-o"></i>{{$blog->created_at->diffForHumans()}}</a></li><li><a class="metascomment" href="#" title="">
            <i class="la la-comments"></i>{{count($comment)}} comments</a></li><li><a href="#" title=""><i class="la la-file-text"></i>{{$blog->tag}}</a></li></ul>
          <h2>{{$blog->title}}</h2>
          <p><pre><?php echo html_entity_decode($blog->body);?></pre></p>


          <div class="comment-sec">
            <h3>{{count($comment)}} Comments</h3>
            <ul>
              @if(count($comment) > 0)
              @foreach($comment as $comment_)
              <li>
                <div class="comment">
                  <div class="comment-avatar"> <img style="width: 40px; height: 40px;" src="/storage/storage/{{$comment_->profile_image}}" alt="" /> </div>
                  <div class="comment-detail">
                    <h3>{{$comment_->name}}</h3>
                    <div class="date-comment"><i class="la la-calendar-o"></i>{{$comment_->created_at->diffForHumans()}}</div>
                    <p>{{$comment_->comment}}</p>

                    @if(Auth::check())
                    <a id="view_reply_" comment_id="{{$comment_->id}}"> <i class="la la-comment"></i>View Reply&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a id="comment_reply" comment_id="{{$comment_->id}}"><i class="la la-reply"></i>Reply</a>

                    <div id="comment_reply_input_{{$comment_->id}}"  class="cfield comment_reply_input">

                      <div class="col-lg-7 col-md-6 col-sm-6 offset-1">
                        <span id="comment_reply_error_{{$comment_->id}}">
                        <input id="reply_comment_{{$comment_->id}}" comment="{{$comment_->id}}" type="text" placeholder="Reply Comment" />
                        <button comment="{{$comment_->id}}" id="reply_comment">Reply</button>
                      </div>

                    </div>
                    @endif
                  </div>

                </div>
                <ul class="comment-child" id="comment-child_{{$comment_->id}}">
                </ul>
              </li>
              @endforeach
              @else
              No comment
              @endif
            </ul>
          </div>

          @if(Auth::check())
          <div class="commentform-sec">
            <h3>Leave a Reply</h3>
            <form method="post" action="/blog/comment">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-lg-12">
                  <span class="pf-title">Description</span>
                  <div class="pf-field">
                    <input type="hidden" name="id" value="{{$blog->id}}" />

                    @if($errors->has('comment'))
                        <span style="color: #B22222;">
                            <strong>{{ $errors->first('comment') }}</strong>
                        </span>
                    @endif
                    <textarea name="comment"></textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <button type="submit">Post Comment</button>
                </div>
              </div>
            </form>
          </div>
          @endif


        </div>

      </div>
    </div>
  </div>
</section>



<script>
$(function(){

  /*
  * navigate
  */
  $('ul.comment-child').hide();
  $('div.comment_reply_input').hide();

  var show = 1;
  $('a#comment_reply').click(function(){

    var id = $(this).attr('comment_id');
    if(show == 1){
      $('div#comment_reply_input_'+id).show();
      $(this).html('<i class="la la-close"></i>CLose');
      show = 2;
    }else if(show == 2){
      $('div#comment_reply_input_'+id).hide();
      $(this).html('<i class="la la-reply"></i>Reply');
      show = 1;
    }
  });
  /*
  * navigate
  */

  /*
  * send reply to comment
  */
  $('button#reply_comment').click(function(){
    var id = $(this).attr('comment');
    var comment = $('input#reply_comment_'+id).val();
    $('input#reply_comment_'+id).val('');
    if(comment === ''){
      alert('reply field is required');
    }else{
      reply(id, comment)
    }
  });

  function reply(id, comment){
    $.ajax({
      type: 'post',
      url: '/comment_reply',
      credentials: 'same-origin',
      timeout: 100000,
      data : {
        id: id,
        comment: comment
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data){
        var vw = [];
        for(var dt = 0; dt < data.length; dt++){

          vw[dt] = '<li><div class="comment"><div class="comment-avatar"> <img style="width: 20px; height: 20px;" src="https://fixer-connect.vipcarportal.com/storage/storage/'+data[dt].profile_image+'" alt="" /> </div><div class="comment-detail"><h3>'+data[dt].name+'</h3><p>'+data[dt].comment+'</p></div></div></li>';

        }
        $('ul#comment-child_'+id).html(vw);
        $('ul#comment-child_'+id).show();
      },
      error: function(){
        alert('error occured');
      }
      });
  }
  /*
  * send reply to comment
  */


  /*
  * view reply to comment
  */
  var view_reply__ = 1;
  $('a#view_reply_').click(function(){
    var id = $(this).attr('comment_id');
    view_reply(id);
    if(view_reply__ == 1){
      $('ul#comment-child_'+id).show();
      view_reply__ = 2;
    }else{
      $('ul#comment-child_'+id).hide();
      view_reply__ = 1;
    }
  });

  function view_reply(id){
    $.ajax({
      type: 'post',
      url: '/view_reply',
      credentials: 'same-origin',
      timeout: 100000,
      data : {
        id: id,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data){
        var vw = [];
        for(var dt = 0; dt < data.length; dt++){

          vw[dt] = '<li><div class="comment"><div class="comment-avatar"> <img style="width: 40px; height: 40px;" src="https://fixer-connect.vipcarportal.com/storage/storage/'+data[dt].profile_image+'" alt="" /> </div><div class="comment-detail"><h3>'+data[dt].name+'</h3><p>'+data[dt].comment+'</p></div></div></li>';

        }
        $('ul#comment-child_'+id).html(vw);
      },
      error: function(){
        alert('error occured');
      }
      });
  }
  /*
  * view reply to comment
  */


});
</script>
@endsection
