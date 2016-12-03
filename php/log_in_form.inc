<!--form used for log in, including calling the js validation functions-->
<h2>Log in for Wi-Fis</h2>
<form id="form_log" onsubmit="return validationLog();"  method="POST">
    <!--show the errors if exist-->
    <input name="email" id="email" type="email" required placeholder=" Email Address" value="<?php if(isset($_POST['email']))
        echo htmlspecialchars($_POST['email'])?>" onkeypress="hideEmailError()"/>
    <span id="emailError"> </span>
    <span id="emailUsed" style="color: red; visibility:visible;"> <?php if (isset($errors['email'])) echo $errors['email'] ?> </span>
    <input name="password" id="password" type="password"  placeholder=" Password" onkeypress="hidePasswordError()"/>
    <span id="passwordMiss"> Missing</span>
    <span id="passwordWrong" style="color: red; visibility:visible;"> <?php if (isset($errors['password'])) echo $errors['password'] ?> </span>
    <!--submit button to check the validation-->
    <br/>
    <input type="submit" value="OK" class="post_button" onclick="validationLog();"/>
</form>