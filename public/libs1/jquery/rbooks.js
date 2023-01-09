$(function() {
    $('.user-hi').hover(function() {
        $('.login-user').removeAttr('display');
        $('.login-user').css({
            display: 'block',
        });
    });

    $('.login-user').on('mouseleave', function() {
        $('.login-user').removeAttr('style');
    });

    $('.open-popup-link').magnificPopup({
	  type:'inline',
	  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});
});