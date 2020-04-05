$(function(){
  $('#newMessageChat').hide();
  setInterval(fetchContactOnLoad, 2500);

  /*
  * fetch contact
  */
  function fetchContactOnLoad(){
    $.ajax({
      type: 'get',
      url: '/chat/inboxContact',
      credentials: 'same-origin',
      timeout: 100000,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data){
        var contact_display = [];
        var contact_lenght = data.length;
        var count_contact = contact_lenght - 1;
        var unique_contact = 0;


        //total_contact = contact_lenght;
        for(var contact_display_ = count_contact; contact_display_ >= 0; contact_display_--){
          if(data[unique_contact].message == null){
            var recent_message = '';
            recent_message = '';
          }else{
            recent_message = data[unique_contact].message;
          }
          contact_display[unique_contact] = '<div class="chat_list" job_id='+data[unique_contact].job_id+' id='+data[unique_contact].contact_user_id+' user_id='+data[unique_contact].contact_user_id+'><div class="chat_people" id='+data[unique_contact].contact_user_id+'><div class="chat_img"> <img class="chat_image img-thumbnail rounded-circle id="image'+data[unique_contact].contact_user_id+'" src="/storage/storage/'+data[unique_contact].profile_image+'"> </div><div class="chat_ib"><h5><div id="name'+data[unique_contact].contact_user_id+'">'+data[unique_contact].name+'</div></h5><p>'+recent_message+'</p></div></div></div>';
          unique_contact++;
        }

        //new view for html
        $('div#contactList').html(contact_display);

      },
      error: function(){
        console.log('unknown error occured');
      }
    });
  }
  /*
  * fetch contact
  */

  /*
  * contact selected from recent chat
  */
  $('#contactList').on('click', '.chat_list',function(e){
    e.preventDefault();

    //clean out previous contact active
    if(previous_id != null){
      /*$("div#"+previous_id).toggleClass('chat_list');**/
      $('div#'+previous_id).css('background-color', '');
      $('div#name'+previous_id).css('color', '');
    }

    //get current user_id
    var user_id_ = $(this).attr('user_id');

    //make new contact active
    /*$("div#"+user_id_).addClass('chat_list active_chat');*/
    $('#'+user_id_).css('background-color', '#00A0DC');
    $('#name'+user_id_).css('color', 'white');

    //get current user selected
    var name = $('#name'+user_id).text();
    var image = $('#image'+user_id).attr('src');

    user_id = user_id_;
    job_id = $(this).attr('job_id');

    //update current user selected
    $('#currentName').text(name);
    $('#currentImage').attr('src', image);

    previous_id = user_id_;

    setInterval(fetchNewMessageOnLoad, 2500);;
  });
  /*
  * contact selected from recent chat
  */

  /*
  * fetch new message first
  */
  function fetchNewMessageOnLoad(){
    /*
    * request for new message
    */
    $.ajax({
      type: 'post',
      url: '/chat/inboxMessage',
      credentials: 'same-origin',
      timeout: 100000,
      data: {
        user_id: user_id,
      },
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data){
        let message_fetch = data[1];
        user_fetch = data[0];

        //update current user
        var src = '/storage/storage/'+user_fetch['profile_image'];
        $('#currentImage').attr('src', src);
        $('#currentName').text(user_fetch['name']);


        total_message_fetch = message_fetch.length;
        let message_display = [];
        let count_message = message_fetch.length - 1;
        let unique_message = 0;
        let inbox_message_count = 0;

        for(var message_display_ = count_message; message_display_ >= 0 ; message_display_--){
          if(message_fetch[message_display_].sender_id != auth_user){
            inbox_message_count++;
            message_display[unique_message] = '<div class="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>'+message_fetch[message_display_].message+'</p><span class="time_date">'+message_fetch[message_display_].last_seen+'</span></div></div></div>';
          }else{
            message_display[unique_message] = '<div class="outgoing_msg"><div class="sent_msg"><p>'+message_fetch[message_display_].message+'</p><span class="time_date">'+message_fetch[message_display_].last_seen+'</span></div></div>';
          }
          unique_message++;
        }

        /*
        * display message
        */
        var view = $('div#front').html(message_display);
        if(inbox_message_count_ < inbox_message_count){
          /*
          * scrollTop execucte if 2 or 0 if message not scroll and if scroll and new message enter it should display new message enter
          */
          if(popUpNew == 1){
            $('#newMessageChat').show();
          }else if(popUpNew == 0){
            $('#front').scrollTop($('#front')[0].scrollHeight);
          }
        }

        if(popUpNew == 2){
          setTimeout(function(){
            $('#front').scrollTop($('#front')[0].scrollHeight);
          }, 900);
        }
        popUpNew = 0;
        /*
        * scrollTop execucte if 2 or 0 if message not scroll and if scroll and new message enter it should display new message enter
        */

        inbox_message_count_ = inbox_message_count;

      },
      error: function(){
        console.log('unknown error occured');
      }
    });
  }
  /*
  * fetch new message first
  */

  /*
  * send message
  */
  $('#sendMessage').click(function(){
    let message = $('input#message').val();

    if(message != ''){
      $('input#message').val('');
      sendMessage(message)
    }
  });
  /*
  * send message
  */

  /*
  * send message ajax
  */
  function sendMessage(message){
    $.ajax({
      type: 'post',
      url: '/chat/sendMessage',
      credentials: 'same-origin',
      timeout: 100000,
      data: {
        message: message,
        user_id: user_id,
        job_id: job_id
      },
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data){

        let message_fetch = data[1];
        user_fetch = data[0]
        total_message_fetch = message_fetch.length;
        let message_display = [];
        let count_message = message_fetch.length - 1;
        let unique_message = 0;


        for(var message_display_ = count_message; message_display_ >= 0; message_display_--){
          if(message_fetch[message_display_].sender_id != auth_user){
            message_display[unique_message] = '<div class="incoming_msg"><div class="received_msg"><div class="received_withd_msg"><p>'+message_fetch[message_display_].message+'</p><span class="time_date">'+message_fetch[message_display_].last_seen+'</span></div></div></div>';
          }else{
            message_display[unique_message] = '<div class="outgoing_msg"><div class="sent_msg"><p>'+message_fetch[message_display_].message+'</p><span class="time_date">'+message_fetch[message_display_].last_seen+'</span></div></div>';
          }
          unique_message++;
        }
        $('div#front').html(message_display);
        $('#front').scrollTop($('#front')[0].scrollHeight);

      },
      error: function(){
        alert('message not sent, check your connection');
      }
    });
  }
  /*
  * send message ajax
  */

});
