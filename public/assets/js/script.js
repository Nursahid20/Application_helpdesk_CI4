function previewImg(){
  const img = document.querySelector("#user_image");
  const imgShow = document.querySelector(".img-preview");


  const fileImg = new FileReader();
  fileImg.readAsDataURL(img.files[0]);

  fileImg.onload = function(e){
      imgShow.src = e.target.result;
  }
}



  $( ".input" ).focus(function() {
    $(this).parent(".input-container").addClass("infocus");
  })
  $( ".input" ).focusout(function() {
    $(this).parent(".input-container").removeClass("infocus");
  });
  $( ".select" ).focus(function() {
    $(this).parent(".select-container").addClass("infocus");
  })
  $( ".select" ).focusout(function() {
    $(this).parent(".select-container").removeClass("infocus");
  });
  $( ".select[disabled]" ).parent(".select-container").addClass("disabled");
