(function($){
	"use strict";

	// Scroll JS
	$('.scroll-btn a, .placid-aside .navbar-nav .nav-item .nav-link, .navbar .navbar-nav .nav-item .nav-link, .others-option .default-btn, .aside-footer .default-btn, .book-trainer-content .default-btn, .about-content .default-btn, .home-banner-content .default-btn').on('click', function(e){
		var anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $(anchor.attr('href')).offset().top - 50
		}, 1500);
		e.preventDefault();
	});
	$('.placid-aside .navbar-nav .nav-item .nav-link').on('click', function(){
		$('.placid-aside').toggleClass('active-placid-aside');
		$('.responsive-burger-menu').toggleClass('active');
	});
	$('.navbar .navbar-nav li a').on('click', function(){
		$('.navbar-collapse').collapse('hide');
	});

	// Headroom JS
	let headerElement = document.querySelector('.headroom');
	if (headerElement){
		let headroom = new Headroom(headerElement, {
			offset: 100
		});
		headroom.init();
	}

	// Header Sticky
	$(window).on('scroll',function() {
		if ($(this).scrollTop() > 30){
			$('.navbar').addClass("is-sticky");
		}
		else{
			$('.navbar').removeClass("is-sticky");
		}
	});

	// Main Container Sticky
	$(window).on('scroll',function() {
		if ($(this).scrollTop() > 30){
			$('.main-container-sticky').addClass("is-sticky");
		}
		else{
			$('.main-container-sticky').removeClass("is-sticky");
		}
	});

	// Hide Side Menu
	$('.aside-show-hide span').on('click', function() {
		$('.main-container').toggleClass('active-main-container');
	});

	// Burger Menu
	$('.responsive-burger-menu').on('click', function() {
		$('.responsive-burger-menu').toggleClass('active');
		$('.placid-aside').toggleClass('active-placid-aside');
	});



	// Popup Video
	$('.popup-youtube').magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	// Odometer JS
	$('.odometer').appear(function(e) {
		var odo = $(".odometer");
		odo.each(function() {
			var countNumber = $(this).attr("data-count");
			$(this).html(countNumber);
		});
	});

	// Instagram Slides
	$('.instagram-slides').owlCarousel({
		loop: true,
		nav: false,
		dots: false,
		autoplayHoverPause: true,
		autoplay: true,
		navText: [
			"<i class='ri-arrow-left-s-line'></i>",
			"<i class='ri-arrow-right-s-line'></i>"
		],
		responsive: {
			0: {
				items: 2,
			},
			576: {
				items: 4,
			},
			768: {
				items: 6,
			},
			1200: {
				items: 9,
			}
		}
	});

	// Popup Image
	$('.popup-btn').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true,
		}
	});



}(jQuery));
