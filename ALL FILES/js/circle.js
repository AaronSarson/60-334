/*
Code here has been borrowed and modified from the last example on
http://tutorials.jenkov.com/svg/scripting.html
*/

var timerFunction = null;

function startAnimation(funct, myid) {
	if(timerFunction == null) {
		timerFunction = setInterval(function(){funct(myid);}, 20);
	}
}

function expandCircle(myid){
	var circle = document.getElementById(myid);
	var rad = parseInt(circle.getAttribute("r"));
	if(rad<100){
		rad += 2;
	}
	circle.setAttribute("r", ""+rad);
	if(rad >= 100){
		clearInterval(timerFunction);
		timerFunction = null;
	}
}

function contractCircle(myid){
	var circle = document.getElementById(myid);
	var rad = parseInt(circle.getAttribute("r"));
	if(rad>50){
		rad -= 2;
	};
	circle.setAttribute("r", ""+rad);
	if(rad <= 50){
		clearInterval(timerFunction);
		timerFunction = null;
	}
}

function expand(myid){
	startAnimation(expandCircle, myid);
}

function contract(myid){
	startAnimation(contractCircle, myid);
}

