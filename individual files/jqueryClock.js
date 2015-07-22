function militaryTime(){
    var date = new Date();
    var hour = date.getHours();
    var minute = date.getMinutes();
    var second = date.getSeconds();
    
    var militaryTime = hour + ':' + minute + ':' + second;
    
   $("#loginClock").html(militaryTime);
}

$(document).ready(function(){
    setInterval('militaryTime()', 1);
    }        
);
