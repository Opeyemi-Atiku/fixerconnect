$(function(){
  $('#loading__').hide();
  $('#map_before').show();
  $('#map_after').hide();

  $('i#search__').click(function(){
    $('#search_form').submit();
  });

  var typingTimer;
  var search_input
  var doneTypingInterval = 4000;

  $('#location').keyup(function(){
    clearTimeout(typingTimer);
    if($(this).val() != ''){
      search_input = $(this).val();
      typingTimer = setTimeout(searchInput, doneTypingInterval);
    }
  });
  function searchInput(){
    $('#loading__').show();
    $('#map_before').hide();
    $('#map_after').hide();

    $.ajax({
        type: 'get',
        url: 'https://maps.googleapis.com/maps/api/geocode/json?address='+search_input+'&key=AIzaSyAkwr5rmzY9btU08sQlU9N0qfmo8YmE91Y',
        credentials: 'same-origin',
        timeout: 100000,
        success: function(data){
          if(data.status == 'OK'){

            latitude = data.results[0].geometry.location.lat;
            longitude = data.results[0].geometry.location.lng;

            $('input#latitude').val(latitude);
            $('input#longitude').val(longitude);

            setTimeout(function(){
              $('#loading__').hide();
              $('#map_before').hide();
              $('#map_after').show();
            }, 1000);
          }else{
            alert('location not found');
            setTimeout(function(){
              $('#loading__').hide();
              $('#map_before').show();
              $('#map_after').hide();
            }, 500);
          }
        },
        error: function(){
          $('#loading__').hide();
          $('#map_before').show();
          $('#map_after').hide();
          alert('Unkown error occured, Retry');
        }
    });
  }

});
