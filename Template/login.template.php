<section class="d-flex justify-content-center text-center" id="login">
        
    <div class="row m-0">

        <div class="col-lg-4 offset-lg-2">

            <div class="text-center pb-5">
                <h1 class="login-title text-dark">Login</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Login and enjoy additional features</p>
                <span class="font-ubuntu text-black-50">Create a new<a href="registration.php">Account</a> </span>
            </div>

            <div class="upload-profile-image d-flex justify-content-center pb-5">
                <div class="text-center">                    
                
                    <img src='{IMG_SRC}' style='width:200px;height:200px;background:white' class='img rounded-circle' alt='profile'>                    
                    
                </div>             

        </div>
        <!-- Login Form -->
        <div class="d-flex justify-content-center">
            <form action="login.php"  method="post" enctype="multipart/form-data" id="login-form">
                
                    <div class="form-row my-4">
                        <div class="col">
                            <input type='email' required name='email' id='email' class='form-control' placeholder='Email'>
                            </div>
                        </div> 

                    <div class="form-row my-4">
                        <div class="col">
                            <input type="password" required name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                    </div>                    
                   
                    <div class="submit-btn text-center my-5">
                        <button type="submit" name ="submit" class="btn btn-warning rounded-pill text-dark px-5">Login</button>
                    </div>
                </form>

        </div>

    </div>

</div>

</section>