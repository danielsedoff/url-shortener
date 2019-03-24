<?php

if (!empty($_GET)) {
 $num = key($_GET);
 if (is_numeric($num) && file_exists($num)) {
  header('Location: ' . file_get_contents($num));
  die();
 }   
}

if($_POST["addr"] == "") {
	print(" <center><h1>URL shortener</h1><br>
		<form method=\"post\" action=\"\">
		<input name=\"addr\" type=\"text\" style=\"width:400px; height:100px;\" value=\"http://\">
		<br>
		<input type=\"submit\" value=\"OK\" style=\"width:400px; height:100px;\">
		</form></center>");
	} else {
        $url = $_POST["addr"];
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            die('Not a valid URL');
        }
        $biggest = file_get_contents("biggest");
		$num = $biggest + 1;
		file_put_contents("biggest", $num);
		file_put_contents($num, $url);
		$new_link = "http://$_SERVER[HTTP_HOST]/sh.php?" . $num;
		print("<center><h1>Shortened URL: <a href=\"" . $new_link . "\">$new_link</a>");
		print("<br><a href=\"javascript:window.history.back();\">Back</a></h1></center>");
	}


?>
