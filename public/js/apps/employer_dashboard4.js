$(function(){

  /*
  * show hml entities
  */
  document.getElementsByTagName("html")[0].style.visibility = "visible";

  /*
  * main on load for dashboard
  */
  $('div#dashboard').show();
  $('div#business').hide();
  $('div#project').hide();
  $('div#message').hide();
  $('div#loader').hide();

  /*
  * show dashboard
  */
  $('a#dashboard').click(function(){
    $('div#loader').show();
    $('div#dashboard').hide();
    $('div#business').hide();
    $('div#project').hide();
    $('div#message').hide();
    setTimeout(function(){
      $('div#loader').hide();
      $('div#dashboard').show();
      $('div#business').hide();
      $('div#project').hide();
      $('div#message').hide();
    }, 250);
  });

  /*
  * show business
  */
  $('a#business').click(function(){
    $('div#loader').show();
    $('div#dashboard').hide();
    $('div#business').hide();
    $('div#project').hide();
    $('div#message').hide();
    setTimeout(function(){
      $('div#loader').hide();
      $('div#dashboard').hide();
      $('div#business').show();
      $('div#project').hide();
      $('div#message').hide();
    }, 250);
  });

  /*
  * show project
  */
  $('a#project').click(function(){
    $('div#loader').show();
    $('div#dashboard').hide();
    $('div#business').hide();
    $('div#project').hide();
    $('div#message').hide();
    setTimeout(function(){
      $('div#loader').hide();
      $('div#dashboard').hide();
      $('div#business').hide();
      $('div#project').show();
      $('div#message').hide();
    }, 250);
  });

  /*
  * show message
  */
  $('a#message').click(function(){
    $('div#loader').show();
    $('div#dashboard').hide();
    $('div#business').hide();
    $('div#project').hide();
    $('div#message').hide();
    setTimeout(function(){
      $('div#loader').hide();
      $('div#dashboard').hide();
      $('div#business').hide();
      $('div#project').hide();
      $('div#message').show();
    }, 250);
  });
});
