function clearText(theid, text) {
	inputTag = document.getElementById(theid);
	inputTagStyle = inputTag.style;
	if(inputTag.value == text) {
		inputTag.value = '';
		inputTagStyle.color = 'black';
	}
}

function addText(theid, text) {
	inputTag = document.getElementById(theid);
	inputTagStyle = inputTag.style;
	if(inputTag.value == '') {
		inputTag.value = text;
		inputTagStyle.color = 'gray';
	}
}


