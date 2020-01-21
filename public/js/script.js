$(document).ready(function(){
    $('.sidenav').sidenav();
    $('select').formSelect();

    var sH = $(window).height();
    var login = $('.login').height();
    $('.login').css('transform','translateY(' + login/2 + 'px)');
});