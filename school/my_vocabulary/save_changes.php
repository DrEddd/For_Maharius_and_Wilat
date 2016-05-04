 <?php
	$alls = $_POST["alls"];
	while (strlen($indexes)>0) {
		$index=substr(0, strpos($alls, "‡")-1);
		$allsS=substr_replace($alls, "", 0, strpos($alls, "‡"));
		$alls=$allsS;
		$value=substr(0, strpos($alls, "‡")-1); 
		$allsS=substr_replace($alls, "", 0, strpos($alls, "‡"));
		$alls=$allS;
		$words[$index]=$value;
	};
	$path="eng_words.txt";
	$file = fopen($path, "w");
	foreach ($words as $word => $translate) fprintf($path, "%s‡%s\n", $word, $translate);
 ?>