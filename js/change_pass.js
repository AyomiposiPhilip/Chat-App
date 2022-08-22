
function check_new_pass(){
    var new_pass = document.getElementById("new_password").value;
    if(new_pass.length < 5){
        document.getElementById("confirm_np").innerHTML = "<i style='font-size:15px;color:red;'>Password must be more than 5 characters</i>";
        document.getElementById("submit").disabled = true;
    }else if(new_pass.length >= 5){
        document.getElementById("confirm_np").innerHTML = "<i style='font-size:15px;color:green;'>Password must be more than 5 characters</i>";
        document.getElementById("submit").disabled = false;
    }
}