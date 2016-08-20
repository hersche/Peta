<?php

/*-------------------------------USER MANUAL----------------------------------*/	
/*
	1)	Specific the fields in the Array
			name				Must Set
			title				Not necessary
			value				Not necessary
			type				default-value is an input field with type text
			style				Not necessary
			extend_before		Not necessary
			extend_tag			Not necessary
			extend_after		Not necessary
			save				If its set on true, the field will write into the db. if its false, it does not save anything. 
			check				Give argument to check for send mail. "empty", "mail", "captcha", "website"
			specialrow			If specialrow is true, don't display $extend_row_start and $extend_row_end
			
	2)  Output the fields with the function  form_display_fields()  and transmit the array with the attributes - Dont forget <form>
	3)	Save the fields in DB with function  form_save_database() - Dont forget to etablish the db connection at first! 
			First argument		array		The array with the attributes
			second argument		true/false	For Debugging, if true it outputs the sql statement and sql errors. default value is false
			third argument		true/false	For Saving, if true the sql statement will send to the DB - if false of course not. default value is true
*/

/*-------------------------------DEFINE GENERAL----------------------------------*/
/*	
 $extend_row_start = "<tr><td class='titel'>".$out['title']."</td><td>";		// At the beginning of the loop
$extend_row_end = "</tr>";		// At the end of the loop
*/

/*-------------------------------DEFINE FIELDS----------------------------------*/	

$array = array();
$array[0] = array(
		"name" 			=> "prename",
		"title"			=> "Vornamen",
		"value"			=> "standard",
		"type"			=> "text",
		"style"			=> "border: 3px solid red;",
		"extend_before"	=> "vorher",
		"extend_tag"	=> " class=\"reset\"",
		"extend_after"	=> "nachher!",
		"save"			=> true,
		);
$array[1] = array(
		"name" => "mail",
		"title" => "eMail",
		"value" => "x@y.ch",
		"type" => "pw",
		"save"	=> true
		);
$array[2] = array(
		"name" => "web",
		"title" => "Website",
		"value" => "www.blubb.ch",
		"type" => "textarea",
		"style" => "border: 3px solid green;",
		"save"	=> true
		);
$array[3] = array(
		"name" => "submit",
		"title" => "Submit",
		"value" => "Submit form",
		"type" => "submit",
		"save"	=> false
		);

		
/*-------------------------------DISPLAY FIELDS----------------------------------*/	
function form_display_fields($array) { 
//Make vars aviable
	global $extend_row_start, $extend_row_end;
//Reset the counter	
	$i = 0;
//Do it until the array is done	
	foreach($array as $out) {
	//At the beginning of the loop
		if($out['specialrow'] != true) { 
			if(isset($extend_row_start)) { echo $extend_row_start; }
		}
	//Return extension before if it is defined
		if(isset($out['extend_before'])) { echo $out['extend_before']."\n"; }
	//Open input/textarea field
		echo '<';
	//Check for tag-name in type
		if($out['type'] == "textarea") { echo 'textarea '; } else {	echo 'input '; }
	//Output the field name
		echo 'name="formdata['.$i.']" ';
	//Output the type if set, otherwise use  input
		echo 'type="'; if(isset($out['type'])) { echo $out['type']; } else { echo "input";} echo '" ';
	//Output the value
		echo 'value="'; if(!empty($_POST['formdata'][$i])) { echo $_POST['formdata'][$i]; } else { echo $out['value']; } echo '" '; 
	//Output the style if it is defined
		if(isset($out['style'])) { echo 'style="'.$out['style'].'" '; }
	//Check for textarea and add some bug-workaround code
		if($out['type'] == "textarea") { echo 'cols="" rows="" '; }
	//Output the attributes if it is defined
		if(isset($out['extend_tag'])) { echo $out['extend_tag']; }
	//Close the input/textarea tag
		echo " >\n";
	//Close the textarea tag
		if($out['type'] == "textarea") { if(!empty($_POST['formdata'][$i])) { echo $_POST['formdata'][$i]; } else { echo $out['value']; } echo '</textarea>'; }
	//Output the attributes if it is defined
		if(isset($out['extend_after'])) { echo $out['extend_after']."\n"; }
	//At the end of the loop
		if($out['specialrow'] != true) { 
			if(isset($extend_row_end)) { echo $extend_row_end; }
		}
	//Count one up
		$i++;
	}
}
	
/*-------------------------------SAVE INTO DATABASE----------------------------------*/		
function form_save_database($array, $insert_into, $debug = false, $submit = true, $log = true) { 

//Which table to use
	$sql = "INSERT INTO ". $insert_into ." (";
//Build the tablecolumns
	foreach($array as $out) { 
	//Check about the save-attribut
		if($out['save']!=false) {
			$sql .= $out['name'] .",";
		}
	}
//Close the tablecolumns
	$sql .= ") VALUES (";
//Reset counter
	$i = 0;
//Build the values
	foreach($array as $out) {
	//Check about the save-attribut
		if($out['save'] != false) {
		//if the specific field is trasmitted, fill it up, otherwise clear the field
			if(isset($_POST['formdata'][$i])) {
			//Insert value and separator
				$sql .= $_POST['formdata'][$i] .",";
		// clear the field if nothing is submitted
			} else { $sql .=","; }
		//Count one up
			$i++;
		}
	}
//Close sql statement
	$sql .= ");";
	
//Write into the database, if its not deactivated
	if($submit == true) {
		mysql_query($sql);
	}
// Output the sql statement if its true
	if($debug == true) {
		echo $sql;
		mysql_error();
	}
// Log the sql statement if its true
	if($log == true) {
		log_write("system", $sql);
	}
}	

