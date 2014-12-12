<?php include 'header.php' ?>

  <div class="container">

    <div class="row center-scr">
      <div class="span4 offset4 well">

        <legend>Please Sign In</legend>

        <?php if (isset($error) && $error): ?>
          <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
          </div>
        <?php endif; ?>        <?php echo form_open('login/login_user') ?>

        <input type="text" id="email" class="span4" name="email" placeholder="Email Address" required>
        <input type="password" id="password" class="span4" name="password" placeholder="Password" required>

        <!--<label class="checkbox">
          <input type="checkbox" name="remember" value="1"> Remember Me
        </label>-->

        <button type="submit" name="submit" class="btn btn-info btn-block">Sign in</button>

        </form>
          <a data-toggle="modal" href="#myModal"><i class="icon-user"></i> New User</a>

      </div>
    </div>

    <div class="row">
      <div class="span6 offset4">
       <!-- <p><strong>Admin user email:</strong> admin@example.com</p>
        <p><strong>Team 1 user email:</strong> b2@example.com</p>
        <p><strong>Team 2 user email:</strong> d2@example.com</p>
        <p>The password for each user is 'password'</p>
        <p>The database is reset every night.</p>-->

      </div>
    </div>

      <!-- ****************************************************************** -->
      <!--                        NEW USER Modal Window                       -->
      <!-- ****************************************************************** -->

      <div class="modal hide" id="myModal">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">x</button>
              <h3>New User Details</h3>
          </div>
          <div class="modal-body">
              <form method="POST" id="regFrm" action=""><!--onsubmit="return checkRegisterForm(this);"-->
              <p><input type="text" class="span4" name="first_name" id="first_name" placeholder="First Name" required></p>
              <p><input type="text" class="span4" name="last_name" id="last_name" placeholder="Last Name" required></p>
              <p><input type="email" class="span4" name="emailReg" id="emailReg" placeholder="Valid Email" required></p>
              <!--<p><input type="password" class="span4" name="password" id="password" placeholder="Password" required ></p>-->
              <p><input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers"
                        type="password" class="span4" name="passwordReg" id="passwordReg" placeholder="Password" required
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                        onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                      if(this.checkValidity()) form.passwordReg2.pattern = this.value;
                    ">
              </p>
             <!-- <p><input type="password" class="span4" name="password2" id="password2" placeholder="Confirm Password" required></p>-->
              <p><input title="Please enter the same Password as above"
                        type="password" class="span4" name="passwordReg2" id="passwordReg2" placeholder="Confirm Password"
                        required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                        onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
">             </p>
          </div>
          <div class="modal-footer">
              <a href="javascript:void(0);" class="btn btn-warning" data-dismiss="modal">Cancel</a>
              <a href="javascript:void(0);" id="btnModalSubmit" class="btn btn-primary">Register</a>
              <!--<button class="btn btn-primary" type="submit" value="Register"/>-->
          </div>
          </form>
      </div>




  </div>

<?php include 'footer.php' ?>
<script type="text/javascript">
    var registerUrl = base_url('login/register');
    function checkRegisterForm(){



    }
    $(document).ready(function(){
        $('#regFrm').prop('action',registerUrl);
        console.log(registerUrl);
        $('#btnModalSubmit').on("click",function(e){
            console.log("click-inside");return false;
            //if(checkValidation()){
                $('#regFrm').submit(function(evt){
                    console.log("submit-inside");
                    // cancels the form submission
                    evt.preventDefault();
                    console.log("next");
                    // do whatever you want here
                });
            console.log("click-out");
           // }
        },true);
    });


    ///////////////////////////   JavaScript form validation  /////////////////////////////////////
    /*document.addEventListener("DOMContentLoaded", function() {


       var checkPassword = function(str)
        {
            var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
            return re.test(str);
        };

        var checkForm = function(e)
        {
            if(this.username.value == "") {
                alert("Error: Username cannot be blank!");
                this.username.focus();
                e.preventDefault(); // equivalent to return false
                return;
            }
            re = /^\w+$/;
            if(!re.test(this.username.value)) {
                alert("Error: Username must contain only letters, numbers and underscores!");
                this.username.focus();
                e.preventDefault();
                return;
            }
            if(this.pwd1.value != "" && this.pwd1.value == this.pwd2.value) {
                if(!checkPassword(this.pwd1.value)) {
                    alert("The password you have entered is not valid!");
                    this.pwd1.focus();
                    e.preventDefault();
                    return;
                }
            } else {
                alert("Error: Please check that you've entered and confirmed your password!");
                this.pwd1.focus();
                e.preventDefault();
                return;
            }
            alert("Both username and password are VALID!");
        };

        var myForm = document.getElementById("myForm");
        myForm.addEventListener("submit", checkForm, true);
    });*/
//////////////////////////////////////   HTML5 form validation  ///////////////////////////////////////////////////////////////////////////////
    document.addEventListener("DOMContentLoaded", function() {
        var supports_input_validity = function()
        {
            var i = document.createElement("input");
            return "setCustomValidity" in i;
        }

        if(supports_input_validity()) {
            //var usernameInput = document.getElementById("field_username");
            //usernameInput.setCustomValidity(usernameInput.title);

            var pwd1Input = document.getElementById("passwordReg");
            pwd1Input.setCustomValidity(pwd1Input.title);

            var pwd2Input = document.getElementById("passwordReg2");

            // input key handlers

            //usernameInput.addEventListener("keyup", function() {
                //usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
            //}, false);

            pwd1Input.addEventListener("keyup", function() {
                console.log("pwd111111111Input");
                this.setCustomValidity(this.validity.patternMismatch ? pwd1Input.title : "");
                if(this.checkValidity()) {
                    pwd2Input.pattern = this.value;
                    pwd2Input.setCustomValidity(pwd2Input.title);
                } else {
                    pwd2Input.pattern = this.pattern;
                    pwd2Input.setCustomValidity("");
                }
            }, false);

            pwd2Input.addEventListener("keyup", function() {
                console.log("pwd222222222222Input");
                this.setCustomValidity(this.validity.patternMismatch ? pwd2Input.title : "");
            }, false);

        }

    }, false);

    function checkValidation(){
        var allOk = false;
        $('#regFrm *').filter(':input').each(function(){
            console.log(this.checkValidity());
            allOk = this.checkValidity();
        });
        return allOk;
    }

</script>