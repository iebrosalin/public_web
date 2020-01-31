<?php
$handle = @fopen("google.csv", "r");
if ($handle) {
	$arResult='';
	$count=1;
    while (($buffer = fgets($handle)) !== false) {
    	$res=explode(';',$buffer);
    	//print_r($res);
     //    echo "\n";
    	$redirect='';
    	$regExpRU='/ru(\/.*)/';
    	$regExp='/(\/.*)/';
    	$regExpRedirectNew='/(\/.*\/)/';
    	$redirectNew='';
    	if( !( preg_match($regExp, $res [0],$redirect) && preg_match($regExpRU, $res [1],$redirectNew) )){
    		continue;
    	}
    	
    	//preg_match($regExp, $res [1],$redirectNew);
    	$temp=$redirectNew[1];
    	$redirectNew='';
    	preg_match($regExpRedirectNew, $temp,$redirectNew);
    	if(strlen($res [1])!==0  && $res [1]!==$redirectNew[1]){
    		if($redirect[1]!==$redirectNew[1]){
			    $arResult.="
				#".$count."\n
			    RewriteCond %{REQUEST_URI} ^".$redirect[1]."$\n
			    RewriteRule ^.*$  ".$redirectNew[1]." [R=301,L] \n";  
			}
		}
	// if(strlen($res [0])!==0){
 //    	$match='';
 //    	$regExpGET='/\?(.*)/';
	// 	if(preg_match($regExpGET, $res [0],$match)){
	// 		$arResult.="RewriteCond %{QUERY_STRING}    ^".$match[1]."$ \n
 //    RewriteRule ^.*$  ".$redirectNew[1]."? [R=301,L] \n";
	// 	}
	// 	else{
			
	// 		preg_match($regExp, $res [0],$redirect);
	// 		if($redirect[1]!==$redirectNew[1]){
	// 		$arResult.="\n
 //    RewriteCond %{REQUEST_URI} ^".$redirect[1]."$\n
 //    RewriteRule ^.*$  ".$redirectNew[1]." [R=301,L] \n";
	// 		}
	// 	}	
	// }
 //        //echo $res [0]."\t".$res [1]."\t".$res [2]."<br/>";
	++$count;
    }
    file_put_contents('res.txt', $arResult);
    if (!feof($handle)) {
        echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
    }
    fclose($handle);
}
