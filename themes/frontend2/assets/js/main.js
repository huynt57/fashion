// main js

function defaultNotifiDisplay(message) {
    $.notify(message, {
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
        template: '<div data-notify="container" class="qh-alert qh-alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' + '<div data-notify="title" class="alert-title">{1}</div> ' + '<div data-notify="message" class="alert-content">{2}</div>' + '<a href="{3}" target="{4}" data-notify="url"></a>' + '</div>'
    });
}

function errorNotifiDisplay(message) {
    $.notify(message, {
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
        template: '<div data-notify="container" class="qh-alert qh-alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' + '<div data-notify="title" class="alert-title"><i class="fa fa-exclamation-triangle"></i> {1}</div> ' + '<div data-notify="message" class="alert-content">{2}</div>' + '<a href="{3}" target="{4}" data-notify="url"></a>' + '</div>'
    });
}

function infoNotifiDisplay(message) {
    $.notify(message, {
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
        template: '<div data-notify="container" class="qh-alert qh-alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' + '<div data-notify="title" class="alert-title"><i class="fa fa-info-circle"></i> {1}</div> ' + '<div data-notify="message" class="alert-content">{2}</div>' + '<a href="{3}" target="{4}" data-notify="url"></a>' + '</div>'
    });
}

function successNotifiDisplay(message) {
    $.notify(message, {
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
        template: '<div data-notify="container" class="qh-alert qh-alert-{0}" role="alert">' + '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' + '<div data-notify="title" class="alert-title"><i class="fa fa-check-circle"></i> {1}</div> ' + '<div data-notify="message" class="alert-content">{2}</div>' + '<a href="{3}" target="{4}" data-notify="url"></a>' + '</div>'
    });
}

$(document).on('click', '.delete-image', function (e) {
    e.preventDefault();
    $(this).parent().remove();
});

$(document).on('show.bs.modal', '.modal', function () {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function () {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});

$(document).ready(function () {

    $('#upload-post').click(function () {
        var url = $(this).attr('data-url');
        $.ajax({
            url: url,
            beforeSend: function (xhr) {
                $('#uploadNewPostModal').empty();
                $('#uploadNewPostModal').html('<img id="loading" src="/themes/frontend2/assets/img/loading.gif" alt="" style="' +
                        'display: block;' +
                        'margin: 0 auto;' +
                        'margin-top: 15%;' +
                        '">');

            },
            type: 'GET',
            success: function (response) {
                $('#uploadNewPostModal').html(response);
            }
        });
    });

    function readURL(input) {
        //alert('3');
        if (input.files) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var cnt = $('.single-image').length;
                    if (cnt >= 5) {
                        alert('Bạn chỉ được đăng tối đa 5 ảnh');
                        return false;
                    }
                    $('.post-image-upload').append('<div class="single-image" style="margin-right: 5px;background-image: url(' + e.target.result + ');"><a href="#" class="delete-image"><i class="fa fa-close"></i></a></div>');

                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    $(document).on('change', "#inputPostImage", function () {
        ///  alert('2');
        var files = $("#inputPostImage")[0].files;
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var cnt = $('.single-image').length;
                if (cnt >= 5) {
                    alert('Bạn chỉ được đăng tối đa 5 ảnh');
                    return false;
                }
                $('.post-image-upload').append('<div class="single-image" style="margin-right: 5px;background-image: url(' + e.target.result + ');"><a href="#" class="delete-image"><i class="fa fa-close"></i></a></div>');

            }
            reader.readAsDataURL(files[i]);

        }
    });


    $("#inputAvatarUpload").change(function () {
        var files = $("#inputAvatarUpload")[0].files;
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();

            reader.onload = function (e) {

                $('#avatar-reader').html('<div class="avatar-image bg-cover" style="background-image: url(' + e.target.result + ');"></div>');

            }
            reader.readAsDataURL(files[i]);

        }
    });

    $("#inputCoverUpload").change(function () {
        var files = $("#inputCoverUpload")[0].files;
        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();

            reader.onload = function (e) {

                $('#cover-reader').html('<img src="' + e.target.result + '" alt="">');

            }
            reader.readAsDataURL(files[i]);

        }
    });



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
            .progress(function (instance, image) {
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
                    img: '/themes/frontend2/assets/img/loading.gif',
                    msgText: 'Đang tải',
                    selector: '.msr-loading'
                }
            }, function (items, data, url) {
                var $items = $(items)
                        .hide()
                        .imagesLoaded()
                        .progress(function (instance, image) {
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

    // ==== NOTIFICATION on header ================

    // List notifications scroll
//    $('.site-header .user-option-list .user-option-list-inner').slimScroll({
//        height: '380px',
//        size: '5px',
//        color: '#9E9E9E',
//        position: 'right'
//    });


    // ==== NOTIFICATION ================


    // Default Toast

    $('#defaultNotifiDisplay').click(function () {
        defaultNotifiDisplay()
    });


    $('#errorNotifiDisplay').click(function () {
        errorNotifiDisplay();
    });


    $('#infoNotifiDisplay').click(function () {
        infoNotifiDisplay()
    });


    $('#successNotifiDisplay').click(function () {
        successNotifiDisplay()
    });


});