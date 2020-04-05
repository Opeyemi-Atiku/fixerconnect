$(function(){
  /*
  * bid navigation
  */
  $('#applyForm').hide();
  $('#loading').hide();
  var showBid = 1;
  $('#apply').click(function(){
    if(showBid == 1){
      $('#applyForm').show();
      showBid = 2;
    }else if(showBid == 2){
      $('#applyForm').hide();
      showBid = 1;
    }
  });
  $('#applied').click(function(){
    alert('Already applied');
  });
  /*
  * bid navigation
  */

  /*
  * submit and validate
  */
  $('#bidSubmit').click(function(){
    var price = $('#bid').val();

    if(isNaN(price)){
      $('#validation').html('<span style="color: #B22222;">*Number is required</span>');
    }else if(price == ''){
      $('#validation').html('<span style="color: #B22222;">*required</span>');
    }else{
      $('#applyForm').hide();
      $('#loading').show();
      /*
      * submit bid price
      */
      $.ajax({
          type: 'get',
          url: '/bid',
          credentials: 'same-origin',
          data: {
            job_id: job_id,
            price: price
          },
          timeout: 100000,
          success: function(data){
            if(data == 'save'){
              window.location.reload(true);
            }else{
              setTimeout(function(){
                $('#applyForm').show();
                $('#loading').hide();
                $('#validation').html('<span style="color: #B22222;">*error occured</span>');
              }, 700);
            }
          },
          error: function(){
            setTimeout(function(){
              $('#applyForm').show();
              $('#loading').hide();
              $('#validation').html('<span style="color: #B22222;">*Unkown error occured</span>');
            }, 700);
          },
        });
    }
  });
  $('#bid').keypress(function(){
    $('#validation').html('');
  });
  /*
  * submit and validate
  */

});
