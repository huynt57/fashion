// main js

// main js


$(document).ready(function(){

	// masonry layout for cards
	// $cardContainer = $('.post-cards-wrap');
	// $cardItem = $('.card-item');

	// $cardItem.hide();
	// $cardContainer.imagesLoaded().done( function() {
	// 	$cardItem.removeClass('card-hide').fadeIn();
	// 	$cardContainer.masonry({
	// 	  columnWidth: '.card-sizer',
	// 	  itemSelector: '.card-item',
	// 	  percentPosition: true,
	// 	  transitionDuration: 0
	// 	});
	// });


	// effect loading
        //alert('123');
   var effect = 'animate fade-in';
	// masonry post
	var masonry_selector = '.post-cards-wrap';
	var masonry_item_selector = '.card-single';

	// Initialize Masonry.
  var $masonry = $(masonry_selector)
      .masonry({
          itemSelector: masonry_item_selector
      });

  // Find and hide the items.
  var $masonry_items = $masonry
      .find(masonry_item_selector)
      .hide();

  // Wait for the images to load.
  $masonry
    .imagesLoaded()
      // An image has been loaded.
    .progress(function(instance, image) {
      // Add the effect.
      var $image = $(image.img)
        .addClass(effect);
      // Find and show the item.
      var $item = $image
        .parents(masonry_item_selector)
        .show();
      // Lay out Masonry.
      $masonry
        .masonry();
    });

  // Load more items.
  $masonry
    .infinitescroll({
      navSelector: '.msr-pagination',
      nextSelector: '.msr-pagination .next > a',
      itemSelector: masonry_item_selector,
      loading: {
        finishedMsg: 'Đã hết bài đăng',
        img: '/fashion/themes/frontend2/assets/img/loading.gif',
        msgText: 'Đang tải',
        selector: '.msr-loading'
      }
    }, function(items, data, url) {
      var $items = $(items)
        .hide()
        .imagesLoaded()
        .progress(function(instance, image) {
      var $image = $(image.img)
        .addClass(effect);
			var $item = $image
        .parents(masonry_item_selector)
        .addClass('infinite-scroll-item')
        .show();
			$masonry
        .masonry('appended', $item);
      });
    });

  // =============================================

	// single post image
	$('.carousel').carousel({
		interval: false,
		wrap: false
	});

	// single post content scroll
	$('.qh-single-post-section .card-single-inner').slimScroll({
    height: '470px',
    size: '5px',
    color: '#9E9E9E',
    position: 'right'
  });

});

