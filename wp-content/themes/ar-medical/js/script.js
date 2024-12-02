/**
 * File script.js.
 *
 * Contains general scripts for the theme.
 * Like the cards animation. hover effect. etc.
 */


jQuery(document).ready(($) => {
    const toggleButton = $('#toggle-search-form');
    const searchForm = $('#product-search-form-mobile');

    if (!toggleButton.length || !searchForm.length) {
        return;
    }

    toggleButton.on('click', () => {
        searchForm.toggleClass('hidden');
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const submenuToggles = document.querySelectorAll('.submenu-toggle');

    for (const toggle of submenuToggles) {
        toggle.addEventListener('click', (e) => {
            e.preventDefault();
            const submenu = toggle.parentElement.nextElementSibling;
            submenu?.classList.toggle('hidden');
            submenu?.classList.toggle('max-h-0');
            submenu?.classList.toggle('max-h-screen');
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const navItems = document.querySelectorAll('.nav-item');

    for (const item of navItems) {
        item.addEventListener('mouseenter', () => {
            for (const otherItem of navItems) {
                if (otherItem !== item) {
                    otherItem.classList.add('faded');
                }
            }
        });

        item.addEventListener('mouseleave', () => {
            for (const otherItem of navItems) {
                otherItem.classList.remove('faded');
            }
        });
    }
});



document.addEventListener('DOMContentLoaded', () => {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const navButtons = document.querySelectorAll('.nav-button');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === index) {
                slide.classList.add('active');
            }
        });

        navButtons.forEach((button, i) => {
            button.classList.remove('active');
            if (i === index) {
                button.classList.add('active');
            }
        });
    }

    for (const button of navButtons) {
        button.addEventListener('click', function () {
            currentSlide = Number.parseInt(this.getAttribute('data-slide'));
            showSlide(currentSlide);
        });
    }

    // Initialize the first slide
    showSlide(currentSlide);
});


jQuery(document).ready(($) => {
    $('.slick-container').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        speed: 300,
        prevArrow: '<button aria-label="previos slide" type="button" class="car-button left"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button aria-label="next slide" type="button" class="car-button right"><i class="fas fa-chevron-right"></i></button>',
        dots: false,
        responsive: [
            {
                breakpoint: 1324,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});


jQuery(document).ready(($) => {
    $('.products-home').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: '<button aria-label="previos slide" type="button" class="car-button left"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button aria-label="next slide" type="button" class="car-button right"><i class="fas fa-chevron-right"></i></button>',
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 1300,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.product-image-carousel').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow: '<button aria-label="previos slide" type="button" class="car-button left"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button aria-label="next slide" type="button" class="car-button right"><i class="fas fa-chevron-right"></i></button>',
        dots: false,
        arrows: true
    });

    $('.related-products').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        prevArrow: '<button aria-label="previos slide" type="button" class="car-button left"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button aria-label="next slide" type="button" class="car-button right"><i class="fas fa-chevron-right"></i></button>',
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 1300,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.product-categories-carousel').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: '<button aria-label="previos slide" type="button" class="car-button left"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button aria-label="next slide" type="button" class="car-button right"><i class="fas fa-chevron-right"></i></button>',
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});


document.addEventListener('DOMContentLoaded', () => {
    flatpickr("#appointment", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        disable: [
            (date) => {
                // Disable weekends
                return (date.getDay() === 0 || date.getDay() === 6);
            }
        ],
        time_24hr: true,
        minuteIncrement: 30,
        defaultHour: 9,
        defaultMinute: 0,
        minTime: "09:00",
        maxTime: "17:00",
        locale: "ro" // Set the locale to Romanian
    });
});



(() => {
    const l = document.createElement('script'); l.type =
        'text/javascript'; l.async = true; l.src =
            "https://widget.trusted.ro/widget/armedicalcosmetic.ro.js"; const s =
                document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(l,
                    s); window._vteq = window._vteq || [];
})();


document.addEventListener('DOMContentLoaded', () => {
    // Get the element with the ID 'tab-description'
    const tabDescriptionElement = document.getElementById('tab-description');

    // Check if the element exists
    if (tabDescriptionElement) {
        // Add the 'the-content' class to the element
        tabDescriptionElement.classList.add('the-content');
    }
});


$ = jQuery;

