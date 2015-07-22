// This script performs 3 different AJAX requests, xmlhttpflipPrev() and 
// xmlhttpflipNext() both retreive the .png files that make the pages of the book
// look as if they have started to turn when the "next" or "previous" pages are 
// hovered over. flipclear() resets them back to white when the mouse stops
// hovering over them. Todd Baert, 102490961

function xmlhttpflipPrev(){
                var xmlhttp = new XMLHttpRequest();
		
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("flipprev").innerHTML = "<img src='" + xmlhttp.responseText + "'/>";
                        
                    }
                }
                xmlhttp.open("POST","flipprev.php",true);
                xmlhttp.send();
                    
            }
            
function xmlhttpflipNext(){
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("flipnext").innerHTML = "<img src='" + xmlhttp.responseText + "'/>";
                        
                    }
                }
                xmlhttp.open("POST","flipnext.php",true);
                xmlhttp.send();
                    
            }
            
function flipclear(){
    
		var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("flipprev").innerHTML = "<img src='" + xmlhttp.responseText + "'/>";
			document.getElementById("flipnext").innerHTML = "<img src='" + xmlhttp.responseText + "'/>";
                        
                    }
                }
                xmlhttp.open("POST","flipclear.php",true);
                xmlhttp.send();

}