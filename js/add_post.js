$(document).ready(function(){
    $('#uploadBtn').click(function(){
        if($('#file-upload').val() == "" || $('#description').val() == "" || $('#tags').val() == ""){
            $('#generalAlert').fadeOut();
            $('#generalAlert').fadeIn();
        }
        else{
            $('#addPostForm').submit();
        }
    });
});