// Mini cart functionality
$(document).on('click', '.quantity .quantity-down', function () {
    $('.mini-cart-div').block({
        message: '<div class="loading loading-spinner w-full h-full"></div>',
        overlayCSS: {
            cursor: 'loading',
        }
    });

    const $input = $(this).parent().find('input');

    let count = Number.parseInt($input.val()) - 1;

    count = count < 0 ? 0 : count;

    $input.val(count);
    $input.change();

    const data_key = $(this).parent().parent().find('.current-key').val();

    $.ajax({
        type: "post",
        dataType: "json",
        url: ajaxUrl,
        data: {
            action: 'vc-increase-cart-quantity',
            quantity: count,
            data_key: data_key
        },
        success: (response) => {
            if (response.success) {
                $('.mini-cart-div').html(response.success);
            }

            jQuery('.mini-cart-div').unblock();
        }
    });

    return false;
});



$(document).on('click', '.quantity .quantity-up', function () {
    $('.mini-cart-div').block({
        message: '<div class="loading loading-spinner w-full h-full"></div>',
        overlayCSS: {
            cursor: 'loading',
        }
    });

    const $input = $(this).parent().find('input');

    let count = Number.parseInt($input.val()) + 1;

    const max = $input.attr('max');
    if (Number.parseInt(max) && count > max) {
        count = max;
    }
    $input.val(count);
    $input.change();

    const data_key = $(this).parent().parent().find('.current-key').val();

    $.ajax({
        type: "post",
        dataType: "json",
        url: ajaxUrl,
        data: {
            action: 'vc-increase-cart-quantity',
            quantity: count,
            data_key: data_key
        },
        success: (response) => {
            if (response.success) {
                $('.mini-cart-div').html(response.success);
            }

            jQuery('.mini-cart-div').unblock();

        }
    });

    return false;
});


// qnt in minicart 
jQuery(document.body).trigger('wc_fragment_refresh');


document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('primary-menu');
    const fixedClass = 'fixed-header';
    const offset = 100;

    if (!header) {
        return;
    }

    window.addEventListener('scroll', () => {
        if (window.scrollY > offset) {
            header.classList.add(fixedClass);
        } else {
            header.classList.remove(fixedClass);
        }
    });
});

jQuery(document).ready(($) => {
    let debounceTimeout;

    $('#search-query').on('keyup', function () {
        const searchQuery = $(this).val();

        // Clear the previous timeout
        clearTimeout(debounceTimeout);

        // Set a new timeout
        debounceTimeout = setTimeout(() => {
            if (searchQuery.length > 2) {

                console.log(searchQuery);

                $('#search-icon').hide();
                $('#loading-icon').show();

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'search_products', // Custom action
                        query: searchQuery,        // Send the search query
                    },
                    success: (response) => {
                        // Hide the loading icon
                        $('#loading-icon').hide();
                        $('#search-icon').show();

                        $('#search-results').show();

                        // Show the search results
                        $('#search-results').html(response);
                    },
                    error: () => {
                        // Hide the loading icon even if there is an error
                        $('#loading-icon').hide();
                        $('#search-icon').show();
                        $('#search-results').html('<p>There was an error processing your request.</p>');
                    }
                });
            } else {
                // Clear results and hide the loading icon if the query is too short
                $('#search-results').empty();
                $('#loading-icon').hide();
                $('#search-results').hide();
                $('#search-icon').show();
            }
        }, 1000); //1s
    });
});

jQuery(document).ready(($) => {
    $('#search-query-mobile').on('keyup', function () {
        const searchQuery = $(this).val();

        if (searchQuery.length > 2) {
            console.log(searchQuery);
            // Show the loading icon
            $('#loading-icon-mobile').show();
            $('#search-icon-mobile').hide();

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'search_products', // Custom action
                    query: searchQuery,        // Send the search query
                },
                success: (response) => {
                    // Hide the loading icon
                    $('#loading-icon-mobile').hide();
                    $('#search-icon-mobile').show();

                    $('#search-results-mobile').show();

                    // Show the search results
                    $('#search-results-mobile').html(response);
                },
                error: () => {
                    // Hide the loading icon even if there is an error
                    $('#loading-icon-mobile').hide();
                    $('#search-icon-mobile').show();
                    $('#search-results-mobile').html('<p>There was an error processing your request.</p>');
                }
            });
        } else {
            // Clear results and hide the loading icon if the query is too short
            $('#search-results-mobile').empty();
            $('#loading-icon-mobile').hide();
            $('#search-results-mobile').hide();
            $('#search-icon-mobile').show();
        }
    });
});