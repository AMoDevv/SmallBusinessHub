console.log("script connected");
$(document).ready(function(){
    
    //save button clicked on edit profile page
    $('#editProfileBtn').click(function(){
        var emailValidator = /^\S+@\S+\.\S+$/;
        //validate form fields
        var validForm = true;
        if($('#first_name').val() == ''){
            $('#first_name').css("border", "2px solid red");
            $('#first_name_error').fadeOut();
            $('#first_name_error').fadeIn();
            validForm = false;
        }
        else{
            $('#first_name').css("border", "");
            $('#first_name_error').fadeOut();
        }
        if($('#last_name').val() == ''){
            $('#last_name').css("border", "2px solid red");
            $('#last_name_error').fadeOut();
            $('#last_name_error').fadeIn();
            validForm = false;
        }
        else{
            $('#last_name').css("border", "");
            $('#last_name_error').fadeOut();
        }
        if($('#email').val() == ''){
            $('#email').css("border", "2px solid red");
            $('#email_error').fadeOut();
            $('#email_error').fadeIn();
            validForm = false;
        }
        else if(!emailValidator.test($('#email').val())){
            $('#email').css("border", "2px solid red");
            $('#email_error').fadeOut();
            $('#email_error').fadeIn();
            validForm = false;
        }
        else{
            $('#email').css("border", "");
            $('#email_error').fadeOut();
        }
        if($('#gender').val() == ''){
            $('#gender').css("border", "2px solid red");
            $('#gender_error').fadeOut();
            $('#gender_error').fadeIn();
            validForm = false;
        }
        else{
            $('#gender').css("border", "");
            $('#gender_error').fadeOut();
        }

        if(validForm){
            $('#editProfileForm').submit();
        }
    });
});

