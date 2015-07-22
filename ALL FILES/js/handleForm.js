function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmation = document.getElementById("confirmPass").value;
    var parID = 'passwordComparison';
    
    if (password !== '' && confirmation !== ''){
        
        if (password !== confirmation){
            passwordCompareMessage(parID, 'Password fields do not match!', 'red');
        }else{
            passwordCompareMessage(parID, 'Password fields match!', 'green');
        }
        
   } else if (password !== '' || confirmation !== ''){
            passwordCompareMessage(parID, '', 'black');
   }
}
function checkEmail(){
  var matched = false;
  var email = document.getElementById("email").value;
  /*NOTE: the regular expression for email was taken from the link:
   *http://www.regular-expressions.info/email.html
   *It is based on RFC 5322
   */
  var re = /[A-Za-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?\.)+(?:[A-Za-z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)\b/;
  var parID = 'emailVar';
  if (email.match(re)) {
    passwordCompareMessage(parID, 'email ok!', 'green');
    matched = true;
  } 
  if (!matched){
    passwordCompareMessage(parID, 'email not ok!', 'red');
  }
  if (email === ''){
     passwordCompareMessage(parID, '', 'black');
  }
}
function passwordCompareMessage(ID, message, colorOfMsg){
    overideStyle(ID, "color", colorOfMsg);
    document.getElementById(ID).innerHTML= message; 
}

function overideStyle(ID,styleName,newVal) {
	var object = document.getElementById(ID);
	object.style[styleName] = newVal;
}

