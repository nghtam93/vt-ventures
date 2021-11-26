$(document).ready(function(){

    /*----Languages---*/
    $('.languages .languages-item').click(function() {
        $(this).next().toggleClass('dropdown-languages');
        isClicked = true;
    });

    $('.languages ul li').click(function() {
        var $liIndex = $(this).index() + 1;
        $('.languages ul li').removeClass('active');
        $('.languages ul li:nth-child('+$liIndex+')').addClass('active');
        var $getLang = $(this).html();
        $('.languages .languages-item').html($getLang);

        $('.languages>.wpml-ls').removeClass('dropdown-languages')
    });


    var header_sticky=$("header.-fix")
    if($('body').hasClass( "home" )){
        $(window).scroll(function(){
            $(this).scrollTop()>5?header_sticky.addClass("is-active"):header_sticky.removeClass("is-active")
        })
    }else{
        header_sticky.addClass("is-active")
    }


    // Click id a
    var jump=function(e)
    {
        if (e){
           e.preventDefault();
           var target = $(this).attr("href");
        }else{
           var target = location.hash;
        }

        $('html,body').animate({scrollTop: $(target).offset().top},2000,function(){
           location.hash = target;
        });
    }

    $('a[href^="#"]').bind("click", jump);

    $(document).on('click', 'a[href^="#"]', function (e) {

        $(this).closest('nav').find('li').removeClass('active')
        $(this).closest('li').addClass('active')

        //Close menu mb
        if($('.nav__mobile').hasClass('active')){
            $('.nav__mobile').removeClass('active')
        }
        $('body').removeClass('modal-open')
    });



    //-------------------------------------------------
    // Menu
    //-------------------------------------------------
    $('.nav__mobile--close').click(function(e){
        $('.nav__mobile').removeClass('active')
        $('body').removeClass('modal-open')
    });
    $('.menu-mb__btn').click(function(e){
        e.preventDefault()
        if($('body').hasClass('modal-open')){
            $('.menu-mb__btn').removeClass('active')
            $('.nav__mobile').removeClass('active')
            $('body').removeClass('modal-open')
        }else{
            $('.menu-mb__btn').addClass('active')
            $('body').addClass('modal-open')
            $('.nav__mobile').addClass('active')
        }
    });

    //back to top
    var back_to_top=$(".back-to-top"),offset=220,duration=500;
    $(document).on("click",".back-to-top",function(o){
        return o.preventDefault(),$("html, body").animate({scrollTop:0},duration),!1
    });

    //check home
    if($('body').hasClass( "home" )){

        new WOW().init();
        $('.home-work__slider').slick({
             infinite: false,
             slidesToShow: 1,
             slidesToScroll: 1,
             autoplay: false,
             mobileFirst: true,
             prevArrow: '<span class="icon-arrow-left slick-prev slick-arrow"></span>',
            nextArrow: '<span class="icon-arrow-right slick-next slick-arrow"></span>',
             responsive: [
                {
                   breakpoint: 767,
                   settings: "unslick"
                }
             ]
          });

        $('.home-service__slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false,
            easing: "linear",
            prevArrow: '<span class="icon-arrow-left slick-prev slick-arrow"></span>',
            nextArrow: '<span class="icon-arrow-right slick-next slick-arrow"></span>',
            responsive: [
                {
                  breakpoint: 991,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false
                  }
                },
                {
                  breakpoint: 575,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false
                  }
                }
            ]
        });
    }
    if($('body').hasClass( "single" )){
        var single_share = $('.single__share')
        var share_offset = $('.single__share').offset().top

        $(window).scroll(function(){
            $(this).scrollTop()>share_offset?single_share.addClass("is-active"):single_share.removeClass("is-active")
        })

        console.log(single_share)
    }

});


