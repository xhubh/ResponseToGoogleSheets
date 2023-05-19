const hamburgerMenu = document.querySelector("#hamburger-menu");
const navLinks = document.querySelector("#nav-links");

hamburgerMenu.addEventListener("click", function () {
  navLinks.classList.toggle("active");
});
jQuery(document).ready(function ($) {
  $("#post-to-sheet").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: local_ajax_object.ajax_url,
      data: formData + "&action=submit_form",
      dataType: "html",
      success: function (data) {
        $(".form-wrapper").replaceWith(
          "<p class='submitted-form'>Your form has been successfully submitted.</p>"
        );
      },
      error: function (data) {
        $("#result").html('<div class="alert alert-danger">Error!</div>');
      },
    });
  });
});
