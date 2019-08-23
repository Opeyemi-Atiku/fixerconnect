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
    }, 250);
  });

  /*
  * show details
  */
  $('a#details').click(function(){
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
    }, 250);
  });

  /*
  * show subscription
  */
  $('a#subscription').click(function(){
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
    }, 250);
  });

  /*
  * show message
  */
  $('a#message').click(function(){
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
    }, 250);
  });
});
