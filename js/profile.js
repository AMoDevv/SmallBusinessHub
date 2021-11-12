$(document).ready(() => {
  const $settingsBtn = $(".my-profile-settings-btn");
  const $navDropdown = $(".nav-menu");
  $navDropdown.hide();

  $($settingsBtn).on("click", () => {
    $navDropdown.show();
  });

  $($settingsBtn).on("mouseover", () => {
    $navDropdown.show();
  });

  $navDropdown.on("mouseleave", () => {
    $navDropdown.hide();
  });

  $(".like_button").on("click", clk);

  function clk(e) {
    console.log(e.target.attributes["value"].value);
    console.log(e.target.attributes["value-liked"].value);
    post_id = e.target.attributes["value"].value;

    $.ajax({
      type: "POST",
      url: "./phpscripts/save.php",
      data: {
        post_id: post_id,
        liked: e.target.attributes["value-liked"].value,
      },
    }).done(function (msg) {
      console.log(msg);
      $("#post_" + post_id).load(
        "./phpscripts/getPost.php",
        {
          post_id: post_id,
        },
        () => {
          $("#post_" + post_id + " .like_button").on("click", clk);
        }
      );
    });
  }

  $('.generalUserEditBtn').click(function(){
    window.location.href="editGeneralUser.php";
  });
  $('.businessUserEditBtn').click(function(){
    window.location.href="editBusinessUser.php";
  });
});
