<?php
require_once 'libcollection.php';
// Mailing address that contact form sends to
global $EMAIL;
$mailing_address=$EMAIL;

function makeContactField($name, $id, $value, $defaultValue, $repopulated){
/* Makes a text field
	- repop is 1 if value is not default, 0 otherwise
	- Text fields have class 'contactField', and repopField if repop == 1 */
	
	echo <<<ZZEOF
<input id='$id' class='contactField
ZZEOF;
	if($repopulated == 1) echo ' repopField';
	echo <<<ZZEOF
'; type="text" name='$name' onfocus="clearText('$id', '$defaultValue')" onblur="addText('$id', '$defaultValue')" value='$value' />
ZZEOF;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>contact us - Story Book Generator</title>
	
	<link rel='stylesheet' type='text/css' href='css/contact.css' />
        <link rel='stylesheet' type='text/css' href='css/navbar.css' />
	<link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>
	<script type='text/javascript' src='js/contact.js' ></script>
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script>
</head>
<body>

<?php

/* array of strings used for form inputs
		Note: default is the default value, formalName is the string used for the empty-field-warning */
		
$contactArray = array(	'message'	=> array('name' => 'contactMessage', 'value' => 'ENTER YOUR MESSAGE!', 'default' => 'ENTER YOUR MESSAGE!'),
						'subject'	=> array('name' => 'contactSubject','id' => 'contactSubjectID', 'value' => 'SUBJECT',	'default' => 'SUBJECT',	'changed' => 0),
						'email' 	=> array('name' => 'contactEmail',	'id' => 'contactEmailID',	'value' => 'EMAIL', 	'default' => 'EMAIL',	'changed' => 0),
						'name' 		=> array('name' => 'contactName', 	'id' => 'contactNameID', 	'value' => 'NAME',		'default' => 'NAME',	'changed' => 0)
);

$invalidForm = 0;
$invalidFormMessage='';

if(isset($_POST['submitButton'])){
	
	// Check that all forms are filled
	foreach($contactArray as $contactKey => $fieldArray){
		$postText = strip_tags($_POST[$fieldArray['name']]);
		if($postText == $fieldArray['default'] || $postText == ''){
			$invalidForm = 1;
			$invalidFormMessage=strtoupper($contactKey).' must be filled in!';
		}
		else{
			$contactArray[$contactKey]['changed'] = 1;
		}
	}
	
	// Check that Email address is valid
	if ($invalidForm == 0 && !filter_var($_POST['contactEmail'], FILTER_VALIDATE_EMAIL)) {
		$invalidForm = 1;
		$invalidFormMessage='Invalid Email';
	}
	
	// If invalid, repopulate form
	if($invalidForm == 1){
		foreach($contactArray as $contactKey => $fieldArray){
			$contactArray[$contactKey]['value'] = htmlentities($_POST[$fieldArray['name']]);
		}
	}
	// Else, mail form
	else{
		mail($mailing_address, $_POST['contactSubject'], 
			strip_tags($_POST['contactMessage']). "\n\n Sent from Storybook Generator Contact Page\nSent by: " . $_POST['contactName'], 
			"From:" . $_POST['contactEmail']);
	}
}

generateNav();
?>

<form action='contact.php' method='post'>
	<div id='contactArea'>
		<div class='contactDiv'>
			<h1 id=contactTitle> CONTACT US </h1>
		</div>
		<div class='contactDiv'>
			<?php 
				/* outputs text fields 
						Note: last parameter in makeContactField has $invalidForm * $fieldArray['changed']
							That is because the repop parameter should be 1 only if the field was changed AND the form was invalid*/
				
				foreach($contactArray as $contactKey => $fieldArray){
					if($contactKey != 'message'){
						makeContactField($fieldArray['name'], $fieldArray['id'], $fieldArray['value'], $fieldArray['default'], $invalidForm*$fieldArray['changed'] );
					}
				}
			?>
		</div>
		<div class='contactDiv'>
			<textarea name='contactMessage' ><?php echo $contactArray['message']['value']?></textarea>
		</div>
		<div class='contactDiv'>
		
			<?php
			//Is form posted, either show a success or warning message 
			
			if($invalidForm == 1) echo<<<ZZEOF
<h3 id='warningTag'>$invalidFormMessage</h3>
ZZEOF;
			elseif(isset($_POST['submitButton'])) echo<<<ZZEOF
<h3 id='successTag'>Message Sent!</h3>
ZZEOF;
			?>
			
			<input name='submitButton' type='submit' value="SUBMIT" id='submitButton' />
		</div>
	</div>
</form>


</body>
</html>