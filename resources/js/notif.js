  $("#success").click(function () {
      $(".notify").toggleClass("active");
      $("#notifyType").toggleClass("success");
      
      setTimeout(function(){
        $(".notify").removeClass("active");
        $("#notifyType").removeClass("success");
      },3000);
    });

    $("#failure").click(function () {
      $(".notify").addClass("active");
      $("#notifyType").addClass("failure");
      
      setTimeout(function(){
        $(".notify").removeClass("active");
        $("#notifyType").removeClass("failure");
      },3000);
    });