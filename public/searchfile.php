<?php
function search($dir,$subdir,$se){
    if($dir != "/" && strlen($dir)>=1){
        if(strrpos($dir,"/")!=strlen($dir)-1){
            $dir.="/";
        }
        $open=@opendir($dir) or die("Fold $dir no exists!");
        while($file=readdir($open)){
            if(!is_dir($dir.$file)){
                if($file!="." && $file!=".."){

                     $str = file_get_contents($dir.$file);
					  $count = substr_count($str, $se);
					
                   if($count) echo $dir.$file . ' ' . $count . ' <br>';
                   //else  echo $dir.$file . ' ' . $count . ' <br>';
                }
            }elseif($file!="." && $file!=".." && $subdir){
                search($dir.$file."/",$subdir,$se);
            }
        }
        closedir($open);
    }else{
        echo "Вы забыли ввести имя папки!";
    }
	
}
search("../../www/",true,"latestChat");

?>