/*-------------------------------SEND TO MAIL----------------------------------*/		

function form_send_mail($array, $debug = false, $submit = true, $log = true) {
// Set defaults
	$error = false;
	$i = 0;
	global $captcha_input_field, $t, $s;
	
//Check the forms
	foreach($array as $out) {
	
	//Switch on checktype
		switch($out['check']) {
			case "mail":
			
			break;
			case "mail":
				if(!ereg ("^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $_POST['formdata'][$i])) {
					$ausgabe .= $t['contact']['invalid_mail'] ."<br />";
					$error = true;
				}
			break;
			case "empty":
				if(empty($_POST['formdata'][$i])) { 
					$ausgabe .= $t['contact']['missing_thing_start'] . $out['name'] . $t['contact']['missing_thing_end'] ."<br />"; 
					$error = true;
				}
			break;
			case "captcha":
				if($_POST['formdata'][$i] != md5($_POST['formdata'][$captcha_input_field])) {
					$ausgabe .= $t['contact']['invalid_captcha'] ."<br />";
					$error = true;
				}
			break;
			case "website":
				if(trim($_POST['formdata'][$i]) != "")
				{
					if(substr($_POST['formdata'][$i], 0, 7) != "http://")
						$_POST['formdata'][$i] = "http://".$_POST['formdata'][$i];
					}
			break;
		}
		// echo "array foreach 1-".$i.": ". $out['check'] ." - STATUS "; if($error==true) { echo "TrUe"; } else { echo "false"; } echo " - formdata:" . $_POST['formdata'][$i] . "<br />\n";
		$i++;
	}

	
	if($error == false) {
		$name = nl2br(stripslashes(htmlspecialchars($_POST['name'])));
		$IP = getenv("REMOTE_ADDR");
		$absender = preg_replace( "/[^a-z0-9 !?:;,.\/_\-=+@#$&\*\(\)]/im", "", $_POST['email'] );
		$absender = preg_replace( "/(content-type:|bcc:|cc:|to:|from:)/im", "", $absender );
		$extra = "From: $name <$absender>\n";
		$extra .= "Content-Type: text/html\n Content-Transfer-Encoding: 8bit\n";
		$alternative = nl2br(stripslashes(htmlspecialchars($_POST['alternative'])));
		$homepage = nl2br(stripslashes(htmlspecialchars($_POST['homepage'])));
		$betreff = nl2br(stripslashes(htmlspecialchars($_POST['betreff'])));
		$nachricht = nl2br(stripslashes(htmlspecialchars($_POST['message'])));
		$mailnachricht .= $t['contact']['mail_headline'] ."<br /><br />
		<span style=\"font-weight: bold; border-bottom: 1px dotted gray; margin-bottom: 5px;\">".$t['contact']['mail_title_userdata']."</span><br />";
		$i = 0;
		foreach($array as $out) {
			if($out['type']!="hidden" AND $out['type']!="submit" AND $out['type']!="reset") {
				$mailnachricht .= $out['name'] . ": <b>" . nl2br(stripslashes(htmlspecialchars($_POST['formdata'][$i]))) ."</b><br />\n";
			}
			$i++;
		}
		$mailnachricht .= "<br /><span style=\"font-weight: bold; border-bottom: 1px dotted gray; margin-bottom: 5px;\">";
		$mailnachricht .= $t['contact']['mail_title_message'];
		$mailnachricht .= "</span><br /><br />";
		$i = 0;
		foreach($array as $out) {
			if($out['mail']=="header") { $betreff = $_POST['formdata'][$i]; }
			if($out['mail']=="message") { $nachricht = $_POST['formdata'][$i]; }
			$i++;
		}
		$mailnachricht .= "<b><span style='border: 1px solid gray; padding: 3px;font-size: 1.5em'>".$betreff ."</span></b><br/><br/>". $nachricht ."<br/><br />
		<span style='border-top: 1px dotted gray; font-size: 0.6em; color: gray'>".$t['contact']['mail_message_footer']."</span>";
	
		$ok = true;
	}
// Output the mailcontent if is true
	if($debug == true) {
		echo $mailnachricht;
	}
// Send the mail if its true
	if($submit == true) {
		mail($s['form_mail_addy'], $betreff . $t['contact']['mail_header_attend'], $mailnachricht, $extra);
	}
// Log the sql statement if its true
	if($log == true) {
		//log_write("system", $s['form_mail_addy'] . $betreff . $t['contact']['mail_header_attend'] . $mailnachricht);
	}
 //Save Output
	if($error==false) {
		echo $s['m_tag_pro_start'] . $t['contact']['message_victory_content'] . $s['m_tag_pro_end'];
	}
	if ($error==true) {
		echo $s['m_tag_neg_start'] . $t['contact']['message_failure_content_start'] . "<div class=\"space\">" .$ausgabe . "</div>". $t['contact']['message_failure_content_end'] . $s['m_tag_neg_end'] ;
	}
}










	
	
/*-------------------------------DEMONSTRATION----------------------------------*/	




?>	


	
	

		
