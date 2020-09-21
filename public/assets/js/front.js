$(function () {
  var stylesheet = $("link#theme-stylesheet");
  $("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
  var alternateColour = $("link#new-stylesheet");

  if ($.cookie("theme_csspath")) {
    alternateColour.attr("href", $.cookie("theme_csspath"));
  }

  $("#colour").change(function () {
    if ($(this).val() !== "") {
      var theme_csspath = "css/style." + $(this).val() + ".css";

      alternateColour.attr("href", theme_csspath);

      $.cookie("theme_csspath", theme_csspath, {
        expires: 365,
        path: document.URL.substr(0, document.URL.lastIndexOf("/")),
      });
    }

    return false;
  });

  $('a[href="#"]').on("click", function (e) {
    e.preventDefault();
  });

  $(".label-template-checkbox input").on("click", function () {
    if ($(".label-template-checkbox input").is(":checked")) {
      $(this).parent(".label-template-checkbox").toggleClass("active");
    }
  });

  // ------------------------------------------------------- //
  // Multi Level dropdowns
  // ------------------------------------------------------ //
  $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function (event) {
    event.preventDefault();
    event.stopPropagation();

    $(this).siblings().toggleClass("show");

    if (!$(this).next().hasClass("show")) {
      $(this)
        .parents(".dropdown-menu")
        .first()
        .find(".show")
        .removeClass("show");
    }
    $(this)
      .parents("li.nav-item.dropdown.show")
      .on("hidden.bs.dropdown", function (e) {
        $(".dropdown-submenu .show").removeClass("show");
      });
  });

  // ------------------------------------------------------- //
  // Collapse Map
  // ------------------------------------------------------ //
  $(".collapse-map").on("click", function () {
    $(".map-holder").slideToggle("fast");
    $(this).toggleClass("active");

    if ($(this).hasClass("active")) {
      $(this).text("Toggle Map");
    } else {
      $(this).text("Collapse Map");
    }
  });

  // ------------------------------------------------------- //
  // Search Filter Button
  // ------------------------------------------------------ //
  $(".more-filters").on("click", function () {
    $(".all-options").toggleClass("d-none");
  });

  // ------------------------------------------------------- //
  // Navbar Toggler Button
  // ------------------------------------------------------- //
  $(".navbar .navbar-toggler").on("click", function () {
    $(this).toggleClass("active");
  });

  // ------------------------------------------------------- //
  // Search Features Button
  // ------------------------------------------------------ //
  $(".toggle-features").on("click", function () {
    $(".features").toggleClass("d-none");

    if ($(".features").hasClass("d-none")) {
      $(".toggle-features").html(
        'Show Features <i class="fa fa-angle-down"></i>'
      );
    } else {
      $(".toggle-features").html(
        'Hide Features <i class="fa fa-angle-up"></i>'
      );
    }
  });

  // ------------------------------------------------------- //
  // Bootstrap Select initialization
  // ------------------------------------------------------ //
  $(".selectpicker").selectpicker();

  // ------------------------------------------------------- //
  // Search Popup
  // ------------------------------------------------------ //
  $("a.search-btn").on("click", function () {
    $(".search-area").addClass("is-visible");
  });
  $(".search-area .close-btn").on("click", function () {
    $(".search-area").removeClass("is-visible");
  });

  // ------------------------------------------------------- //
  // Scroll To Top Button
  // ------------------------------------------------------ //
  $("#scrollTopButton").on("click", function () {
    $("body, html").animate({ scrollTop: 0 }, 1000);
  });

  // ------------------------------------------------------- //
  // Venue Slider
  // ------------------------------------------------------ //
  var swiper = new Swiper(".venue-slider", {
    slidesPerView: 5,
    spaceBetween: 20,
    breakpoints: {
      991: {
        slidesPerView: 2,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
  });

  // ------------------------------------------------------- //
  // Planner Slider
  // ------------------------------------------------------ //
  var swiper = new Swiper(".planner-slider", {
    slidesPerView: 4,
    spaceBetween: 30,
    breakpoints: {
      991: {
        slidesPerView: 1,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
  });

  // ------------------------------------------------------- //
  // Testimonials Slider
  // ------------------------------------------------------ //
  var swiper = new Swiper(".testimonials-slider", {
    slidesPerView: 1,
    spaceBetween: 30,
    breakpoints: {
      991: {
        slidesPerView: 1,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
  });

  // ------------------------------------------------------- //
  // Clients Slider
  // ------------------------------------------------------ //
  var swiper = new Swiper(".clients-slider", {
    slidesPerView: 6,
    spaceBetween: 30,
    breakpoints: {
      991: {
        slidesPerView: 3,
      },
      480: {
        slidesPerView: 2,
      },
    },
  });

  // ------------------------------------------------------- //
  // Hero Slider
  // ------------------------------------------------------ //
  var swiper = new Swiper(".hero-slider", {
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + "</span>";
      },
    },
    autoplay: {
      delay: 5000,
      disableOnInteraction: true,
    },
  });

  // ------------------------------------------------------- //
  // Navbar
  // ------------------------------------------------------ //
  var c = 0,
    currentScrollTop = 0;
  $(window).on("scroll", function () {
    if ($(window).scrollTop() >= 1000) {
      $("#scrollTopButton").fadeIn();
    } else {
      $("#scrollTopButton").fadeOut();
    }

    var topBarHeight = $(".top-bar").height();

    if ($(window).scrollTop() >= topBarHeight) {
      $(".navbar").addClass("sticky");
      $("body").css("padding-top", topBarHeight + $(".navbar").height() + "px");
      $("nav.navbar").css("padding-top", "10px").css("padding-bottom", "10px");
      $("nav.navbar .navbar-brand").css("max-width", "100px");
      $("nav.navbar .navbar-brand img").css("width", "65px");
    } else {
      $(".navbar").removeClass("sticky");
      $("body").css("padding-top", "0");
      $("nav.navbar").css("padding-top", "10px").css("padding-bottom", "10px");
      $("nav.navbar .navbar-brand").css("max-width", "180px");
      $("nav.navbar .navbar-brand img").css("width", "90px");
    }

    // Navbar functionality
    var a = $(window).scrollTop(),
      b = $(".navbar").height();

    currentScrollTop = a;
    if (c < currentScrollTop && a > b + b + 3800) {
      $(".navbar").addClass("scrollUp");
    } else if (c > currentScrollTop && !(a <= b)) {
      $(".navbar").removeClass("scrollUp");
    }
    c = currentScrollTop;
  });
});
