@extends('layouts.layouts')

@section('content')

<!--Title-->
@include('source_file.Dashboard.Employee.inc.title_bar')
<!--Title-->
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/apps/chat_and_job_navigation.css')}}" />

<section>
  <div class="block no-padding">
    <div class="container">
       <div class="row no-gape">
         <!--Menu-->
        <!--Menu-->

        <!--App-->
        <div class="col-lg-12 column">
          <div class="padding-left">
            <!--ChatApp-->
            <div id="chat">
              <div class="container">
                <div class="messaging">
                  <div class="inbox_msg">
                    <div class="inbox_people">
                      <div class="headind_srch">
                        <div class="recent_heading">
                          <h4>Recent</h4>
                        </div>
                      </div>
                      <div class="inbox_chat" id="contactList">

                      </div>
                    </div>
                    <div class="mesgs">
                      <div class="t-center" id="newMessageChat"><button class="button button--small button--primary"><span style="color:white;">view new message</span></button></div>
                      <div id="current"><a id="currentUserLink" href="/user_"><img class="img-thumbnail rounded-circle chat_image" src="/storage/storage/profile_image.png" id="currentImage" height="50px" width="50px"><h5 id="currentName"></h5></a>
                      </div>

                      <div class="msg_history">
                        <div id="front" class="frontMessageView">

                        </div>
                        <div class="type_msg">
                          <div class="input_msg_write">
                            <input type="text" class="write_msg" placeholder="Type a message" id="message" />
                            <button  id="sendMessage" msg="message" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" style="margin-left: -10px;" aria-hidden="true"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--ChatApp-->
          </div>
        </div>
        <!--App-->

       </div>
    </div>
  </div>
</section>
<script>
var total_message_fetch;
var auth_user = <?php echo Auth::id();?>;
var inbox_message_count_;
var user_fetch;
var user_id;
var total_contact = 0;
var previous_id;
var popUpNew = 2;
var job_id;
</script>
<script src="{{URL::asset('js/apps/employee_message.js')}}" type="text/javascript"></script>
@endsection
