
<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>"; //อ่านทีละบรรทัด
  // echo fgetc($myfile) . "<br>"; //อ่านทีละตัวอักษร
}
fclose($myfile);
?>

</body>
</html>