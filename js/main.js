/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {

      _this.Layout.init();

      if ($('body').hasClass('post-type-archive-collection')) {
        _this.Collection.Archive.init();
      }
      if ($('body').hasClass('home')) {
        _this.Home.init();
      }
      if ($('body').hasClass('single-product')) {
        _this.Product.Single.init();
      }

    });

  },

  onResize: function() {
    var _this = this;

    _this.Layout.windowWidth = $(window).width();
    _this.Layout.windowHeight = $(window).height();

    if ($('body').hasClass('single-collection')) {
      _this.Layout.convertScroll();
      _this.Layout.setBodyWidth();
    }

    if ($('body').hasClass('home')) {
      _this.Home.sizeHomeElements();
    }
  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.Collection = {

  Archive: {
    randPos: 0,
    randFlip: 0,
    init: function() {
      _this = this;

      _this.bindItemHover();
    },

    bindItemHover: function() {
      _this = this;

      $('.archive-collection-link').hover( function() {
        _this.randPos = Math.round(Math.random() * 3);
        _this.randFlip = Math.round(Math.random() * 3);

        $(this).parent().siblings('.archive-collection-image-holder').addClass('visible pos-' + _this.randPos + ' flip-' + _this.randFlip);
      }, function() {
        $(this).parent().siblings('.archive-collection-image-holder').removeClass('visible pos-' + _this.randPos + ' flip-' + _this.randFlip);
      });
    }
  },
};

Site.Home = {
  init: function() {
    var _this = this;

    _this.sizeHomeElements();
    _this.bindHomeBgImages();
    Site.Layout.toggleOverlay();
  },

  sizeHomeElements: function() {
    var _this = this,
      videoWidth = $('.home-video').width(),
      videoHeight = ( videoWidth / videoAspect['width'] ) * videoAspect['height'];

    var videoTop = (Site.Layout.windowHeight - videoHeight) / 2,
      videoLeft = (Site.Layout.windowWidth - videoWidth) / 2;

    $('.home-video').css({
      'height': videoHeight,
      'top': videoTop,
      'left': videoLeft,
    });

    if ($('#home-video-player').length) {
      $('#home-video-player').css({
        'width': videoWidth,
        'height': videoHeight + 300,
        'top': '-150px'
      });
    }

    if ($('.home-image').length) {
      $('.home-image-top, .home-image-bottom').css({
        'height': videoTop,
        'width': Site.Layout.windowWidth - videoLeft,
      });

      $('.home-image-left, .home-image-right').css({
        'height': Site.Layout.windowHeight - videoTop,
        'width': videoLeft,
      });
    }
  },

  bindHomeBgImages: function() {
    /*
    if (window.DeviceOrientationEvent) {
       window.addEventListener('deviceorientation', function(event) {
        var mouseX = ( ( ( event.beta / 180 ) * 100 ) + 100 ) / 2,
          mouseY = ( ( ( event.gamma / 90 ) * 100 ) + 100 ) / 2;

        $('.home-image-bg-left').css({
          'transform': 'translateX(' + ( - mouseY / 2) + '%)',
        });

        $('.home-image-bg-right').css({
          'transform': 'translateX(' + ( mouseY / 2) + '%)',
        });

        $('.home-image-bg-top').css({
          'transform': 'translateY(' + ( - mouseX / 2) + '%)',
        });

        $('.home-image-bg-bottom').css({
          'transform': 'translateY(' + ( mouseX / 2) + '%)',
        });
      });
    }
    */

    $(document).bind('mousemove', function(e){
        var mouseX = ( e.pageX / Site.Layout.windowWidth ) * 100,
          mouseY = ( e.pageY / Site.Layout.windowHeight ) * 100;

        $('.home-image-bg-left').css({
          'transform': 'translateX(' + ( - mouseY / 2) + '%)',
        });

        $('.home-image-bg-right').css({
          'transform': 'translateX(' + ( mouseY / 2) + '%)',
        });

        $('.home-image-bg-top').css({
          'transform': 'translateY(' + ( - mouseX / 2) + '%)',
        });

        $('.home-image-bg-bottom').css({
          'transform': 'translateY(' + ( mouseX / 2) + '%)',
        });
    });
  }
};

Site.Product = {
  Single: {
    init: function() {
      var _this = this;

      _this.initSwiper();
    },

    initSwiper: function() {
      if ($('.swiper-container').length) {
        var swiper = new Swiper('.swiper-container', {
          loop: true,
          speed: 200,
          spaceBetween: 36,
          nextButton: '.slider-next',
          setWrapperSize: true
        });
      }
    }
  },
};

Site.Layout = {
  init: function() {
    var _this = this;

    _this.windowWidth = $(window).width();
    _this.windowHeight = $(window).height();

    if ($('body').hasClass('single-collection')) {
      _this.convertScroll();

      $('img.single-collection-item').one('load',function() {
        // set body width as each image loads
        _this.setBodyWidth();
      });
    }
  },

  convertScroll: function() {
    var _this = this;

    if ($('body').css('overflow-x') == 'scroll' && _this.windowWidth >= 720) {
      scrollConverter.activate();
    } else {
      scrollConverter.deactivate();
    }
  },

  setBodyWidth: function() {
    var _this = this;

    // explicit body width is necessary for scrollConverter to work on Mozilla
    if ($('body').css('overflow-x') == 'scroll' && _this.windowWidth >= 720) {
      var bodyWidth = 0;

      $('.single-collection-item, .single-collection-text').each(function() {
        bodyWidth += $(this).outerWidth(true);
      });

      $('body').css('width', bodyWidth);
    } else {
      $('body').css('width', '100%');
    }
  },

  toggleOverlay: function() {
    if ($('.site-overlay').length) {
      $('.site-overlay').toggleClass('hide');
    }
  }
};

Site.init();
