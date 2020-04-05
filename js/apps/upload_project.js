$(function(){
  var job_title, trade_type, budget_to, budget_from, job_description, job_media;
  var job_address = '';
  var job_street_number, job_latitude, job_longitude;
  var validate;

  $('#job_title').keypress(function(){
    $('#job_title_').html('Job Title');
  });
  $('#trade_type').change(function(){
    $('#trade_type_').html('Trade');
  });
  $('#budget_to').keypress(function(){
    $('#budget_from_').html('Budget Range')
  });
  $('#budget_from').keypress(function(){
    $('#budget_from_').html('Budget Range')
  });
  $('#job_description').keypress(function(){
    $('#job_description_').html('Description')
  });
  $('#job_address').keypress(function(){
    $('#job_address_').html('Find On Map')
  });

  /*
  * resize input to and from height span
  */
  if ($(window).width() > 700){
    $('#budget_to_').height($('#budget_from_').height());
  }else{
    $('#budget_to_').css('margin-top', '-25px');
  }

  /*
  * upload
  */

  /*
  *location
  */
  $('#search_location').click(function(){
    $('#loading_map').show();
    job_address = $('#job_address').val()
    if(job_address != ''){
      $.ajax({
          type: 'get',
          url: 'https://maps.googleapis.com/maps/api/geocode/json?address='+job_street_number+'+'+job_address+'&key=AIzaSyAkwr5rmzY9btU08sQlU9N0qfmo8YmE91Y',
          credentials: 'same-origin',
          timeout: 100000,
          success: function(data){
            if(data.status == 'OK'){

              job_latitude = data.results[0].geometry.location.lat;
              latitude = job_latitude;
              job_longitude = data.results[0].geometry.location.lng;
              longitude = job_longitude;
              job_address = data.results[0].formatted_address;
              addressFound = job_address;
              showMap = 2;
              loadMap();
              setTimeout(function(){
                $('#loading_map').hide();
                $('#googleMap').show();
              }, 700);
            }else{
              $('#job_address_').html('Find On Map <span style="color: #B22222;">*enter a valid location</span>');
              setTimeout(function(){
                $('#loading_map').hide();
              }, 500);
            }
          },
          error: function(){
            $('#loading_map').hide();
            alert('Unkown error occured, Retry');
          }
      });
    }else{
      $('#job_address_').html('Find On Map <span style="color: #B22222;">*enter a valid location</span>');
      setTimeout(function(){
        $('#loading_map').hide();
      }, 500);
    }
  });
  /**
  *get the file to be upload
  */
  $('#file-upload').change(function(){
    $('#job_media_').html('Upload Media')
    readImgUrlAndPreview(this);
    function readImgUrlAndPreview(input){
      if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
          job_media = new FormData();
          job_media.append('job_media', $('#file-upload')[0].files[0]);
        }
      }
      reader.readAsDataURL(input.files[0]);
    }
  });


  $('#upload').click(function(){
    job_title = $('#job_title').val();
    trade_type = $('#trade_type').val();
    budget_to = $('#budget_to').val();
    budget_from = $('#budget_from').val();
    job_description = $('#job_description').val();
    //job_address = $('#job_address').val();
    validate = validation();
    if(validate == false){
      validate_input();
    }else{
      upload();
    }

  });

  /*
  * validation
  */
  function validation(){
    if(job_title == '' || trade_type == null || budget_to == null || budget_from == null || job_description == '' || job_address == '' || parseInt(budget_from) > parseInt(budget_to) || job_media == null){
      
      return false;
    }else{
      return true;
    }
  }

  /*
  * validate input
  */
  function validate_input(){
    job_title == '' ? $('#job_title_').html('Job Title <span style="color: #B22222;">*required</span>') : $('#job_title_').html('Job Title');
    trade_type == null ? $('#trade_type_').html('Trade <span style="color: #B22222;">*required</span>') : $('trade_type_').html('Trade');
    budget_from == '' || budget_to == '' || parseInt(budget_from) > parseInt(budget_to) ? $('#budget_from_').html('Budget Range <span style="color: #B22222;">*invalid</span>') : $('#budget_from_').html('Budget Range');
    job_description == '' ? $('#job_description_').html('Description <span style="color: #B22222;">*required</span>') : $('#job_description_').html('Description');
    job_address == '' ? $('#job_address_').html('Find On Map <span style="color: #B22222;">*enter a valid location</span>') : $('#job_address_').html('Find On Map');
    job_latitude == null ? $('#job_address_').html('Find On Map <span style="color: #B22222;">*enter a valid location</span>') : $('#job_address_').html('Find On Map');
    job_longitude == null ? $('#job_address_').html('Find On Map <span style="color: #B22222;">*enter a valid location</span>') : $('#job_address_').html('Find On Map');
    job_media == null ? $('#job_media_').html('Upload Media <span style="color: #B22222;">*required</span>') : $('#job_media_').html('Upload Media');
  }

  /* upload ajax
  *
  */
  function upload(){
    window.location = '#post_job';
    $('#post').hide();
    $('#post_step').show();
    $('#loading').show();
    $('#information_step').addClass('step');
    $('#processing_step').addClass('step active');
    $('#done_step').addClass('step');

    job_media.append('job_title', job_title);
    job_media.append('trade_type', trade_type);
    job_media.append('budget_to', budget_to);
    job_media.append('budget_from', budget_from);
    job_media.append('job_description', job_description);
    job_media.append('job_address', job_address);
    job_media.append('job_latitude', job_latitude);
    job_media.append('job_longitude', job_longitude);

    $.ajax({
      type: 'post',
      url: "/upload_job/"+account,
      credentials: 'same-origin',
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
      data: job_media,
      timeout: 100000,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data){
        if(data == 'save'){
          setTimeout(function(){
            $('#post').hide();
            $('#loading').hide();
            $('#information_step').addClass('step active');
            $('#processing_step').addClass('step active');
            $('#done_step').addClass('step active');
          }, 1200);
            setTimeout(function(){
              window.location.href = location_redirect;
            }, 2000);
        }else if(data == 'error'){
          alert('error occured');
          setTimeout(function(){
            $('#post').show();
            $('#loading').hide();
            $('#information_step').addClass('step active');
            $('#processing_step').removeClass('active');
            $('#done_step').removeClass('active');
          }, 1200);
        }
      },
      error: function(){
        alert('unknown error occured');
        setTimeout(function(){
          $('#post').show();
          $('#loading').hide();
          $('#information_step').addClass('step active');
          $('#processing_step').removeClass('active');
          $('#done_step').removeClass('active');
        }, 1200);
      }
    });
  }
  /*
  * upload
  */

  /*
  * navigation
  */
  var post_hide = 1;
  $('#post').hide();
  $('#post_step').hide();
  $('table#project').show();
  $('#project_navigation').show();
  $('#loading').hide();
  $('#loading_map').hide();
  $('#googleMap').hide();
  $('#post_job').click(function(){
    if(post_hide == 1){
      $('#post').show();
      $('#post_step').show();
      $('table#project').hide();
      $('#project_navigation').hide();
      $('#accepted').text('Post Job');
      $('#pending').text('Post Job');
      $(this).text('Back');
      post_hide = 2;
    }else if(post_hide == 2){
      $('#post').hide();
      $('#post_step').hide();
      $('table#project').show();
      $('#project_navigation').show();
      $('#accepted').text('Accepted Project');
      $('#pending').text('Pending Project');
      post_hide = 1;
      $(this).text('Back');
      $(this).text('Post Job');
    }
  });
  /*
  * navigation
  */
});
