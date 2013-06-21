<?php


include "Instagram.php";
$instagram = new Instagram("f1a857b290fc43ec962d238642a41538", "b38841eec1ea47d99fd048ab3977032f");


if($dados = $instagram->getRecentTag("computers")){

	$total =  count($dados['data']);

	for($a=0; $a<$total; $a++){
		$src = $dados['data'][$a]['images']['low_resolution']['url'];
		$link = $dados['data'][$a]['link'];
		echo '<a href="'.$link.'"><img src="'.$src.'" /></a>';	
	}
	
}else{

	echo "Api returned false";

}



?>