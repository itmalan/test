$(document).ready( function() {
	
	// themes
	var $theme1 = 'blue';
	
	// handlers
	var $card = $('#card'),
		$mainmenu = $card.find('.mainmenu'),
		$submenu = $card.find('.submenu');
	
	// initial setup
	$mainmenu.children('li').addClass($theme1).addClass('blue-border');
	$card.find('#front,#back').addClass($theme1);
	$submenu.find('.expand-triangle').addClass($theme1);
	$submenu.hide();
        $submenu.first().slideToggle();
        //$submenu.find('.active').slideToggle();

	
	// clicking on submenu items puts green light on left
        /*
	$submenu.on('click','li', function() {
		$submenu.siblings().find('li:not(#theme1,#theme2)').removeClass('chosen');
		$(this).addClass('chosen');
	});
	*/
	

	// click on menu expands submenu and closes others' submenu
	$mainmenu.on('click', 'li', function() {
		$(this).next('.submenu').slideToggle().siblings('.submenu').slideUp();
	});
	
});