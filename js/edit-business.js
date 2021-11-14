$(document).ready(function(){

    //no validation for website url's because they are not required
    
    $('#editProfileBtn').click(function(){
        var validForm = true;

        if($('#business_name').val() == ''){
            $('#business_name').css("border", "2px solid red");
            $('#business_name_error').fadeOut();
            $('#business_name_error').fadeIn();
            validForm = false;
        }
        else{
            $('#business_name').css("border", "");
            $('#business_name_error').fadeOut();
        }

        if($('#address').val() == ''){
            $('#address').css("border", "2px solid red");
            $('#address_error').fadeOut();
            $('#address_error').fadeIn();
            validForm = false;
        }
        else{
            $('#address').css("border", "");
            $('#address_error').fadeOut();
        }

        if($('#address_number').val() == ''){
            $('#address_number').css("border", "2px solid red");
            $('#address_number_error').fadeOut();
            $('#address_number_error').fadeIn();
            validForm = false;
        }
        else{
            $('#address_number').css("border", "");
            $('#address_number_error').fadeOut();
        }

        if($('#district').val() == ''){
            $('#district').css("border", "2px solid red");
            $('#district_error').fadeOut();
            $('#district_error').fadeIn();
            validForm = false;
        }
        else{
            $('#district').css("border", "");
            $('#district_error').fadeOut();
        }

        if($('#city').val() == ''){
            $('#city').css("border", "2px solid red");
            $('#city_error').fadeOut();
            $('#city_error').fadeIn();
            validForm = false;
        }
        else{
            $('#city').css("border", "");
            $('#city_error').fadeOut();
        }

        if($('#phone_number').val() == ''){
            $('#phone_number').css("border", "2px solid red");
            $('#phone_number_error').fadeOut();
            $('#phone_number_error').fadeIn();
            validForm = false;
        }
        else{
            $('#phone_number').css("border", "");
            $('#phone_number_error').fadeOut();
        }

        if($('#email').val() == ''){
            $('#email').css("border", "2px solid red");
            $('#email_error').fadeOut();
            $('#email_error').fadeIn();
            validForm = false;
        }
        else{
            $('#email').css("border", "");
            $('#email_error').fadeOut();
        }

        if($('#description').val() == ''){
            $('#description').css("border", "2px solid red");
            $('#description_error').fadeOut();
            $('#description_error').fadeIn();
            validForm = false;
        }
        else{
            $('#description').css("border", "");
            $('#description_error').fadeOut();
        }

        if(validForm){
            $('#editProfileForm').submit();
        }
    });
});