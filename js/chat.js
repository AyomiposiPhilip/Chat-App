
function scroll_down(){
    document.getElementById("messages-container").style.scrollBehavior = "smooth";
    var myDiv = document.getElementById("messages-container");
    myDiv.scrollTop = myDiv.scrollHeight;
}

function scroll_down_bt(){
    document.getElementById("messages-container").style.scrollBehavior = "smooth";
    var myDiv = document.getElementById("messages-container");
    myDiv.scrollTop = myDiv.scrollHeight;
}

setInterval(function(){
    var message = document.getElementById("message").value;
    $.post("get_typing.php", {
        message: message
    }, function(data, status){
        document.getElementById("typing").innerHTML = data;
    })
}, 500);

setInterval(function(){
    var message = document.getElementById("message").value;
    $.post("load_mess.php", {
        message: message
    }, function(data, status){
        document.getElementById("messages-container").innerHTML = data;
    })
}, 1000);

function send_message(){
    var date = new Date();
    var hour = date.getHours();
    var mins = date.getMinutes();
    var time = hour+":"+mins;
    var message = document.getElementById("message").value;
    document.querySelector('input').setAttribute('autofocus', 'autofocus');
    $.post("send_mess.php", {
        message: message,
        time: time
    }, function(data, status){
        setInterval(function(){
            var myDiv = document.getElementById("messages-container");
            myDiv.scrollTop = myDiv.scrollHeight;            
        }, 1000);
        document.getElementById("message").value = "";
    })
}

function typing_mess(){
    var message = document.getElementById("message").value;
    $.post("typing.php", {
        message: message
    }, function(data, status){

    })
}

