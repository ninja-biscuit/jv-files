$.fn.zonky = function() {
<<<<<<< HEAD
	
	var sliderTotalWidth = $('.slide-container').width();
	var sliderTotalheight = $('.slide-container').height();
	var sliderList = $('.slider-container > .slide-list').outerWidth();
	console.log(sliderTotalWidth - sliderList);
	$('.slider-container > .slide-container').width(sliderTotalWidth - sliderList);
	$(window).resize(function(){
		
		var sliderTotalWidth = $('.slider-container').width();
		if($(window).width() <= 767){
			$('.slider-container > .slide-container').width('100%');
		} else{
			$('.slider-container > .slide-container').width(sliderTotalWidth - 330);
		}
	});
		
=======
	function slideContainerWidth(){
		var sliderTotalWidth = $('.slide-container').width();
		var sliderList = $('.slider-container > .slide-list').outerWidth();
		var outSideWidth = $('.slider-container > .slide-container').width(sliderTotalWidth - sliderList);
		return 	outSideWidth;
	};
	slideContainerWidth();
	/*
	$(window).resize(function(){
		slideContainerWidth();
	});
	*/
>>>>>>> origin/master
	// slider
	var listLength = $('.slider-container > .slide-list > li').length;		

	$('.slider-container > .slide-list > li').each(function(){
		var listSliderImg = $('img', this).attr('src');
		var listSliderH3 = $('h3', this).html();
		var listSliderParagraph = $('p', this).html();
		var listSliderLink =  $(this).data('link');
<<<<<<< HEAD
		var sliderStructure = '<li class="slide"><img src="img/pixel.gif" alt="#" style="background-image:url('+ listSliderImg +')" /><div class="caption-container"><h3>'+ listSliderH3 +'</h3><p>'+ listSliderParagraph +'</p><a href="'+ listSliderLink +'">LEER MÁS</a></div></li>';
=======
		var sliderStructure = '<li class="slide"><img src="'+ listSliderImg +'" alt="#" /><div class="caption-container"><h3>'+ listSliderH3 +'</h3><p>'+ listSliderParagraph +'</p><a href="'+ listSliderLink +'">LEER MÁS</a></div></li>';
>>>>>>> origin/master
		$('.slide-container ul').append(sliderStructure);			
	});
	var autoSlide;
	// probando automático
	function changeSlide(){
		var sideListLength = $('.slider-container > .slide-list > li').length;
		var currentSlide = $('.slide-list > li.active').index();
		if(currentSlide < (sideListLength - 1)){
			// pasar estado activo al siguiente
			$('.slide-list > li.active').each(function(){
				$(this).next().addClass('active');
				$(this).removeClass('active');
				$('.slide-container ul').fadeOut(1, function(){
<<<<<<< HEAD
					$(this).css('top', (currentSlide + 1) * (sliderTotalheight* -1));
=======
					$(this).css('top', (currentSlide + 1) * (450* -1));
>>>>>>> origin/master
					$(this).fadeIn(200);
				});
			});
		} else if(currentSlide == (sideListLength - 1)){
			$('.slide-list > li').removeClass('active');
			$('.slide-list > li').first().addClass('active');
			$('.slide-container ul').css('top', 0);
		}
	}
	autoSlide = window.setInterval(changeSlide, 3000);
	// cambiar slide manual
	var listSlideOuterHeight = $('.slide-container > ul > .slide').outerHeight();
	$('.slide-list > li').click(function(){
		clearInterval(autoSlide);
		var indexClicked = $(this).index();
		$('.slide-list > li').removeClass('active');
		$(this).addClass('active')
		$('.slide-container ul').fadeOut(1, function(){
<<<<<<< HEAD
			$(this).css('top', indexClicked * sliderTotalheight * -1);
=======
			$(this).css('top', indexClicked * 450 * -1);
>>>>>>> origin/master
			$(this).fadeIn(200);
		});
	});	
};