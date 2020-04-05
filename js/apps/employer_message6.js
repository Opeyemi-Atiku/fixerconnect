$(function(){
  /*
  * chat and app navigation
  */
  $('section#app').show();
  $('section#chat').hide();
  $('section#loading').hide();

  $('#choose_yes').hide();
  $('#choose_no').hide();


  $('div#message').click(function(){
    $('section#app').hide();
    $('section#loading').show();

    user_id = $(this).attr('user_id');

    fetchNewMessageOnLoad();
    fetchContactOnLoad();
    startChats();

    setTimeout(function(){
      $('section#app').hide();
      $('section#chat').show();
      $('section#loading').hide();
    }, 2500);
  });

  $('#newMessageChat').hide();
  $('#newMessageChat').click(function(){
    popUpNew = 0;
    $(this).hide();
    setTimeout(function(){
      $('#front').scrollTop($('#front')[0].scrollHeight);
    }, 900);
  });
  $('.msg_history').scroll(function(){
    popUpNew = 1;
  });
  /*
  * chat and app navigation
  */



  /*
  * contact selected from recent chat
  */
  var name = '';
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
    name = $('#name'+user_id).text();
    var image = $('#image'+user_id).attr('src');

    user_id = user_id_;

    //update current user selected
    $('#currentName').text(name);
    $('#currentImage').attr('src', image);

    previous_id = user_id_;

    fetchNewMessageOnLoad();
  });
  /*
  * contact selected from recent chat
  */

  /*
  * fetch contact
  */
  function fetchContactOnLoad(){
    $.ajax({
      type: 'get',
      url: '/chat/viewContact',
      credentials: 'same-origin',
      timeout: 100000,
      data: {
        job_id: job_id
      },
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
          var recent_message = '';
          if(data[unique_contact].message == null){
            recent_message = '';
          }else{
            recent_message = data[unique_contact].message;
          }
          if(data[unique_contact].price !== 0){
            
            contact_display[unique_contact] = '<div class="chat_list" id='+data[unique_contact].contact_id+' user_id='+data[unique_contact].contact_id+'><div class="chat_people" id='+data[unique_contact].contact_id+'><div class="chat_img"> <img class="chat_image img-thumbnail rounded-circle" id="image'+data[unique_contact].contact_id+'" src="/storage/storage/'+data[unique_contact].profile_image+'"> </div><div class="chat_ib"><h5><div id="name'+data[unique_contact].contact_id+'">'+data[unique_contact].name+'</div></h5><p>$'+data[unique_contact].price+'</p></div></div></div>';
            
          }else{
            contact_display[unique_contact] = '<div class="chat_list" id='+data[unique_contact].contact_id+' user_id='+data[unique_contact].contact_id+'><div class="chat_people" id='+data[unique_contact].contact_id+'><div class="chat_img"> <img class="chat_image img-thumbnail rounded-circle" id="image'+data[unique_contact].contact_id+'" src="/storage/storage/'+data[unique_contact].profile_image+'"> </div><div class="chat_ib"><h5><div id="name'+data[unique_contact].contact_id+'">'+data[unique_contact].name+'</div></h5><p>invitation</p></div></div></div>';
            
          }
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
  * fetch new message first
  */
  function fetchNewMessageOnLoad(){
    /*
    * request for new message
    */
    $.ajax({
      type: 'post',
      url: '/chat/viewMessage',
      credentials: 'same-origin',
      timeout: 100000,
      data: {
        user_id: user_id,
        job_id: job_id
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
        if(user_fetch['status'] != 6){          
        $('#currentName').text(user_fetch['name']+'($'+user_fetch['price']+')');
        }else{
          $('#currentName').text(user_fetch['name']);
        }
        name = user_fetch['name'];

        if(user_fetch['status'] == 1){
          $('#job_status').text('Hire');
        }else if(user_fetch['status'] == 2){
          $('#job_status').text('Waiting For Acceptance');
        }else if(user_fetch['status'] == 3){
          $('#job_status').text('Release Payment');
        }else if(user_fetch['status'] == 4){
          $('#job_status').text('Paid');
        }else if(user_fetch['status'] == 5){
          $('#job_status').text('Decline');
        }else if(user_fetch['status'] == 6){
          $('#job_status').text('Invite')
        }

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
            setTimeout(function(){
              $('#front').scrollTop($('#front')[0].scrollHeight);
            }, 900);
          }
        }

        if(popUpNew == 2){
          setTimeout(function(){
            $('#front').scrollTop($('#front')[0].scrollHeight);
          }, 3000);
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

  $(document).keypress(function(e){
    if(e.which == 13){
      let message = $('input#message').val();

      if(message != ''){
        $('input#message').val('');
        sendMessage(message)
      }
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
  function startChats(){
    setInterval(fetchNewMessageOnLoad, 2500);
    setInterval(fetchContactOnLoad, 2500);
  }

  /*
  * hired, release Payment
  */
  $('#job_status').click(function(){
    var status = $('#job_status').text();

    if(status == 'Release Payment'){
      $('#choose_yes').show();
      $('#choose_no').show();
      $('#hired_status').hide();
    }else if(status == 'Paid'){
      alert('Payment Released');
    }else if(status == 'Waiting For Acceptance'){
      alert('Waiting for '+name+' to accept');
    }else{
      hired();
    }
  });

  $('#choose_yes').click(function(){
    hired();
  });

  $('#choose_no').click(function(){
    $('#choose_yes').hide();
    $('#choose_no').hide();
    $('#hired_status').show();
  });

  function hired(){
    $.ajax({
      type: 'get',
      url: '/chat/hired',
      credentials: 'same-origin',
      timeout: 100000,
      data: {
        job_id: job_id,
        user_id: user_id
      },
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data){
        if(data == 1){
          $('#job_status').text('Hire');
        }else if(data == 2){
          $('#job_status').text('Waiting For Acceptance');
        }else if(data == 3){
          $('#job_status').text('Release Payment');
        }else if(data == 4){
          $('#job_status').text('Paid');
        }else if(data == 'error'){
          alert('Internal Server Error retry again later');
          $('#job_status').text('Release Payment');
        }else if(data == 'low'){
          alert('insufficient Balance');
          $('#job_status').text('Release Payment');
          window.location.href = "/transaction/"+transact_account_;
        }else if(data == 5){
          alert('Offer Declined');
          $('#job_status').text('Decline');
        }else if(data == 6){
          $('#job_status').text('Invite');
        }

        $('#choose_yes').hide();
        $('#choose_no').hide();
        $('#hired_status').show();
      },
      error: function(){
        console.log('unknown error occured');
      }
    });
  }
  /*
  * hired, release Payment
  */

});
