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
      if ($('body').hasClass('post-type-archive-collection')) {
        _this.Collection.Archive.init();
      }

      _this.Layout.init();
    });

  },

  onResize: function() {
    var _this = this;

    if ($('body').hasClass('single-collection')) {
      _this.Layout.convertScroll();
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
}

Site.Layout = {
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
  }
}

Site.init();
