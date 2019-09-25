var BuilderTypewriter;

(function($, window, document, undefined) {
	"use strict";

	BuilderTypewriter = {
		init: function() {
			var self = BuilderTypewriter;
			self.bindEvents();
		},

		bindEvents: function() {
			var self = BuilderTypewriter;
                        function wload(){
                            if (window.loaded) {
                                self.typeWriter();
                            } 
                            else {
                                $(window).load(self.typeWriter);
                            }
                        }
                        if ( Themify.is_builder_active ) {
                            $( 'body' ).on( 'builder_load_module_partial',self.typeWriter);
                            if(Themify.is_builder_loaded){
                                wload();
                            }
                        }
                        else{
                            wload();
                        }
		},
		typeWriter: function(e,el,type) {
			var self = BuilderTypewriter,
			$typewriter = $('[data-typer-targets]',el);
				if(el && el.data('typer-targets')){
					$typewriter = $typewriter.add(el);
				}

				Themify.LoadAsync(
					tb_typewriter_vars.url + 'assets/jquery.typer.themify.js',
					function() { self.typeWriterCallBack($typewriter) }.bind(this),
					null,
					null,
					function() { return ('undefined' !== typeof $.fn.typer) }
				);
		},
		typeWriterCallBack: function ($typewriter) {
			$.each($typewriter, function (i, elm) {
				if (Themify.is_builder_active) {
					elm.innerText = '';
				}
				var $this = $(elm),
					highlightSpeed = parseInt($this.data('typer-highlight-speed')),
					typeSpeed = parseInt($this.data('typer-type-speed')),
					clearDelay = parseFloat($this.data('typer-clear-delay')),
					typeDelay = parseFloat($this.data('typer-type-delay')),
					typerInterval = parseFloat($this.data('typer-interval')),
					typerStartFrom = Themify.is_builder_active ? 0 : 1,
					typerDirection = $this.data( 'typer-direction' );
					clearDelay = parseInt(clearDelay*1000);
					typeDelay = parseInt(typeDelay*1000);
					typerInterval = parseInt(typerInterval*1000);

				$this.typer({
					highlightSpeed   : highlightSpeed,
					typeSpeed        : typeSpeed,
					clearDelay       : clearDelay,
					typeDelay        : typeDelay,
					clearOnHighlight : true,
					typerDataAttr    : 'data-typer-targets',
					typerInterval    : typerInterval,
					typerOrder       : 'sequential',
					typerDirection   : typerDirection,
					typerStartFrom   : typerStartFrom,
					inlineHighlightStyle : false
				});
			});
		}
	};

	BuilderTypewriter.init();
}(jQuery, window, document));
