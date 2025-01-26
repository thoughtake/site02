// ページTOPアニメーション
function pageTopAnime() {
  var scroll = jQuery(window).scrollTop();
  if (scroll >= 200) {
    jQuery('#page-top').removeClass('downMove');
    jQuery('#page-top').addClass('upMove');
  } else {
    if (jQuery('#page-top').hasClass('upMove')) {
      jQuery('#page-top').removeClass('upMove');
      jQuery('#page-top').addClass('downMove');
    }
  }
}



jQuery(function() {

  //slick
  jQuery('.slider').slick({
    // fade: true,
    autoplaySpeed: 10000,
    speed: 2000,
    autoplay: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    appendArrows: jQuery('.arrow-box'),
    prevArrow: '<div class="slide-arrow prev-arrow"><i class="fa-solid fa-caret-left"></i></div>',
    nextArrow: '<div class="slide-arrow next-arrow"><i class="fa-solid fa-caret-right"></i></div>',
    dots: true,
    dotsClass: "slide-dots",
    pauseOnFocus: true,
    pauseOnHover: true,
    pauseOnDotsHover: true
  })

  //scroll-hint
  new ScrollHint('.js-scrollable', {
    i18n: {
      scrollable: 'スクロールできます'
    }
  });

  //新着タブ
  var $tab1 = jQuery('#js-tab-1');
  var $tab2 = jQuery('#js-tab-2');
  var $tab3 = jQuery('#js-tab-3');
  var $ct1 = jQuery('#js-content-1');
  var $ct2 = jQuery('#js-content-2');
  var $ct3 = jQuery('#js-content-3');
  

  $tab1.on('click', function() {
    jQuery(this).addClass('active');
    $tab2.removeClass('active');
    $tab3.removeClass('active');
    $ct1.addClass('active');
    $ct2.removeClass('active');
    $ct3.removeClass('active');
  })
  $tab2.on('click', function() {
    jQuery(this).addClass('active');
    $tab1.removeClass('active');
    $tab3.removeClass('active');
    $ct2.addClass('active');
    $ct1.removeClass('active');
    $ct3.removeClass('active');
  })
  $tab3.on('click', function() {
    jQuery(this).addClass('active');
    $tab1.removeClass('active');
    $tab2.removeClass('active');
    $ct3.addClass('active');
    $ct1.removeClass('active');
    $ct2.removeClass('active');
  })

  jQuery('.back-to-top').click(function() {
    jQuery('body,html').animate({
      scrollTop: 0
    }, 500);
  })

  // 他のリンク（タームのリンク）でのスクロールアニメーション
  jQuery('.content-projects__links a').click(function() {
    var target = jQuery(this).attr('href');
    var offset = jQuery(target).offset().top;
    jQuery('html, body').animate({
      scrollTop: offset - 50
    }, 500);
    return false;
  });

})

jQuery(window).scroll(function() {
  pageTopAnime();
})

jQuery(window).on('load', function() {
  pageTopAnime();
})