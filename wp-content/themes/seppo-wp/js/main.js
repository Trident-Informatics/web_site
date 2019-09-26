(function ($) {
    "use strict";

    var count = 1;
    showAllAnimatedElements();
    loadMoreArticleIndex();
    setToltip();
    fixForFooterNoContent();    

    //Fix for Menu
    $(".header-holder").sticky({topSpacing: 0});

    //Single Post Sticky Info
    $(".single-post .entry-info").stick_in_parent({offset_top: 120, parent: ".single-content-wrapper", spacer: ".sticky-spacer"});

    //Slow Scroll
    $('#header-main-menu ul li a[href^="#"], a.button, a.button-dot, .slow-scroll').on("click", function (e) {
        if ($(this).attr('href') === '#')
        {
            e.preventDefault();
        } else {
            if ($(window).width() < 1024) {
                if (!$(e.target).is('.sub-arrow'))
                {
                    $('html, body').animate({scrollTop: $(this.hash).offset().top - 76}, 1500);
                    $('.menu-holder').removeClass('show');
                    $('#toggle').removeClass('on');
                    return false;
                }
            } else
            {
                $('html, body').animate({scrollTop: $(this.hash).offset().top - 76}, 1500);
                return false;
            }
        }
    });

    //Logo Click Fix
    $('.header-logo').on("click", function (e) {
        if ($(".page-template-onepage").length) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 1500);
        }
    });

    $(window).scrollTop(1);
    $(window).scrollTop(0);

    $('.single-post .num-comments a, .single-portfolio .num-comments a').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: $(this.hash).offset().top}, 2000);
        return false;
    });


    //Placeholder show/hide
    $('input, textarea').on("focus", function () {
        $(this).data('placeholder', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    });
    $('input, textarea').on("blur", function () {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });

    //Fit Video
    $(".site-content, .portfolio-item-wrapper").fitVids({ignore: '.wp-block-embed__wrapper'});

    //Fix for Default menu
    $(".default-menu ul:first").addClass('sm sm-clean main-menu');

    //Set menu
    $('.main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8,
        markCurrentTree: true
    });

    var $mainMenu = $('.main-menu').on('click', 'span.sub-arrow', function (e) {
        var obj = $mainMenu.data('smartmenus');
        if (obj.isCollapsible()) {
            var $item = $(this).parent(),
                    $sub = $item.parent().dataSM('sub');
            $sub.dataSM('arrowClicked', true);
        }
    }).bind({
        'beforeshow.smapi': function (e, menu) {
            var obj = $mainMenu.data('smartmenus');
            if (obj.isCollapsible()) {
                var $menu = $(menu);
                if (!$menu.dataSM('arrowClicked')) {
                    return false;
                }
                $menu.removeDataSM('arrowClicked');
            }
        }
    });

    //Show-Hide header sidebar
    $('#toggle').on('click', multiClickFunctionStop);

    $(window).on('load', function () {

        $('.section-title-holder').trigger("sticky_kit:recalc");

        //Fix for hash
        var hash = location.hash;
        if ((hash != '') && ($(hash).length))
        {
            $('html, body').animate({scrollTop: $(hash).offset().top - 77}, 1);
        }
        
        fixForBlogThumbnailSize();

        $('.doc-loader').fadeOut(600);
    });


    $(window).on('resize', function () {
        fixForBlogThumbnailSize();
        setActiveMenuItem();
    });

    $(window).on('scroll', function () {
        setActiveMenuItem();
    });





//------------------------------------------------------------------------
//Helper Methods -->
//------------------------------------------------------------------------


    function multiClickFunctionStop() {
        $('#toggle').off("click");
        $('#toggle').toggleClass("on");
        if ($('#toggle').hasClass("on"))
        {
            $('.menu-holder').addClass('show');
            $('#toggle').on("click", multiClickFunctionStop);
        } else
        {
            $('.menu-holder').removeClass('show');
            $('#toggle').on("click", multiClickFunctionStop);
        }
    }

    function showAllAnimatedElements() {
        $('.blog-item-holder.animate').addClass('show-it');
    }

    function loadMoreArticleIndex() {
        if (parseInt(ajax_var.posts_per_page_index) < parseInt(ajax_var.total_index)) {
            $('.more-posts').css('visibility', 'visible');
            $('.more-posts').animate({opacity: 1}, 1500);
        } else {
            $('.more-posts').css('display', 'none');
        }

        $('.more-posts:visible').on('click', function () {
            count++;
            loadArticleIndex(count);
            $('.more-posts').css('display', 'none');
            $('.more-posts-loading').css('display', 'inline-block');
        });
    }

    function loadArticleIndex(pageNumber) {
        $.ajax({
            url: ajax_var.url,
            type: 'POST',
            data: "action=infinite_scroll_index&page_no_index=" + pageNumber + '&loop_file_index=loop-index',
            success: function (html) {
                $(".blog-holder").append(html);
                $(".blog-holder").on('ajaxComplete', function () {

                    setTimeout(function () {
                        fixForBlogThumbnailSize();
                        showAllAnimatedElements();
                    }, 200);

                    if (count == ajax_var.num_pages_index)
                    {
                        $('.more-posts').css('display', 'none');
                        $('.more-posts-loading').css('display', 'none');
                        $('.no-more-posts').css('display', 'inline-block');
                    } else
                    {
                        $('.more-posts').css('display', 'inline-block');
                        $('.more-posts-loading').css('display', 'none');
                    }
                });
            }
        });
        return false;
    }

    function setToltip() {
        $(".tooltip").tipper({
            direction: "top",
            follow: true
        });
    }

    function fixForFooterNoContent() {
        if (($('.footer-content').html().replace(/\s/g, '') == '') || ($('.footer-content').html().replace(/\s/g, '') == '<divclass="footer-logo-divider"></div><divclass="footer-social-divider"></div>'))
        {
            $('.footer').addClass('hidden');
        }
    }

    function fixForBlogThumbnailSize() {
        $('.blog-holder .blog-item-holder.has-post-thumbnail').each(function () {                        
            if ($(this).find('.post-thumbnail').height() > ($(this).find('.entry-holder').innerHeight() + 80)) {
                $(this).addClass('is-smaller');
                $(this).find('.post-thumbnail img').height($(this).find('.entry-holder').innerHeight() + 80);
            }
        });
    }

    function is_touch_device() {
        return !!('ontouchstart' in window);
    }

    function setActiveMenuItem() {
        var currentSection = null;
        $('.section').each(function () {
            var element = $(this).attr('id');
            if ($('#' + element).is('*')) {
                if ($(window).scrollTop() >= $('#' + element).offset().top - 115)
                {
                    currentSection = element;
                }
            }
        });
        $('#header-main-menu ul li').removeClass('active').find('a[href*="#' + currentSection + '"]').parent().addClass('active');
    }

})(jQuery);