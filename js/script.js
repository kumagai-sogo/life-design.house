window.addEventListener( "scroll", function() {
  var headerElement = document.getElementById( "header" ) ;
  var rect = headerElement.getBoundingClientRect() ; 
  var y = rect.top + window.pageYOffset ;
  if (y > 0) {
    headerElement.classList.remove('menu_hidden'); 
  } else {
    headerElement.classList.add('menu_hidden');
  }
} ) ;

$('.burger-btn').on('click',function(){
  $('.burger-btn').toggleClass('close');
  $('.nav-wrapper').toggleClass('slide-in');
  $('body').toggleClass('noscroll');
});


jQuery(function() {
    var pagetop = $('#page_top');   
    pagetop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            pagetop.fadeIn();
        } else {
            pagetop.fadeOut();
        }
    });
  $('a[href^="#"]').click(function(){
    var time = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" ? 'html' : href);
    var distance = target.offset().top;
    $("html, body").animate({scrollTop:distance}, time, "swing");
    return false;
  });
});

/*ブラウザのリサイズ時にリロードする*/
// $(function(){
// var timer = false;
// $(window).resize(function() {
// if (timer !== false) {
// clearTimeout(timer);
// }
// timer = setTimeout(function() {
// //リロードする
// location.reload();
// }, 200);
// });
// });