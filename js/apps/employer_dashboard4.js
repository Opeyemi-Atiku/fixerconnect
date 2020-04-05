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
    $('#business').hasClass('active') == true ? $('#business').toggleClass('active closed') : false;
    $('#business').next().slideUp();
    $('#message').hasClass('active') == true ? $('#message').toggleClass('active closed') : false;
    $('#message').next().slideUp();
    $('#project').hasClass('active') == true ? $('#project').toggleClass('active closed') : false;
    $('#project').next().slideUp();
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
    }, 500);
  });

  /*
  * show business
  */
  $('a#business').click(function(){
    $('#business').next().slideDown();
    $('#business').hasClass('active') == true ? false : $('#business').toggleClass('active closed');
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
    }, 500);
  });

  /*
  * show project
  */
  $('a#project').click(function(){
    $('#project').next().slideDown();
    $('#project').hasClass('active') == true ? false : $('#project').toggleClass('active closed');
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
    }, 500);
  });

  /*
  * show message
  */
  $('a#message').click(function(){
    $('#message').next().slideDown();
    $('#message').hasClass('active') == true ? false : $('#message').toggleClass('active closed');
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
    }, 500);
  });
});
