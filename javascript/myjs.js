

/**
 * check Validation on client side for registration form
 */
function validation() {
    var isNameValid = checkName();
    var isEmailValid = checkEmail();
    var isCorrectPassword = checkPassword();
    var isSame = checkSame();

    // Check if they are all true -> return true
        // Else return false
    if (isNameValid && isEmailValid && isSame && isCorrectPassword) {
        return true;
    } else {
        return false;
    }
}

/**
 * check Validation on client side for login form
 */
function validationLog(){
    var isEmailValid = logEmail();
    var isCorrectPassword = logPassword();

    // Check if they are all true -> return true
    // Else return false
    if (isEmailValid && isCorrectPassword) {
        return true;
    } else {
        return false;
    }
}

/**
 * check if name is missing
 */
function checkName() {
    var first_name = document.forms["form_registration"]["firstName"].value;
    var last_name = document.forms["form_registration"]["lastName"].value;
    if (first_name == null || first_name == "") {
        document.getElementById("nameError").innerHTML = " First Name Missing";
        document.getElementById("nameError").style.visibility = "visible";
        document.getElementById("firstName").focus();
        return false;
    } else if (last_name == null || last_name == "") {
        document.getElementById("nameError").innerHTML = " Last Name Missing";
        document.getElementById("nameError").style.visibility = "visible";
        document.getElementById("lastName").focus();
        return false;
    } else {
        document.getElementById("nameError").style.visibility = "hidden";

        return true;
    }
}

/**
 * check if email is missing
 */
function checkEmail() {
    var email = document.forms["form_registration"]["email"].value;
    var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (email == null || email == "") {
        document.getElementById("emailError").innerHTML = " Email Address Missing";
        document.getElementById("emailError").style.visibility = "visible";
        document.getElementById("email").focus();
        return false;
    } else if(!pattern.test(email)) {
        document.getElementById("emailError").innerHTML = " Email Address invalid";
        document.getElementById("emailError").style.visibility = "visible";
        document.getElementById("email").focus();
        return false;
    } else {
        document.getElementById("emailError").style.visibility = "hidden";
        return true;
    }
}

/**
 * check if password or retype password is missing
 */
function checkPassword() {
    var password = document.forms["form_registration"]["password"].value;
    var retype = document.forms["form_registration"]["confirm_password"].value;
    if (password == null || password == "") {
        document.getElementById("passwordMiss").innerHTML = " Password Missing";
        document.getElementById("passwordMiss").style.visibility = "visible";
        document.getElementById("password").focus();
        return false;
    } else if (retype == null || retype == "") {
        document.getElementById("notSame").innerHTML = " Confirm Password Missing";
        document.getElementById("notSame").style.visibility = "visible";
        document.getElementById("confirm_password").focus();
        return false;
    } else {
        document.getElementById("passwordMiss").style.visibility = "hidden";
        document.getElementById("notSame").style.visibility = "hidden";

        return true;
    }
}

/**
 * check if the two passwrod is same
 */
function checkSame() {
    var password = document.forms["form_registration"]["password"].value;
    var retype = document.forms["form_registration"]["confirm_password"].value;
    if (password != retype) {
        document.getElementById("notSame").innerHTML = " Different Password";
        document.getElementById("notSame").style.visibility = "visible";
        document.getElementById("confirm_password").focus();
        return false;
    } else {
        return true;
    }

}

/**
 * functions for hide the error span if there's no error
 */
function hideNameError() {
    document.getElementById("nameError").style.visibility = "hidden";
}
function hideEmailError() {
    document.getElementById("emailError").style.visibility = "hidden";
}
function hidePasswordError() {
    document.getElementById("passwordMiss").style.visibility = "hidden";
}
function hideNotSame() {
    document.getElementById("notSame").style.visibility = "hidden";
}

/**
 * check if email in login form is missing
 */
function logEmail() {
    var email = document.forms["form_log"]["email"].value;
    var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (email == null || email == "") {
        document.getElementById("emailError").innerHTML = " Email Address Missing";
        document.getElementById("emailError").style.visibility = "visible";
        document.getElementById("email").focus();
        return false;
    } else if(!pattern.test(email)) {
        document.getElementById("emailError").innerHTML = " Email Address invalid";
        document.getElementById("emailError").style.visibility = "visible";
        document.getElementById("email").focus();
        return false;
    } else {
        document.getElementById("emailError").style.visibility = "hidden";
        return true;
    }
}

/**
 * check if passwrod in login form is missing
 */
function logPassword() {
    var password = document.forms["form_log"]["password"].value;
    if (password == null || password == "") {
        document.getElementById("passwordMiss").innerHTML = " Password Missing";
        document.getElementById("passwordMiss").style.visibility = "visible";
        document.getElementById("password").focus();
        return false;
    } else {
        document.getElementById("passwordMiss").style.visibility = "hidden";
        document.getElementById("notSame").style.visibility = "hidden";
        return true;
    }
}

/**
 * functions used to get the rating value from user, by clicking which div of different rates
 */
function rating5() {
    ratingChange();
    document.getElementById("rate-5").style.backgroundImage = "url('images/full_star.png')";
    document.getElementById('rating').value = '1';
}

function rating4() {
    ratingChange();
    document.getElementById("rate-4").style.backgroundImage = "url('images/full_star.png')";
    document.getElementById('rating').value = '2';

}

function rating3() {
    ratingChange();
    document.getElementById("rate-3").style.backgroundImage = "url('images/full_star.png')";
    document.getElementById('rating').value = '3';

}

function rating2() {
    ratingChange();
    document.getElementById("rate-2").style.backgroundImage = "url('images/full_star.png')";
    document.getElementById('rating').value = '4';

}

function rating1() {
    ratingChange();
    document.getElementById("rate-1").style.backgroundImage = "url('images/full_star.png')";
    document.getElementById('rating').value = '5';

}

/**
 * change to background image for the stars, the effect of my rating function 
 * is accomplished by show and hide divs with stars background
 */
function ratingChange() {
    document.getElementById("rate-1").style.backgroundImage = "url('images/0_rate.png')";
    document.getElementById("rate-2").style.backgroundImage = "url('')";
    document.getElementById("rate-3").style.backgroundImage = "url('')";
    document.getElementById("rate-4").style.backgroundImage = "url('')";
    document.getElementById("rate-5").style.backgroundImage = "url('')";
}


// populated results for the suburb input of search bar
function showResult(){
    document.getElementById("populated-result").style.display = "block";
    var str = document.getElementById("suburb").value;
    //AJAX
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            document.getElementById("populated-result").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "php/populate.php?keyword="+str, true);
    xmlhttp.send();
}

// hide the populated div when texts being deleted
function hideResult(num){
    document.getElementById("populated-result").style.display = "none";
    document.getElementById("suburb").value = document.getElementById("result"+num).innerHTML;
}

// when there's a input, the populated div will show
function detectInput(){
    var content = document.getElementById("suburb").value;
    if(!content){
        document.getElementById("populated-result").style.display = "none";
    } else {
        showResult();
    }
}


