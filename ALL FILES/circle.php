<?php

function makeCircle($idNum, $picFile){
/* Makes an svg circle, filled with picFile picture, that expands when mouse is over, and contracts when mouse goes away */

	echo <<<ZZEOF
<svg height="200" width="200">
	<defs>
		<pattern id="backImage$idNum" patternUnits="userSpaceOnUse" width="200" height="200">
			<image xlink:href="$picFile" x="-90" y="-75" width="400" height="400" />
		</pattern>
	</defs>
	<circle id='myCircle$idNum' onmouseover="expand('myCircle$idNum')" onmouseout="contract('myCircle$idNum')" 
	cx="100" cy="100" r="50" stroke="blue" stroke-width="2" fill="url(#backImage$idNum)" />
</svg>
ZZEOF;
}

?>

