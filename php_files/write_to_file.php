<?php
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "สิริสกุล คงคะรัศมี\n";
fwrite($myfile, $txt);
$txt = "Sirisakul\n";
fwrite($myfile, $txt);
fclose($myfile);
echo "บันทึกข้อมูลเรียบร้อย";
?>