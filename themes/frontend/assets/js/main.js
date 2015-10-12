// main js


$(document).ready(function(){

	// masonry layout for cards
	$cardContainer = $('.cards-display-main-ctn');
	$cardItem = $('.card-item');

	$cardItem.hide();
	$cardContainer.imagesLoaded().done( function() {
		$cardItem.removeClass('card-hide').fadeIn();
		$cardContainer.masonry({
		  columnWidth: '.card-sizer',
		  itemSelector: '.card-item',
		  percentPosition: true,
		  transitionDuration: 0
		});
	});

	// single post image
	$('.carousel').carousel({
		interval: false,
		wrap: false
	});

	// lightbox ajax
	// $.featherlight{}

	

});
