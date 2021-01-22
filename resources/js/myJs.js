

    var button = document.getElementById("btn-slide-dis");
    var button2 = document.getElementById("btn-slide-dis-2");
    var button3 = document.getElementById("btn-slide-disx");
    var button4 = document.getElementById("btn-slide-dis-2x");
    var button6 = document.getElementById("btn-slide-disy");
    var button5 = document.getElementById("btn-slide-dis-2y");
    var buttonSch = document.getElementById("searching");

    // Disable the button on initial page load
    button.disabled = true;
    button.style.backgroundColor ="#EEF2FF";
    button.style.color ="#528CE0";    
   
    button3.disabled = true;   
    button3.style.backgroundColor ="#EEF2FF";
    button3.style.color ="#528CE0";

    //add event listener

        button.addEventListener('click', function(event) {
        button.disabled = true;
        button2.disabled = false;
        button2.style.backgroundColor ="";
        button2.style.color ="#9FA6B2";
        button.style.backgroundColor ="#EEF2FF";
        button.style.color ="#528CE0";

        button3.disabled = true ;
        button4.disabled = false;
        button3.style.backgroundColor ="#EEF2FF";
        button3.style.color ="#528CE0";
        button4.style.backgroundColor ="";
        button4.style.color ="#9FA6B2";
        buttonSch.style.display = "block";

    });

    button2.addEventListener('click', function(event) {
        button2.disabled = true;
        button.disabled = false;
        button.style.backgroundColor ="";
        button.style.color ="#9FA6B2";
        button2.style.backgroundColor ="#EEF2FF";
        button2.style.color ="#528CE0";

        button4.disabled = true;
        button3.disabled = false;
        button3.style.backgroundColor ="";
        button3.style.color ="#9FA6B2";
        button4.style.backgroundColor ="#EEF2FF";
        button4.style.color ="#528CE0";
        buttonSch.style.display = "none";


    });

    button3.addEventListener('click', function(event) {
     button3.disabled = true ;
     button4.disabled = false;
     button3.style.backgroundColor ="#EEF2FF";
     button3.style.color ="#528CE0";
     button4.style.backgroundColor ="";
     button4.style.color ="#9FA6B2";

     button.disabled = true;
     button2.disabled = false;
     button2.style.backgroundColor ="";
     button2.style.color ="#9FA6B2";
     button.style.backgroundColor ="#EEF2FF";
     button.style.color ="#528CE0";
      buttonSch.style.visibility = "visible";
 });

    button4.addEventListener('click', function(event) {
        button4.disabled = true;
        button3.disabled = false;
        button3.style.backgroundColor ="";
        button3.style.color ="#9FA6B2";
        button4.style.backgroundColor ="#EEF2FF";
        button4.style.color ="#528CE0";

        button2.disabled = true;
        button.disabled = false;
        button.style.backgroundColor ="";
        button.style.color ="#9FA6B2";
        button2.style.backgroundColor ="#EEF2FF";
        button2.style.color ="#528CE0";
        buttonSch.style.visibility = "hidden";

    });

    if (button5) {

      button5.addEventListener('click', function(event) {
        button2.disabled = true;
        button.disabled = false;
        button.style.backgroundColor ="";
        button.style.color ="#9FA6B2";
        button2.style.backgroundColor ="#EEF2FF";
        button2.style.color ="#528CE0";

        button4.disabled = true;
        button3.disabled = false;
        button3.style.backgroundColor ="";
        button3.style.color ="#9FA6B2";
        button4.style.backgroundColor ="#EEF2FF";
        button4.style.color ="#528CE0";

      });
    }
      if (button6) {
     button6.addEventListener('click', function(event) {
        button3.disabled = true ;
     button4.disabled = false;
     button3.style.backgroundColor ="#EEF2FF";
     button3.style.color ="#528CE0";
     button4.style.backgroundColor ="";
     button4.style.color ="#9FA6B2";

     button.disabled = true;
     button2.disabled = false;
     button2.style.backgroundColor ="";
     button2.style.color ="#9FA6B2";
     button.style.backgroundColor ="#EEF2FF";
     button.style.color ="#528CE0";

    });
   }
    jQuery(function() {


      jQuery('#showall').click(function() {
        jQuery('.targetDiv').show();
    });
      jQuery('.showSingle').click(function() {

        jQuery('.targetDiv').hide();
        jQuery('#div' + $(this).attr('target')).show();
    });
  });


    function nextSlide(){
        let activeSlide = document.querySelector('.slide.translate-x-0');
        activeSlide.classList.remove('translate-x-0');
        activeSlide.classList.add('-translate-x-full');

        let nextSlide = activeSlide.nextElementSibling;
        nextSlide.classList.remove('translate-x-full');
        nextSlide.classList.add('translate-x-0');
    }

    function previousSlide(){
        let activeSlide = document.querySelector('.slide.translate-x-0');
        activeSlide.classList.remove('translate-x-0');
        activeSlide.classList.add('translate-x-full');

        let previousSlide = activeSlide.previousElementSibling;
        previousSlide.classList.remove('-translate-x-full');
        previousSlide.classList.add('translate-x-0');
    }


     