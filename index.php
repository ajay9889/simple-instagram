<?php


include "Instagram.php";


$instagram = new Instagram("f1a857b290fc43ec962d238642a41538", "b38841eec1ea47d99fd048ab3977032f");



if($dados = $instagram->getRecentTag("cptm")){



	$total =  count($dados['data']);


	for($a=0; $a<$total; $a++){


		$src = $dados['data'][$a]['images']['low_resolution']['url'];
		
		echo '<img src="'.$src.'" />';	
	
	}
	

}else{

	echo "Api returned false";

}


?>