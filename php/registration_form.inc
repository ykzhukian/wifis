<h2>Sign up for Wi-Fis</h2>
<!--form used for registration and function calling for the client side validatoin-->
<form id="form_registration" onsubmit="return validation();" action="registration.php" method="POST">
    <!--name textboxes-->
    <input name="firstName" id="firstName" type="text" required placeholder=" First Name" value="<?php if(isset($_POST['firstName']))
        echo htmlspecialchars($_POST['firstName'])?>" onkeypress="hideNameError()"/>
    <input name="lastName" id="lastName" type="text" required placeholder=" Last Name" value="<?php if(isset($_POST['lastName']))
        echo htmlspecialchars($_POST['lastName'])?>" onkeypress="hideNameError()"/>
    <!--span used to show error if exists-->
    <span id="nameError"> Missing</span>
    <!--email textbox-->
    <input name="email" id="email" type="email" required placeholder=" Email Address"value="<?php if(isset($_POST['email']))
        echo htmlspecialchars($_POST['email'])?>" onkeypress="hideEmailError()"/>
    <!--span used to show error if exists-->
    <span id="emailError"> </span>
    <span id="emailUsed" style="color: red; visibility:visible;"> <?php if (isset($errors['email'])) echo $errors['email'] ?> </span>
    <!--password textboxes-->
    <input name="password" id="password" type="password"  placeholder=" Password" onkeypress="hidePasswordError()"/>
    <!--span used to show error if exists-->
    <span id="passwordMiss"> Missing</span>
    <input name="confirm_password" id="confirm_password" type="password"  placeholder=" Confirm Password" onkeypress="hideNotSame()"/>
    <!--spans used to show error if exists-->
    <span id="notSame"> Missing</span>
    <span id="check" style="visibility: hidden"></span>
    <!--submit button to check the validation-->
    <br/>
    <input type="submit" value="OK" class="post_button" onclick="validation();"/>
</form>