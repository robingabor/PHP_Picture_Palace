

<section class="d-flex justify-content-center text-center" id="register">
        
    <div class="row m-0">
        <div class="col-lg-4 offset-lg-2">
            <div class="text-center pb-5 text-nowrap">
                <h1 class="login-title text-white">Register</h1>
                <p class="p-1 m-0 font-ubuntu text-white font-weight-bold" style="letter-spacing:2px;">Register and enjoy additional features</p>
                <span class="font-ubuntu"><h4 class="text-warning">Already have an account? <a href="login.php" class="text-white font-weight-bold">Login</a> </h4></span>
            </div>
            
            <div class="upload-profile-image d-flex justify-content-center pb-5">

                <div class="text-center">
                    <div class="d-flex justify-content-center">
                        <img class="camera-icon" src="assets/icons8-camera-50.png" alt="camera">
                    </div>
                
                    <img src="assets/instagram-profile-icon-by-Vexels.png" style="width:200px;height:200px;background:white" class="img rounded-circle" alt="profile">
                    <h4 class="form-text text-white font-weight-bold text-warning"> Choose Image</h4>
                    <!-- HTML5 magic: we can attach  this input field to our "reg-form" form. -->
                    <input form="reg-form" type="file" class="form-control-file" name="profileUpload" id="upload-profile">
                </div>             

            </div>

        <div class="d-flex justify-content-center">
            <form action="registration.php"  method="post" enctype="multipart/form-data" id="reg-form">
                <div class="form-row">
                    <div class="col">
                        <input type='text' value="{USERNAME}" name='username' id='username' class='form-control' placeholder='Username'>
                        </div>                                
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type='email' value="{EMAIL}" required name='email' id='email' class='form-control' placeholder='Email'>
                            </div>
                        </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="password" required name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="col">
                            <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Confirm Password">
                            <!--  Here comes the error if it is any -->
                            <small id="confirm-error" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="form-check form-check">
                        <input type="checkbox" required name="agreement" class="form-check-input">
                        <label for="agreement" class="form-check-label font-ubuntu text-black-50">I agree<a href="#"> terms, conditions and policy</a></label>
                    </div>
                    <div class="submit-btn text-center my-5">
                        <button type="submit" name="submit" class="btn btn-warning rounded-pill text-dark px-5">Continue</button>
                    </div>
                </form>
        </div>

        </div>

    </div>
</section>



