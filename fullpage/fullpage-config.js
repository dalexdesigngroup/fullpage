(function($){
 $(window).load(function() {
	 
	 //mobile / tablet check	 
	 if ((window.matchMedia('(max-width: 480px)').matches) && ($("body").hasClass("fullpage-disable-mobile"))) {
		 console.log("fullpage disabled in mobile view.");
		 return
	 } else if ((window.matchMedia('(max-width: 980px)').matches) && ($("body").hasClass("fullpage-disable-tablet"))) {
		 console.log("fullpage disabled in tablet view.");
		 return
	 }
	 
 	//bind the slides to arrow keys

	 window.addEventListener("keydown", function (event) {
	  if (event.defaultPrevented) {
		return;
	  }

	  switch (event.key) {
		case "Down": // IE/Edge specific value
		case "ArrowDown":
		  $.fn.fullpage.moveSlideRight()
		  break;
		case "Up": // IE/Edge specific value
		case "ArrowUp":
		  $.fn.fullpage.moveSlideLeft()
		  break;
		case "Left": // IE/Edge specific value
		case "ArrowLeft":
		  $.fn.fullpage.moveSlideLeft()
		  break;
		case "Right": // IE/Edge specific value
		case "ArrowRight":
		  $.fn.fullpage.moveSlideRight()
		  break;
		default:
		  return;
	  }
	  // Cancel the default action to avoid it being handled twice
	  event.preventDefault();
	}, true);
	 
	 //
	 if (($("body").hasClass("page-template-page_template-fullpage"))
		 && (!$('#page-container').hasClass('et-fb-iframe-ancestor'))//don't trigger it on frontend editor
		) {
     //need to delay for some reason or the reveal animations all trigger on load
    setTimeout(fullPageSetup, 300);

    function fullPageSetup() {
      //keep videos playing
      document.querySelectorAll('video').forEach((video) => {
        video.setAttribute('data-keepplaying', 'true');
      })

      // element that will be wrapped
      var slideParent = document.querySelector('.fullpage-slide').parentElement;
      slideParent.classList.add('section');
      slideParent.style.display = 'flex'
      slideParent.style.flexDirection = 'row'
      slideParent.querySelectorAll('.fullpage-slide').forEach((slide) => {
        slide.classList.add('slide');
        slide.style.flex = '0 0 92vw'
      })
      // create wrapper container, insert into DOM
      var wrapper = document.createElement('div');
      wrapper.classList.add('fullpage-container');
      slideParent.parentNode.insertBefore(wrapper, slideParent);
      wrapper.appendChild(slideParent);

      $('.fullpage-container').fullpage({
        scrollHorizontally: true,
		keyboardNavigation: false,
		parallax: true,
		parallaxKey: "QU5ZX0FodGNHRnlZV3hzWVhnPXY1bA==",
        parallaxOptions: {
			type: "reveal",
			percentage: 62,
			property: "translate"
		},
		slidesNavigation: false,
		scrollHorizontally: true,
		scrollHorizontallyKey: "QU5ZX1UycmMyTnliMnhzU0c5eWFYcHZiblJoYkd4NWhLbA==",
		scrollOverflow: true

      });

    }


		 
	 }
 });
})(jQuery);


