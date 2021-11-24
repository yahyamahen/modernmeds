$(function() {
   var ulLi = $('nav ul > li'),
       fa = $('nav ul > li:last-of-type a .fa');
   
    $('nav ul').append('<ol></ol>');
   
    $('nav').each(function() {
      for (var i=0; i <= ulLi.length - 3; i++) {
        $('nav ul > ol').append("<li>"+ i +"</li>");
        $('nav ul > ol > li').eq(i).html(ulLi.eq(i+1).html());
      }
   });
 
   $('nav ul > li:last-of-type').on('click', function() {
     fa.toggleClass('fa-bars');
     fa.toggleClass('fa-times');
     $(this).parent().children('ol').slideToggle(500);
   });
 });
 
 // Em An
 // 10/10/2016
 // https://codepen.io/anon/pen/qaoxyA  
 // https://codepen.io/Em-An/pen/LRdjwp