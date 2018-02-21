$(document).ready(function(){
    var scrollTop = 0;
    $(window).scroll(function(){
        scrollTop = $(window).scrollTop();
        $('.counter').html(scrollTop);
        if (scrollTop >= 100) {
            $('#nav').addClass('scrolled-nav');
            $('#navbar-brand').addClass('scrolled-navbar-brand');
            $('#navbar-brand-pic').addClass('scrolled-navbar-brand-pic');
            $('#navbar-toggler-icon').addClass('scrolled-navbar-toggler-icon');
            $('#user-dropdown').addClass('scrolled-user-dropdown');
            $('#profile-pic').addClass('scrolled-profile-pic');
            $('#btn-signUp').addClass('btn-sm');
            $('#btn-signIn').addClass('btn-sm');
        } else if (scrollTop < 100) {
            $('#nav').removeClass('scrolled-nav');
            $('#navbar-brand').removeClass('scrolled-navbar-brand');
            $('#navbar-brand-pic').removeClass('scrolled-navbar-brand-pic');
            $('#navbar-toggler-icon').removeClass('scrolled-navbar-toggler-icon');
            $('#user-dropdown').removeClass('scrolled-user-dropdown');
            $('#profile-pic').removeClass('scrolled-profile-pic');
            $('#btn-signUp').removeClass('btn-sm');
            $('#btn-signIn').removeClass('btn-sm');
        }
    });
});