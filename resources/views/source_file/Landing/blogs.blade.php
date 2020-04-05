@extends('layouts.layouts')
@section('title', 'Blog')
@section('content')
<section>
  <div class="block">
    <div class="container">
       <div class="row">
        <div class="col-lg-12">


          <div class="blog-sec">
            <div class="row" id="masonry">
              @if(count($blog) > 0)
              @foreach($blog as $blog_)
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="my-blog">
                  <div class="blog-thumb">
                    <a href="/blog/{{$blog_->id}}" title=""><img src="https://admin.fixer-connect.vipcarportal.com/storage/storage/{{$blog_->image}}" width="200px" height=200px"" /></a>
                    <div class="blog-metas">
                      <a href="/blog/{{$blog_->id}}" title="">{{$blog_->created_at->diffForHumans()}}</a>
                    </div>
                  </div>
                  <div class="blog-details">
                    <h3><a href="/blog/{{$blog_->id}}" title="">{{$blog_->title}}</a></h3>
                    <p>{{substr($blog_->body, '0', '20')}}</p>
                    <a href="/blog/{{$blog_->id}}" title="">Read More <i class="la la-long-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              @endforeach
              @else
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="my-blog">
                  <div class="blog-thumb">
                    <div class="blog-metas">
                    </div>
                  </div>
                  <div class="blog-details">
                    <h3><a>No Blog Post</a></h3>
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>



          <div class="pagination">
            <ul>
              @if($blog->currentPage() > 1)
                <li class="prev"><a href="{{$blog->previousPageUrl()}}"><i class="la la-long-arrow-left"></i> Prev</a></li>
              @endif
              @if($blog->currentPage() != $blog->lastPage() && $blog->lastPage() != 0)
              <li class="next"><a href="{{$blog->nextPageUrl()}}">Next <i class="la la-long-arrow-right"></i></a></li>
              @endif

            </ul>
          </div><!-- Pagination -->


        </div>
       </div>
    </div>
  </div>
</section>

@endsection
