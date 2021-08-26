(function($){
  $(window).load(function() {
	  
    function camelToUnderscore(key) {
      var result = key.replace( /([A-Z])/g, " $1" );
      return result.split(' ').join('-').toLowerCase();
    }
	  
	function clamp(number, min, max) {
	  return Math.max(min, Math.min(number, max));
	}

    setTimeout(function(){
    
      //rework animation reveals to use IntersectionObservor instead of waypoints
      // const animationHook = document.querySelectorAll('.et-waypoint');
      const animationHook = document.querySelectorAll('[data-animation-style], .et-waypoint');
      
      observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
      
          if(entry.target.getAttribute("data-animation-style")) {
              var animStyle = entry.target.getAttribute("data-animation-style")
            , animRepeat = entry.target.getAttribute("data-animation-repeat")
            , animDuration = entry.target.getAttribute("data-animation-duration")
            , animDelay = entry.target.getAttribute("data-animation-delay")
            , animIntensity = entry.target.getAttribute("data-animation-intensity")
            , animStartOpacity = entry.target.getAttribute("data-animation-starting-opacity")
            , animSpeedCurve = entry.target.getAttribute("data-animation-speed-curve")
            // , animModuleWrapper = entry.target.parent(".et_pb_button_module_wrapper")
        
            
            var [ t , e ] = camelToUnderscore(animStyle).split('-');
        
            n = animIntensity.replace("%", "");
            switch (t) {
              case "slide":
              switch (e) {
                case "top":
        
                  entry.target.style.transform = "translate3d(0, " + clamp((-2 * n), -85, 85) + "%, 0)"
                  break;
                case "right":
        
                  entry.target.style.transform = "translate3d(" + clamp((2 * n), -85, 85) + "%, 0, 0)"
                  break;
                case "bottom":
        
                  entry.target.style.transform = "translate3d(0, " + clamp((2 * n), -85, 85) + "%, 0)"
                  break;
                case "left":
        
                  entry.target.style.transform = "translate3d(" + clamp((-2 * n), -85, 85) + "%, 0, 0)"
                  break;
                default:
        
                  entry.target.style.transform = "scale3d(" + (i = .01 * (100 - n)) + ", " + i + ", " + i + ")"
              }
              break;
              case "zoom":
              var i = .01 * (100 - n);
              switch (e) {
                case "top":
                case "right":
                case "bottom":
                case "left":
                default:
        
                  entry.target.style.transform = "scale3d(" + i + ", " + i + ", " + i + ")"
              }
              break;
              case "flip":
              switch (e) {
                case "right":
        
                  entry.target.style.transform = "perspective(2000px) rotateY(" + Math.ceil(.9 * n) + "deg)"
                  break;
                case "left":
        
                  entry.target.style.transform = "perspective(2000px) rotateY(" + -1 * Math.ceil(.9 * n) + "deg)"
                  break;
                case "top":
                default:
        
                  entry.target.style.transform = "perspective(2000px) rotateX(" + Math.ceil(.9 * n) + "deg)"
                  break;
                case "bottom":
        
                  entry.target.style.transform = "perspective(2000px) rotateX(" + -1 * Math.ceil(.9 * n) + "deg)"
              }
              break;
              case "fold":
              switch (e) {
                case "top":
        
                  entry.target.style.transform = "perspective(2000px) rotateX(" + -1 * Math.ceil(.9 * n) + "deg)"
                  break;
                case "bottom":
        
                  entry.target.style.transform = "perspective(2000px) rotateX(" + Math.ceil(.9 * n) + "deg)"
                  break;
                case "left":
        
                  entry.target.style.transform = "perspective(2000px) rotateY(" + Math.ceil(.9 * n) + "deg)"
                  break;
                case "right":
                default:
        
                  entry.target.style.transform = "perspective(2000px) rotateY(" + -1 * Math.ceil(.9 * n) + "deg)"
              }
              break;
              case "roll":
              switch (e) {
                case "right":
                case "bottom":
        
                  entry.target.style.transform = "rotateZ(" + -1 * Math.ceil(3.6 * n) + "deg)"
                  break;
                case "top":
                case "left":
                default:
        
                  entry.target.style.transform = "rotateZ(" + Math.ceil(3.6 * n) + "deg)"
              }
            }
        
            entry.target.style.animationDuration = animDuration
            entry.target.style.animationDelay = animDelay
            entry.target.style.animationDuration = animDuration
            entry.target.style.opacity = animStartOpacity.replace("%", "");
            entry.target.style.transitionTimingFunction = animSpeedCurve
          }
      
          if (entry.isIntersecting) {
            if (entry.target.getAttribute("data-animation-style")) {
              entry.target.classList.add(entry.target.dataset.animationStyle);
            }
      
            entry.target.classList.add('et-animated');
      
      
          }
        });
      }, {
        threshold: 0.1,
		root: null
      });
      animationHook.forEach(el => {
        observer.observe(el);
      });
      
    }, 500);
  })
})(jQuery);