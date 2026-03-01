(function() {
	"use strict";

	// Header Sticky
	const navbarArea = document.getElementById("navbarArea");
    if (navbarArea) {
		document.addEventListener("DOMContentLoaded", () => {
			const navbar = document.querySelector('.navbar-area');
			window.addEventListener('scroll', () => {
				if (window.scrollY >= 120) {
					navbar.classList.add('navbar-sticky');
				} else {
					navbar.classList.remove('navbar-sticky');
				}
			});
		});
	}

	// Search Box
	$('#searchBtn').on('click', function () {
		$('.search-box').toggleClass('active');
		$(this).toggleClass('active');
	});

	// scrollCue
    scrollCue.init();

	// Menu Popup
	$(".menu-popup-close-btn, .navbar-toggler, .menu-btn").on("click", function() {
		$(".menu-popup-area, body").toggleClass("active");
	});

    // Popup Video
	$('.popup-video').magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	// Popup Gallery
	$('.popup-gallery').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

	// Banner Wrapper Slides
	$('.banner-wrapper-slides').owlCarousel({
		nav: true,
		loop: true,
		margin: 25,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='ri-arrow-left-long-line'></i>",
			"<i class='ri-arrow-right-long-line'></i>"
		],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 1
			},
			1200: {
				items: 1
			},
			1400: {
				items: 1
			}
		}
	});

	// Features Tabs Slides
    var getslide = $('.features-list .feature-item').length - 1;
    var slidecal = 12/getslide+'%';
    $('.feature-item').css({"width": slidecal});
    $('.feature-item').on('click', function(){
        $('.feature-item').removeClass('active');
        $(this).addClass('active');
    });

	// Counter Number
	if ("IntersectionObserver" in window) {
		const counterObserver = new IntersectionObserver((entries, observer) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					const counter = entry.target;
					const target = parseInt(counter.innerText, 10);
					let current = 0;
					const duration = 2000; // Adjust total animation duration (in ms)
					const startTime = performance.now();
					function updateCounter(timestamp) {
						const elapsed = timestamp - startTime;
						const progress = Math.min(elapsed / duration, 1);
						counter.innerText = Math.floor(progress * target);
						if (progress <= 1) {
							requestAnimationFrame(updateCounter);
						}
					}
					requestAnimationFrame(updateCounter);
					observer.unobserve(counter);
				}
			});
		}, { threshold: 0.5 }); // Trigger when 50% of the element is visible
		document.querySelectorAll(".count-number").forEach((counter) => {
			counterObserver.observe(counter);
		});
	}

	// Testimonials Slides
	$('.testimonials-slides').owlCarousel({
		nav: false,
		loop: true,
		margin: 25,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='ri-arrow-left-line'></i>",
			"<i class='ri-arrow-right-line'></i>"
		],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 1
			},
			1200: {
				items: 2
			},
			1400: {
				items: 2
			}
		}
	});

	// Feedback Slides
	$('.feedback-slides').owlCarousel({
		items: 1,
		nav: true,
		loop: true,
		margin: 25,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='ri-arrow-left-line'></i>",
			"<i class='ri-arrow-right-line'></i>"
		]
	});

	// Reviews Slides
	$('.reviews-slides').owlCarousel({
		items: 1,
		nav: true,
		loop: true,
		margin: 25,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='ri-arrow-left-long-fill'></i>",
			"<i class='ri-arrow-right-long-fill'></i>"
		]
	});

	// Password Show/Hide
	document.addEventListener("DOMContentLoaded", () => {
		const wrappers = document.querySelectorAll(".password-show-hide");
		wrappers.forEach(wrapper => {
			const passwordField = wrapper.querySelector(".passwordField");
			const toggleButton = wrapper.querySelector(".togglePassword");
			if (!passwordField || !toggleButton) return;
			toggleButton.addEventListener("click", () => {
				const isPassword = passwordField.type === "password";
				passwordField.type = isPassword ? "text" : "password";
				// Toggle icon class
				toggleButton.classList.toggle("ri-eye-line", !isPassword);
				toggleButton.classList.toggle("ri-eye-off-line", isPassword);
			});
		});
	});

    // Text Animation
    let splitTitleLines = gsap.utils.toArray(".text-animation, .text_animation");
    splitTitleLines.forEach((splitTextLine) => {
        const tl2 = gsap.timeline({ scrollTrigger: { trigger: splitTextLine, start: "top 90%", end: "bottom 60%", scrub: false, markers: false, toggleActions: "play none none none" } });
        const itemSplitted = new SplitText(splitTextLine, { type: "words, lines" });
        gsap.set(splitTextLine, { perspective: 400 });
        itemSplitted.split({ type: "lines" });
        tl2.from(itemSplitted.lines, { duration: 1, delay: 0.3, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1 });
    });

    // Light/Dark Toggle
	const getSwitchToggleID = document.getElementById('light-dark-btn');
	if (getSwitchToggleID) {
		const switchToggle = document.getElementById('light-dark-btn');
        const html = document.documentElement;  // Targeting the <html> element
        if (switchToggle) {
            const savedTheme = localStorage.getItem("lunex-light-dark");
            // Apply the saved theme class if it exists
            if (savedTheme) {
                html.classList.add(savedTheme === "dark-mode" ? "dark-mode" : "light-mode");
            }
            // Add event listener to switch between themes
            switchToggle.addEventListener("click", () => {
                if (html.classList.contains("dark-mode")) {
                    // Switch to light theme
                    html.classList.remove("dark-mode");
                    html.classList.add("light-mode");
                    localStorage.setItem("lunex-light-dark", "light-mode");
                } else {
                    // Switch to dark theme
                    html.classList.remove("light-mode");
                    html.classList.add("dark-mode");
                    localStorage.setItem("lunex-light-dark", "dark-mode");
                }
            });
        }
	}

	// Go to Top
	$(function(){
		// Scroll Event
		$(window).on('scroll', function(){
			var scrolled = $(window).scrollTop();
			if (scrolled > 600) $('.back-to-top').addClass('active');
			if (scrolled < 600) $('.back-to-top').removeClass('active');
		});
		// Click Event
		$('.go-top, .back-to-top').on('click', function() {
			$("html, body").animate({ scrollTop: "0" },  0);
		});
	});

  

    // Preloader
    $(window).on('load', function() {
        $('.preloader').hide();
    });

})();