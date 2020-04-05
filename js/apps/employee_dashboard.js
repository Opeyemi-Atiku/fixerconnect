$(function(){
  /*
  * show hml entities
  */
  document.getElementsByTagName("html")[0].style.visibility = "visible";


  /*
  * main on load for dashboard
  */
  $('div#dashboard').show();
  $('div#details').hide();
  $('div#subscription').hide();
  $('div#message').hide();
  $('div#loader').hide();

  /*
  * show dashboard
  */
  $('a#dashboard').click(function(){
    $('#business').hasClass('active') == true ? $('#business').toggleClass('active closed') : false;
    $('#business').next().slideUp();
    $('#message').hasClass('active') == true ? $('#message').toggleClass('active closed') : false;
    $('#message').next().slideUp();
    $('#package').hasClass('active') == true ? $('#package').toggleClass('active closed') : false;
    $('#package').next().slideUp();
    $('div#dashboard').hide();
    $('div#details').hide();
    $('div#subscription').hide();
    $('div#message').hide();
    $('div#loader').show();
    setTimeout(function(){
      $('div#dashboard').show();
      $('div#details').hide();
      $('div#subscription').hide();
      $('div#message').hide();
      $('div#loader').hide();
    }, 500);
  });

  /*
  * show details
  */
  $('a#details').click(function(){
    $('#business').next().slideDown();
    $('#business').hasClass('active') == true ? false : $('#business').toggleClass('active closed');
    $('div#dashboard').hide();
    $('div#details').hide();
    $('div#subscription').hide();
    $('div#message').hide();
    $('div#loader').show();
    setTimeout(function(){
      $('div#dashboard').hide();
      $('div#details').show();
      $('div#subscription').hide();
      $('div#message').hide();
      $('div#loader').hide();
    }, 500);
  });

  /*
  * show subscription
  */
  $('a#subscription').click(function(){
    $('#package').next().slideDown();
    $('#package').hasClass('active') == true ? false : $('#package').toggleClass('active closed');
    $('div#dashboard').hide();
    $('div#details').hide();
    $('div#subscription').hide();
    $('div#message').hide();
    $('div#loader').show();
    setTimeout(function(){
      $('div#dashboard').hide();
      $('div#details').hide();
      $('div#subscription').show();
      $('div#message').hide();
      $('div#loader').hide();
    }, 500);
  });

  /*
  * show message
  */
  $('a#message').click(function(){
    $('#message').next().slideDown();
    $('#message').hasClass('active') == true ? false : $('#message').toggleClass('active closed');
    $('div#dashboard').hide();
    $('div#details').hide();
    $('div#subscription').hide();
    $('div#message').hide();
    $('div#loader').show();
    setTimeout(function(){
      $('div#dashboard').hide();
      $('div#details').hide();
      $('div#subscription').hide();
      $('div#message').show();
      $('div#loader').hide();
    }, 500);
  });
});
