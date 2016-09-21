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
      
    });

  },

  onResize: function() {
    var _this = this;

    _this.Layout.windowWidth = $(window).width();
    _this.Layout.windowHeight = $(window).height();

    if ($('body').hasClass('single-collection')) {
      _this.Layout.convertScroll();
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
      videoHeight = ( videoWidth / video['width'] ) * video['height'];

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
    var _this = this;

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

Site.Layout = {
  windowWidth: $(window).width(),
  windowHeight: $(window).height(),
  init: function() {
    var _this = this;

    if ($('body').hasClass('single-collection')) {
      _this.convertScroll();
    }
  },

  convertScroll: function() {
    if ($('body').css('overflow-x') == 'scroll') {
      scrollConverter.activate();
    } else {
      scrollConverter.deactivate();
    }
  },

  toggleOverlay: function() {
    if ($('.site-overlay').length) {
      $('.site-overlay').toggleClass('hide');
    }
  }
};

Site.init();
