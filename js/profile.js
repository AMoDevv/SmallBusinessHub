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

  $(".like_button").on("click", (e) => {
    console.log(e.target.attributes["value"].value);
    console.log(e.target.attributes["value-liked"].value);

    $.ajax({
      type: "POST",
      url: "./phpscripts/save.php",
      data: {
        post_id: e.target.attributes["value"].value,
        liked: e.target.attributes["value-liked"].value,
      },
    }).done(function (msg) {
      console.log(msg);
      alert("Data Saved: " + msg);
    });
  });
});
