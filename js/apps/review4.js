$(function(){
  $('#popup__').click(function(){
    name_review= $(this).attr('name');
    user_id_review = $(this).attr('user_id');
    $('#name_review').text(name_review);
  })
  $('#review__').click(function(){
    message_review = $('input#review').val();
    star_rating = $('input#whatever1').val();
    if(message_review == ''){
      $('#review_validation').html('<span style="color: #B22222;">*required</span>');
    }else{
      review();
    }
  });
  function review(){
    $.ajax({
      type: 'post',
      url: '/add_review',
      credentials: 'same-origin',
      timeout: 100000,
      data: {
        job_id: job_id,
        user_id_review: user_id_review,
        message_review: message_review,
        star_rating: star_rating
      },
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data){
        if(data == 'save'){
          alert('review submitted');
          window.location.reload(true)
        }else if(data == 'update'){
          alert('review updated');
          window.location.reload(true)
        }
      },
      error: function(){
        console.log('unknown error occured');
      }
    });

  }
});
