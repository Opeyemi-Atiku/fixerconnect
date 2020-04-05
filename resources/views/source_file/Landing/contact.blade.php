@extends('layouts.layouts')

@section('title', 'Contact Us')
@section('content')
<section>
  <div class="block no-padding  gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="inner2">
            <div class="inner-title2">
              <h3>Contact</h3>
              <span>Lorem Ipsum</span>
            </div>
            <div class="page-breacrumbs">
              <ul class="breadcrumbs">
                <li><a href="#" title="">Home</a></li>
                <li><a href="#" title="">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="block">
    <div class="container">
       <div class="row">
        <div class="col-lg-6 column">
          <div class="contact-form">
            <h3>Keep In Touch
            @if(session('status'))
            <br/>
            <a class="post-job-btn" id="status__">{{session('status')}} <i class="fa fa-thumbs-up"></i></a>
            <br/>
            @endif</h3>
            <form method="post" action="/contact-us">
              {{csrf_field()}}
              <div class="row">
                <div class="col-lg-12">
                  <span class="pf-title">
                    Full Name
                    @if($errors->has('name'))
                      <span style="color: #B22222; float: right">
                        {{$errors->first('name')}}
                      </span>
                    @endif
                  </span>
                  <div class="pf-field">
                    <input type="text" name="name" placeholder="Full Name" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <span class="pf-title">
                    Email
                    @if($errors->has('email'))
                      <span style="color: #B22222; float: right">
                        {{$errors->first('email')}}
                      </span>
                    @endif
                  </span>
                  <div class="pf-field">
                    <input type="email" name="email" placeholder="E-mail Address" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <span class="pf-title">
                    Subject
                    @if($errors->has('subject'))
                      <span style="color: #B22222; float: right">
                        {{$errors->first('subject')}}
                      </span>
                    @endif
                  </span>
                  <div class="pf-field">
                    <input type="text" name="subject" placeholder="Subject" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <span class="pf-title">
                    Message
                    @if($errors->has('message'))
                      <span style="color: #B22222; float: right">
                        {{$errors->first('message')}}
                      </span>
                    @endif
                  </span>
                  <div class="pf-field">
                    <textarea name="message"></textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <button type="submit">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-6 column">
          <div class="contact-textinfo">
            <h3>Lorem Ipsum</h3>
            <ul>
              <li><i class="la la-map-marker"></i><span>Lorem Ipsum</span></li>
              <li><i class="la la-phone"></i><span>Lorem Ipsum</span></li>
              <li><i class="la la-fax"></i><span>Lorem Ipsum</span></li>
            </ul>
            <a class="fill" href="#" title="">Lorem Ipsum</a><a href="#" title="">Lorem Ipsum</a>
          </div>
        </div>
       </div>
    </div>
  </div>
</section>
<script>
$(function(){
  setTimeout(function(){
    $('#status__').hide('slow');
  }, 5000);
});
</script>
@endsection
