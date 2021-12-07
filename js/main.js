$(document).ready(function(e){

    // we have to select our input[type='file']
    let $uploadfile = $("#register .upload-profile-image input[type='file']");

    $uploadfile.change(function(){
        // we going to use our uploaded image
        // as a parameter in our readURL method
        readURL(this);
    });

    // if the document is finished loading
    // and the form was submitted
    // then we call our handler function
    $("#reg-form").submit(function(event){
        let $password = $("#password");
        let $confirm = $("#confirm_pwd");
        let $error = $("#confirm-error");
        if($password.val() === $confirm.val()){
            return true;
        }else{
            $error.text("Password not match");
            // if our password and the confirm psw are not the same
            // we have to prevent our form from it default behavior
            // in other words: the form wont be submitted
            event.preventDefault();
        }
    });

});

// lets set the uploaded picture as the background image of our 
function readURL(input){
    // console.log(input);
    // if the input has file property and it has at least 1 element
    if(input.files && input.files[0]){
        // lets initialize the FileReader object
        let reader = new FileReader();
        // reader.onload is a handler this event is triggerent the 
        // reading operation is succesfully completed
        reader.onload = function(e){
            // we would like to change our img elements src attribute to the
            // element wich triggered the event : e.target.result
            $("#register .upload-profile-image .img").attr('src', e.target.result);
            // lets hide the camera image once our img is set
            $("#register .upload-profile-image .camera-icon").css({display:"none"});
        }
        //finally we convert it into a DataUrl
        reader.readAsDataURL(input.files[0]);
    }
} 