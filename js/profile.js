$(document).ready(() => 
{ 
    const $settingsBtn = $('.my-profile-settings-btn');
    const $navDropdown = $('.nav-menu');
    $navDropdown.hide();

    $($settingsBtn).on('click',()=>{
     $navDropdown.show();
    });

    $($settingsBtn).on('mouseover',()=>{
     $navDropdown.show();
    });
    
    $navDropdown.on('mouseleave', () => {
      $navDropdown.hide();
    });
});