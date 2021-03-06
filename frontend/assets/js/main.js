// main js


$(document).ready(function(){

  // ==== CARD LOADING MASONRY ================

	// effect loading
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
      nextSelector: '.msr-pagination li a.next',
      itemSelector: masonry_item_selector,
      loading: {
        finishedMsg: 'Đã hết bài đăng',
        img: 'assets/img/loading.gif',
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

  // ==== SINGLE POST MODAL =========================================

	// Single post image
	$('.carousel').carousel({
		interval: false,
		wrap: false
	});

	// Single post content scroll
	$('.qh-single-post-section .card-single-inner').slimScroll({
    height: '470px',
    size: '5px',
    color: '#9E9E9E',
    position: 'right'
  });

  // Modal z-index fix (for multiple modals open at once)
  $(document).on('show.bs.modal', '.modal', function () {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});


  // ==== NOTIFICATION ================

  // Default Toast
  function defaultNotifiDisplay(){
    $.notify({
      // options
      title: 'Default notify',
      message: 'Turn ing st and ard Bo ots trap al erts in to "no tif y" li ke not i i ca ti o ns',
      url: 'https://github.com/',
      target: '_blank'
    },
    {
      // settings
      element: 'body',
      position: null,
      type: "normal",
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: false,
      placement: {
        from: "bottom",
        align: "left"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 4000,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: 
        '<div data-notify="container" class="qh-alert qh-alert-{0}" role="alert">' +
          '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
          '<div data-notify="title" class="alert-title">{1}</div> ' +
          '<div data-notify="message" class="alert-content">{2}</div>' +
          '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>' 
    });
  }
  $('#defaultNotifiDisplay').click(function(){
    defaultNotifiDisplay()
  });

  function errorNotifiDisplay(){
    $.notify({
      // options
      title: 'Có lỗi',
      message: 'lỗi xảy ra cmnr',
      url: 'https://github.com/',
      target: '_blank'
    },
    {
      // settings
      element: 'body',
      position: null,
      type: "error",
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: false,
      placement: {
        from: "bottom",
        align: "left"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 4000,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: 
        '<div data-notify="container" class="qh-alert qh-alert-{0}" role="alert">' +
          '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
          '<div data-notify="title" class="alert-title"><i class="fa fa-exclamation-triangle"></i> {1}</div> ' +
          '<div data-notify="message" class="alert-content">{2}</div>' +
          '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>' 
    });
  }
  $('#errorNotifiDisplay').click(function(){
    errorNotifiDisplay();
  });

  function infoNotifiDisplay(){
    $.notify({
      // options
      title: 'Title Info',
      message: 'Turn ing st and ard Bo ots trap al erts in to "no tif y" li ke not i i ca ti o ns',
      url: 'https://github.com/',
      target: '_blank'
    },
    {
      // settings
      element: 'body',
      position: null,
      type: "info",
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: false,
      placement: {
        from: "bottom",
        align: "left"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 4000,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: 
        '<div data-notify="container" class="qh-alert qh-alert-{0}" role="alert">' +
          '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
          '<div data-notify="title" class="alert-title"><i class="fa fa-info-circle"></i> {1}</div> ' +
          '<div data-notify="message" class="alert-content">{2}</div>' +
          '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>' 
    });
  }
  $('#infoNotifiDisplay').click(function(){
    infoNotifiDisplay()
  });

  function successNotifiDisplay(){
    $.notify({
      // options
      title: 'Thành công',
      message: 'Turn ing st and ard Bo ots trap al erts in to "no tif y" li ke not i i ca ti o ns',
      url: 'https://github.com/',
      target: '_blank'
    },
    {
      // settings
      element: 'body',
      position: null,
      type: "success",
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: false,
      placement: {
        from: "bottom",
        align: "left"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 4000,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: 
        '<div data-notify="container" class="qh-alert qh-alert-{0}" role="alert">' +
          '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
          '<div data-notify="title" class="alert-title"><i class="fa fa-check-circle"></i> {1}</div> ' +
          '<div data-notify="message" class="alert-content">{2}</div>' +
          '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>' 
    });
  }
  $('#successNotifiDisplay').click(function(){
    successNotifiDisplay()
  });
	

});

