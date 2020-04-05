$(function(){
  $('#loading').hide();
  $('#map').show();
  /*
  *profile image
  */
  $('#profile_image').change(function(){
    readImgUrlAndPreview(this);
    function readImgUrlAndPreview(input){
      if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
          $('#set_profile_image').attr('src', loading);
          let files = new FormData();
          files.append('profile_image', $('#profile_image')[0].files[0]);
          console.log(files);
          $.ajax({
            type: 'post',
            url: "/upload_profile_picture",
            credentials: 'same-origin',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            data: files,
            timeout: 100000,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
              if(data == 'save'){
                console.log('save');
                setTimeout(function(){
                  $('#set_profile_image').attr('src', e.target.result);
                }, 500);
              }else{
                console.log('error');
                setTimeout(function(){
                  $('#set_profile_image').attr('src', "<?php echo $profile_image_source;?>");
                }, 500);
              }
            },
            error: function(){
              console.log('unknown error occured');
              setTimeout(function(){
                $('#set_profile_image').attr('src', "<?php echo $profile_image_source;?>");
              }, 500);
            }
          });


        }
      }
      reader.readAsDataURL(input.files[0]);
    }
  });
  /*
  * profile pics
  */

  /*
  * location
  */
  $('a#search').click(function(){
    $('a#search').text('Searching');
    $('#loading').show();
    $('#map').hide();
    var address = $('#address').val();
    var streetNumber = $('#streetNumber').val();
    var act_update_map = 1;
    $.ajax({
        type: 'get',
        url: 'https://maps.googleapis.com/maps/api/geocode/json?address='+streetNumber+'+'+address+'&key=AIzaSyAkwr5rmzY9btU08sQlU9N0qfmo8YmE91Y',
        credentials: 'same-origin',
        timeout: 100000,
        success: function(data){
          if(data.status == 'OK'){
            $('a#search').text('Valid address');
            latitude = data.results[0].geometry.location.lat;
            longitude = data.results[0].geometry.location.lng;
            addressFound = data.results[0].formatted_address;
            console.log(latitude+' '+longitude+' '+addressFound);
            showMap = 2;
            loadMap();
            setTimeout(function(){
              $('#loading').hide();
              $('#map').show();
            }, 700);
            act_update_map = 1;
          }else{
            $('a#search').text('Invalid Adddres');
            setTimeout(function(){
              $('#loading').hide();
              $('#map').show();
            }, 700);
            alert('Invalid address');
            act_update_map = 2;
          }
        },
        error: function(){
          $('a#search').text('Retry');
          setTimeout(function(){
            $('a#search').text('Search Location');
            $('#loading').hide();
            $('#map').show();
          }, 700);
          alert('Unkown error occured');
        },
        /*
        * update location
        */
        complete: function(){
          if(act_update_map == 1){
            $.ajax({
                type: 'get',
                url: '/update_location',
                credentials: 'same-origin',
                data: {
                  latitude: latitude,
                  longitude: longitude,
                  address: address
                },
                timeout: 100000,
                success: function(data){
                  if(data == 'save'){
                    $('a#search').text('Saved');
                    setTimeout(function(){
                      $('a#search').text('Search Location');
                    }, 1500);
                  }else{
                    $('a#search').text('Error');
                    setTimeout(function(){
                      $('a#search').text('Search Location');
                    }, 1500);
                  }

                },
                error: function(){
                  alert('Unkown error occured');
                },
              });
          }
        }
    });
  });
  /*
  * location
  */


  /*
  * profile info
  */
  $('#fullname').keypress(function(){
    $('#fullname_').text('Full Name');
  });
  $('#phone').keypress(function(){
    $('#phone_').text('Phone');
  });
  $('#description').keypress(function(){
    $('#description_').text('About');
  });
  //profile
  $('#update').click(function(){
    var fullname = $('#fullname').val();
    var trade_type = $('#trade_type').val();
    var phone = $('#phone').val();
    var description = $('#description').val();
    var act = 1;
    if(fullname == '' || isNaN(phone) || phone == '' || description == ''){
      act = 2;
      if(fullname == ''){
        $('#fullname_').html('Full Name <span style="color: #B22222;">*required</span>');
      }
      if(description == ''){
        $('#description_').html('About <span style="color: #B22222;">*required</span>');
      }
      if(phone == '' || isNaN(phone)){
        $('#phone_').html('Phone <span style="color: #B22222;">*required</span>');
      }
    }
    if(act == 1){
      $.ajax({
          type: 'get',
          url: '/update_profile',
          credentials: 'same-origin',
          data: {
            fullname: fullname,
            phone: phone,
            description: description
          },
          timeout: 100000,
          success: function(data){
            if(data == 'save'){
              $('#update').text('Saved');
              setTimeout(function(){
                $('#update').text('Update');
              }, 1500);
            }else{
              $('#update').text('Error');
              setTimeout(function(){
                $('#update').text('Update');
              }, 1500);
            }

          },
          error: function(){
            alert('Unkown error occured');
          },
        });
    }
  });
  /*
  * profile info
  */
});
