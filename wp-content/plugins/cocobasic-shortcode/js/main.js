(function ($) {
    "use stict";

    var count = 1;
    var portfolioPostsPerPage = $(".grid-item").length;
    var totalNumberOfPortfolioPages = Math.ceil(parseInt(ajax_var_portfolio.total) / portfolioPostsPerPage);

    showHidePortfolioLoadMoreButton();
    portfolioSectionAddTitleClass();
    portfolioItemContentLoadOnClick();
    loadMorePortfolioOnClick();
    setPrettyPhoto();
    fixTeamLayout();
    imageSliderSettings();
    textSliderSettings();


    $(window).on('load', function () {
        isotopeSetUp();
        setUpParallax();
    });

    $(window).on('resize', function () {
        fixTeamLayout();
    });


    function isotopeSetUp() {
        $('.grid').isotope({
            itemSelector: '.grid-item',
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });
    }

    function showHidePortfolioLoadMoreButton() {
        if (portfolioPostsPerPage < parseInt(ajax_var_portfolio.total)) {
            $('.more-posts-portfolio').css('visibility', 'visible');
            $('.more-posts-portfolio').animate({opacity: 1}, 1500);
        } else {
            $('.more-posts-portfolio').css('display', 'none');
        }
    }

    function imageSliderSettings() {
        $(".image-slider").each(function () {
            var id = $(this).attr('id');
            var auto_value = window[id + '_auto'];
            var hover_pause = window[id + '_hover'];
            var speed_value = window[id + '_speed'];
            auto_value = (auto_value === 'true') ? true : false;
            hover_pause = (hover_pause === 'true') ? true : false;
            $('#' + id).owlCarousel({
                loop: true,
                autoHeight: true,
                smartSpeed: 1000,
                autoplay: auto_value,
                autoplayHoverPause: hover_pause,
                autoplayTimeout: speed_value,
                responsiveClass: true,
                items: 1
            });

            $(this).on('mouseleave', function () {
                $(this).trigger('stop.owl.autoplay');
                $(this).trigger('play.owl.autoplay', [auto_value]);
            })
        });
    }

    function textSliderSettings() {
        $(".text-slider").each(function () {
            var id = $(this).attr('id');
            var auto_value = window[id + '_auto'];
            var hover_pause = window[id + '_hover'];
            var speed_value = window[id + '_speed'];
            auto_value = (auto_value === 'true') ? true : false;
            hover_pause = (hover_pause === 'true') ? true : false;
            $('#' + id).owlCarousel({
                loop: true,
                autoHeight: false,
                smartSpeed: 1000,
                autoplay: auto_value,
                autoplayHoverPause: hover_pause,
                autoplayTimeout: speed_value,
                responsiveClass: true,
                dots: false,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                nav: true,
                items: 1
            });
        });
    }

    function setPrettyPhoto() {
        $('a[data-rel]').each(function () {
            $(this).attr('rel', $(this).data('rel'));
        });
        $("a[rel^='prettyPhoto']").prettyPhoto({
            slideshow: false, /* false OR interval time in ms */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            default_width: 1280,
            default_height: 720,
            deeplinking: false,
            social_tools: false,
            iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>'
        });
    }

    function portfolioItemContentLoadOnClick() {
        $('.ajax-portfolio').on('click', function (e) {
            e.preventDefault();
            var portfolioItemID = $(this).data('id');
            $(this).addClass('animate-plus');
            if ($("#pcw-" + portfolioItemID).length) //Check if is allready loaded
            {
                $('html, body').animate({scrollTop: $('#portfolio-wrapper').offset().top - 150}, 400);
                setTimeout(function () {
                    $('#portfolio-grid, .more-posts-portfolio-holder').addClass('hide');
                    setTimeout(function () {
                        $("#pcw-" + portfolioItemID).addClass('show');
                        $('.portfolio-load-content-holder').addClass('show');
                        $('.ajax-portfolio').removeClass('animate-plus');
                        $('#portfolio-grid, .more-posts-portfolio-holder').hide();
                    }, 300);
                }, 500);
            } else {
                loadPortfolioItemContent(portfolioItemID);
                $('.section-title-holder').trigger("sticky_kit:recalc");
            }
        });
    }

    function loadPortfolioItemContent(portfolioItemID) {
        $.ajax({
            url: ajax_var.url,
            type: 'POST',
            data: "action=portfolio_ajax_content_load&portfolio_id=" + portfolioItemID,
            success: function (html) {
                var getPortfolioItemHtml = $(html).find(".portfolio-item-wrapper").html();
                $('.portfolio-load-content-holder').append('<div id="pcw-' + portfolioItemID + '" class="portfolio-content-wrapper">' + getPortfolioItemHtml + '</div>');
                if (!$("#pcw-" + portfolioItemID + " .close-icon").length) {
                    $("#pcw-" + portfolioItemID).prepend('<div class="close-icon"></div>');
                }
                $('html, body').animate({scrollTop: $('#portfolio-wrapper').offset().top - 150}, 400);
                setTimeout(function () {
                    $("#pcw-" + portfolioItemID).imagesLoaded(function () {
                        imageSliderSettings();
                        $(".site-content").fitVids(); //Fit Video
                        $('#portfolio-grid, .more-posts-portfolio-holder').addClass('hide');
                        setTimeout(function () {
                            $("#pcw-" + portfolioItemID).addClass('show');
                            $('.portfolio-load-content-holder').addClass('show');
                            $('.ajax-portfolio').removeClass('animate-plus');
                            $('#portfolio-grid').hide();
                        }, 300);
                        $('.close-icon').on('click', function (e) {
                            var portfolioReturnItemID = $(this).closest('.portfolio-content-wrapper').attr("id").split("-")[1];
                            $('.portfolio-load-content-holder').addClass("viceversa");
                            $('#portfolio-grid, .more-posts-portfolio-holder').css('display', 'block');
                            setTimeout(function () {
                                $('#pcw-' + portfolioReturnItemID).removeClass('show');
                                $('.portfolio-load-content-holder').removeClass('viceversa show');
                                $('#portfolio-grid, .more-posts-portfolio-holder').removeClass('hide');
                            }, 300);
                            setTimeout(function () {
                                $('html, body').animate({scrollTop: $('#p-item-' + portfolioReturnItemID).offset().top}, 400);
                            }, 500);
                        });
                    });
                }, 500);
            }
        });
        return false;
    }


    function loadMorePortfolioOnClick() {
        $('.more-posts-portfolio:visible').on('click', function () {
            count++;
            loadPortfolioMoreItems(count, portfolioPostsPerPage);
            $('.more-posts-portfolio').css('display', 'none');
            $('.more-posts-portfolio-loading').css('display', 'block');
        });
    }

    function loadPortfolioMoreItems(pageNumber, portfolioPostsPerPage) {
        $.ajax({
            url: ajax_var.url,
            type: 'POST',
            data: "action=portfolio_ajax_load_more&portfolio_page_number=" + pageNumber + "&portfolio_posts_per_page=" + portfolioPostsPerPage,
            success: function (html) {
                var $newItems = $(html);
                $('.grid').append($newItems);
                if ($(".section-title-holder.portfolio-title-fix-class").hasClass('it-is-bottom')) {
                    $('.section-wrapper').resize(fixTitleStickyPosition);
                }
                $('.grid').imagesLoaded(function () {
                    $('.grid').isotope('appended', $newItems);
                    if (count == totalNumberOfPortfolioPages)
                    {
                        $('.more-posts-portfolio').css('display', 'none');
                        $('.more-posts-portfolio-loading').css('display', 'none');
                        $('.no-more-posts-portfolio').css('display', 'block');
                    } else
                    {
                        $('.more-posts-portfolio').css('display', 'block');
                        $('.more-posts-portfolio-loading').css('display', 'none');
                    }
                });

                portfolioItemContentLoadOnClick();
                setPrettyPhoto();
            }
        });
        return false;
    }

    function portfolioSectionAddTitleClass() {
        if ($("#portfolio-grid").length)
        {
            $("#portfolio-grid").parents('.section-wrapper').find(".section-title-holder").addClass('portfolio-title-fix-class');
        }
    }

    function setUpParallax() {
        $('[data-jarallax-element]').jarallax({
            speed: 0.2
        });
    }

    function destroyParallax() {
        $('[data-jarallax-element]').jarallax('destroy');
    }

    function fixTeamLayout() {
        if ($(window).width() < 1000) {
            $('.member-right').each(function () {
                if (!$(this).hasClass('small-screen')) {
                    $(this).addClass('small-screen').removeClass('big-screen').find('img').insertBefore($(this).find('.member-info'));
                }
            });
        } else
        {
            $('.member-right').each(function () {
                if (!$(this).hasClass('big-screen')) {
                    $(this).addClass('big-screen').removeClass('small-screen').find('.member-info').insertBefore($(this).find('img'));
                }
            });
        }

    }

})(jQuery);