
 <?php 
 
 $url = $_SERVER['REQUEST_URI'];
$my_url = explode('wp-content' , $url); 
$path = $_SERVER['DOCUMENT_ROOT']."/".$my_url[0];

include_once $path . '/wp-config.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';
 $new_ddt= $_FILES['uploadDocddt']['name'];

 $filelocation='ddt/'.get_current_user_id();

 if($new_ddt) {
$uploads = wp_upload_dir();
$usersContent = $uploads['basedir'].DIRECTORY_SEPARATOR.$filelocation;



$filename = get_user_meta(get_current_user_id(),'ddtdoc',true);

if($filename){
$filePath=$usersContent."/".$filename;
if (file_exists($filePath)) {
unlink( $filePath );
}
}

wp_mkdir_p($usersContent);
@move_uploaded_file($_FILES['uploadDocddt']['tmp_name'],$usersContent.DIRECTORY_SEPARATOR.$new_ddt);
update_user_meta(get_current_user_id(), 'ddtdoc',$new_ddt);
}





?>