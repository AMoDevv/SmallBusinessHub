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

  $(".generalUserEditBtn").click(function () {
    window.location.href = "editGeneralUser.php";
  });
  $(".businessUserEditBtn").click(function () {
    window.location.href = "editBusinessUser.php";
  });
});
