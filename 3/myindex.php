<?php

$photoDir = "../photos/";
$photoTypesAllowed = ["image/jpeg", "image/png"];


$semesterStart = new DateTime("2019-9-2");
$semesterEnd = new DateTime("2019-12-13");
$semesterDuration = $semesterStart -> diff($semesterEnd);
$today = new DateTime("now");
$fromSemesterStart = $semesterStart -> diff($today);

//echo $fromSemesterStart -> format("%r%a");
$semesterInfoHTML = "<p>Info Semestri kohta pole kättesaadav.</p>";
if($fromSemesterStart -> format("%r%a") > 0 and $fromSemesterStart -> format("%r%a") < $semesterDuration -> format("%r%a")){
    $semesterInfoHTML = "<p>Semester on täies hoos: ";
    $semesterInfoHTML .= '<meter min="0" max="'.$semesterDuration -> format("%r%a");
    $semesterInfoHTML .= '" ';
    $semesterInfoHTML .= 'value="'.$fromSemesterStart -> format("%r%a");
    $semesterInfoHTML .= '" > ';
    $semesterInfoHTML .= round((($fromSemesterStart -> format("%r%a") / $semesterDuration -> format("%r%a"))* 100),1);
    $semesterInfoHTML .= '%</meter> </p>';


}

//Juhusliku foto kasutamine
$allFiles = array_slice(scandir($photoDir),2);
$photoList = []; //array ehk massiiv
//kontroll
foreach ($allFiles as $file){
    $fileInfo = getimagesize($photoDir .$file);
    if(in_array($fileInfo["mime"], $photoTypesAllowed)==true){
        array_push($photoList, $file);
    }
}

$photoCount = count ($photoList);
$photoNum = mt_rand(0,$photoCount-1);
//echo $photoNum;
//<img src="../photos/1.jpg" alt="Juhuslik Foto">
$randomImgHtml = '<img src="'.$photoDir .$photoList[$photoNum].'"alt="Juhuslik Foto">';

require("header.php");

?>


    <p>See veebileht on valminud õppetöö käigus ning ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
    <?php echo $semesterInfoHTML; echo $randomImgHtml; ?>
</body>
</html>