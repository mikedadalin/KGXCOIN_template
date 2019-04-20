var $ = jQuery.noConflict();

(function ($) { "use strict";
	

	var $window = $(window),
		$body = $('body'),
		$wrapper = $('#wrapper'),
		$header = $('#header'),
		$headerWrap = $('#header-wrap'),
		$content = $('#content'),
		$pagemenu = $('#page-menu');


	$(document).on("pageInit", function(e, id, page) {



	});


/* ========================================================================= */
/*	Sidebar Toggle on Mobile
/* ========================================================================= */
      var sidebar = $('.sidebar'),
          sidebarToggle = $('.sidebar-toggle');
      sidebarToggle.on('click', function() {
        $(this).addClass('sidebar-open');
        sidebar.addClass('open');
      });
      $('.sidebar-close').on('click', function() {
        sidebarToggle.removeClass('sidebar-open');
        sidebar.removeClass('open');
      });


/* ========================================================================= */
/*	WOW
/* ========================================================================= */
	var wow = new WOW(
	  {
	    boxClass:     'ani',       
	    animateClass: 'animated',  
	    offset:       0,
	    mobile:       true,
	    live:         true, 
	    callback:     function(box) {
	      
	    },
	    scrollContainer: null 
	  }
	);
	wow.init();


/* ========================================================================= */
/*	Num Pad
/* ========================================================================= */
	if($(".chikuanpw").size() > 0) {
		$.fn.numpad.defaults.gridTpl = '<div class="table modal-content"><h3>输入取款密码</h3></div>';
		$.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
		$.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
		$.fn.numpad.defaults.displayCellTpl = '<div class="displayCell"></div>';
		$.fn.numpad.defaults.rowTpl = '<div class="rowll"></div>';
		$.fn.numpad.defaults.cellTpl = '<div class="cell"></div>';
		$.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default"></button>';
		$.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
		$.fn.numpad.defaults.hidePlusMinusButton = true;
		$.fn.numpad.defaults.hideDecimalButton = true;
		$.fn.numpad.defaults.textDone = '确定';
		$.fn.numpad.defaults.textDelete = '←';
		$.fn.numpad.defaults.textClear = '清除';
		$.fn.numpad.defaults.textCancel = '取消';
		$.fn.numpad.defaults.onKeypadCreate = function(){
		    $(this).find('.done').addClass('btn-primary');
		    del = $(this).find('.del').parent();
		    $(this).find('.clear, .cancel, .neg, .sep').parent().remove();
		    $(this).find('.rowll:nth-child(6) .cell:first-child').before(del);
		  };
	}

	if($(".chikuanpw").size() > 0) {
	  $('.chikuanpw').numpad({
	    onKeypadClose: function(){
	      $(this).find('.chikuanpw').val($(this).find('.nmpd-display').val());
	    }
	  });
	}


	/* ========================================================================= */
	/*	Sign In
	/* ========================================================================= */
	$("#to-recover").on("click", function() {
        $("#signinform").slideUp(), $("#recoverform").fadeIn()
    })


	/* ========================================================================= */
	/*	Floating-labels 
	/* ========================================================================= */
 	$(".floating-labels .form-control").on("focus blur", function(i) {
        $(this).parents(".form-group").toggleClass("focused", "focus" === i.type || this.value.length > 0)
    })

	/* ========================================================================= */
	/*	Page Preloader
	/* ========================================================================= */
	
	// window.load = function () {
	// 	document.getElementById('preloader').style.display = 'none';
	// }

	$(window).on("load",function(){
		$('#preloader').fadeOut('slow',function(){$(this).remove();});
	});


	/* ========================================================================= */
	/*	Portfolio Filtering Hook
	/* =========================================================================  */
	$('.play-icon i').click(function() {
		var video = '<iframe allowfullscreen src="' + $(this).attr('data-video') + '"></iframe>';
		$(this).replaceWith(video);
	});


	/* ========================================================================= */
	/*	Portfolio Filtering Hook
	/* =========================================================================  */

	var portfolio_item = $('.portfolio-items-wrapper');
	if (portfolio_item.length) {
		var mixer = mixitup(portfolio_item);
	};

	/* ========================================================================= */
	/*	Testimonial Carousel
	/* =========================================================================  */
 
	//Init the slider
	$('.testimonial-slider').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		infinite: true,
        dots:true,
		arrows:false,
		autoplay: true,
  		autoplaySpeed: 2000,
  		responsive: [
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 2
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


	/* ========================================================================= */
	/*	Clients Slider Carousel
	/* =========================================================================  */
 
	//Init the slider
	$('.clients-logo-slider').slick({
		infinite: true,
		arrows:false,
		autoplay: true,
  		autoplaySpeed: 2000,
  		slidesToShow: 5,
  		slidesToScroll: 1,
	});


	/* ========================================================================= */
	/*	Company Slider Carousel
	/* =========================================================================  */
	$('.company-gallery').slick({
		infinite: true,
		arrows:false,
		autoplay: true,
  		autoplaySpeed: 2000,
  		slidesToShow: 5,
  		slidesToScroll: 1,
	});
	

	/* ========================================================================= */
	/*   Contact Form Validating
	/* ========================================================================= */


	$('#contact-submit').click(function (e) {

		//stop the form from being submitted
		e.preventDefault();

		/* declare the variables, var error is the variable that we use on the end
		to determine if there was an error or not */
		var error = false;
		var name = $('#name').val();
		var email = $('#email').val();
		var subject = $('#subject').val();
		var message = $('#message').val();

		/* in the next section we do the checking by using VARIABLE.length
		where VARIABLE is the variable we are checking (like name, email),
		length is a JavaScript function to get the number of characters.
		And as you can see if the num of characters is 0 we set the error
		variable to true and show the name_error div with the fadeIn effect. 
		if it's not 0 then we fadeOut the div( that's if the div is shown and
		the error is fixed it fadesOut. 
		
		The only difference from these checks is the email checking, we have
		email.indexOf('@') which checks if there is @ in the email input field.
		This JavaScript function will return -1 if no occurrence have been found.*/
		if (name.length == 0) {
			var error = true;
			$('#name').css("border-color", "#D8000C");
		} else {
			$('#name').css("border-color", "#666");
		}
		if (email.length == 0 || email.indexOf('@') == '-1') {
			var error = true;
			$('#email').css("border-color", "#D8000C");
		} else {
			$('#email').css("border-color", "#666");
		}
		if (subject.length == 0) {
			var error = true;
			$('#subject').css("border-color", "#D8000C");
		} else {
			$('#subject').css("border-color", "#666");
		}
		if (message.length == 0) {
			var error = true;
			$('#message').css("border-color", "#D8000C");
		} else {
			$('#message').css("border-color", "#666");
		}

		//now when the validation is done we check if the error variable is false (no errors)
		if (error == false) {
			//disable the submit button to avoid spamming
			//and change the button text to Sending...
			$('#contact-submit').attr({
				'disabled': 'false',
				'value': 'Sending...'
			});

			/* using the jquery's post(ajax) function and a lifesaver
			function serialize() which gets all the data from the form
			we submit it to send_email.php */
			$.post("sendmail.php", $("#contact-form").serialize(), function (result) {
				//and after the ajax request ends we check the text returned
				if (result == 'sent') {
					//if the mail is sent remove the submit paragraph
					$('#cf-submit').remove();
					//and show the mail success div with fadeIn
					$('#mail-success').fadeIn(500);
				} else {
					//show the mail failed div
					$('#mail-fail').fadeIn(500);
					//re enable the submit button by removing attribute disabled and change the text back to Send The Message
					$('#contact-submit').removeAttr('disabled').attr('value', 'Send The Message');
				}
			});
		}
	});


/* ========================================================================= */
/*	On scroll fade/bounce effect
/* ========================================================================= */
	// var scroll = new SmoothScroll('a[href*="#"]'); //has bug
	

/* ========================================================================= */
/*	Header Scroll Background Change
/* ========================================================================= */	
	$(window).scroll(function() {
	var scroll = $(window).scrollTop();
	 //console.log(scroll);
	if (scroll > 52) { //122
	    //console.log('a');
	    $(".navigation").addClass("sticky-header");
	    $("body").css("padding-top", '72px');
	} else {
	    //console.log('a');
	    $(".navigation").removeClass("sticky-header");
	    $("body").css("padding-top", '0px');
	}});


})(jQuery);


