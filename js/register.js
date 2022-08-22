
document.getElementById("button_reg").disabled = true;

function check_user(){
    var user = document.getElementById("username").value;
    $.post("check_user.php", {
        user: user
    }, function (data, status){
        if(data=="That name is taken"){
            document.getElementById("button_reg").disabled = true;
            document.getElementById("php-response-container-one").innerHTML = "<span style='color:red;'>"+data+"</span>";
            document.getElementById("username").style.border = "2px solid red";
        }else if(data=="That name is empty"){
            document.getElementById("button_reg").disabled = true;
            document.getElementById("php-response-container-one").innerHTML = "<span style='color:red;'>"+data+"</span>";
            document.getElementById("username").style.border = "2px solid red";
        }else{
            document.getElementById("button_reg").disabled = false;
            document.getElementById("php-response-container-one").innerHTML = "<span style='color:green;'>"+data+"</span>";
            document.getElementById("username").style.border = "2px solid green";
        }
    })
}

function check_email(){
    var email = document.getElementById("email").value;
    $.post("check_email.php", {
        email: email
    }, function (data, status){
        if(data=="That email is taken"){
            document.getElementById("button_reg").disabled = true;
            document.getElementById("php-response-container-thr").innerHTML = "<span style='color:red;'>"+data+"</span>";
            document.getElementById("email").style.border = "2px solid red";
        }else if(data=="That email is empty"){
            document.getElementById("button_reg").disabled = true;
            document.getElementById("php-response-container-thr").innerHTML = "<span style='color:red;'>"+data+"</span>";
            document.getElementById("email").style.border = "2px solid red";
        }else{
            document.getElementById("button_reg").disabled = false;
            document.getElementById("php-response-container-thr").innerHTML = "<span style='color:green;'>"+data+"</span>";
            document.getElementById("email").style.border = "2px solid green";
        }
    })
}

function check_password(){
    var pass = document.getElementById("password").value;
    var pass_l = pass.length;
    if(pass_l < 5){
        document.getElementById("php-response-container-two").innerHTML = "<span style='color:red;'>The password must be more than 5 characters.</span>";
        document.getElementById("password").style.border = "2px solid red";
        document.getElementById("button_reg").disabled = true;
    }else{
        document.getElementById("php-response-container-two").innerHTML = "<span style='color:green;'>The password must be more than 5 characters.</span>";
        document.getElementById("password").style.border = "2px solid green";
        document.getElementById("button_reg").disabled = false;
    }
}