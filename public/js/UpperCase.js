$(document).ready( function () {
    $(".UpperCase").on("keypress", function () {
     $input=$(this);
     setTimeout(function () {
      $input.val($input.val().toUpperCase());
     },50);
    })
   })