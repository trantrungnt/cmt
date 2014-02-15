<?php
//authentication of file update_CMND.php in ADMIN folder
if( ! defined( 'NV_IS_FILE_ADMIN' ) )
die( 'Stop!!!' );


$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );


//get CMND_Code from CMND.tpl
$cmnd_code = $nv_Request->get_title('CMND_Code','get');

//query by CMND_Code and Display in update_CMND.tpl
$_sql = "SELECT CMND_Code, name, birthday, sex, image, thumb, hometown, origin, place, ethnic, religious, date_of_issue, where_licensing, characteristics FROM 
".$db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data." WHERE CMND_Code='".$cmnd_code."'";

//fill data to update_CMND.tpl
$_query = $db->query($_sql);
$rows = $_query->fetch();

/*if($rows['sex'] == 1)
{
$xtpl->parse('main.check_male');
}else
{
$xtpl->parse('main.check_female');
}*/

//check sex
switch ($rows['sex'])
{
	case '0':
	$xtpl->parse('main.check_female');
	break;
	
	default:
	$xtpl->parse('main.check_male');
	break;
}	

if ($rows['birthday']!='0000-00-00' AND $rows['date_of_issue']!='0000-00-00') 
{
			//fill data to update_CMND.tpl
			@require_once ( NV_ROOTDIR . "/includes/class/image.class.php" );
			
			$xtpl->assign('DATA', array(
								"cmnd_code" => $rows['cmnd_code'],
								"name" => $rows['name'],
								"birthday" => $rows['birthday'],
								"sex" => $rows['sex'],
							    "thumb" =>  NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $rows['thumb'],
								"hometown" => $rows['hometown'],
								"origin" => $rows['origin'],
								"place" => $rows['place'],
								"ethnic" => $rows['ethnic'],
								"religious" => $rows['religious'],
								"date_of_issue" => $rows['date_of_issue'],
								"where_licensing" => $rows['where_licensing'],
								"characteristics" => $rows['characteristics'])
			);
																										
}

//start to update CMND
//get data from update_CMND
//$data = array();

//why i can not get data from update.tpl via textbox?
//$data1 = $nv_Request->get_title('cmnd','post','');
//$data['birthday'] = $nv_Request->get_title('birthday','post', '');
//var_dump($data1);
//die();


$data = array();

$data['CMND_Code'] = $nv_Request->get_title('cmnd','post', '');
$data['name'] = $nv_Request->get_title('name','post', '');
$data['birthday'] = $nv_Request->get_title('birthday','post', '');
$data['sex'] = $nv_Request->get_int('sex', 'post');
$data['hometown'] = $nv_Request->get_title('hometown','post', '');
$data['origin'] = $nv_Request->get_title('origin','post', '');
$data['place'] = $nv_Request->get_title('place','post', '');
$data['ethnic'] = $nv_Request->get_title('ethnic','post', '');
$data['religious'] = $nv_Request->get_title('religious','post', '');
$data['date_of_issue'] = $nv_Request->get_title('date_of_issue','post', '');
$data['where_licensing'] = $nv_Request->get_title('where_licensing','post', '');
$data['characteristics'] = $nv_Request->get_title('characteristics','post', '');

/*if (!empty($data['CMND_Code']) AND !empty($data['name'])
AND !empty($data['birthday']) AND !empty($data['sex'])
AND !empty($data['hometown']) AND !empty($data['origin'])
AND !empty($data['place']) AND !empty($data['ethnic'])
AND !empty($data['religious']) AND !empty($data['date_of_issue'])
AND !empty($data['where_licensing']) AND !empty($data['characteristics']))*/


//update CMND: delete file iamge and replace other image, update database 

if (isset($data['CMND_Code']) != "") 
{
			//var_dump(NV_UPLOADS_REAL_DIR . "/" . $rows['thumb']);
			//die();
			if( $rows['image'] != '' && file_exists( NV_UPLOADS_REAL_DIR . "/" . $rows['image'] ) )
			{
					//delete image
					@unlink( NV_UPLOADS_REAL_DIR . "/" . $rows['image'] ) ;
					
					//delete thumb
					if( $rows['thumb'] != '' && file_exists( NV_UPLOADS_REAL_DIR . "/" . $rows['thumb'] ) )
					{
						@unlink( NV_UPLOADS_REAL_DIR . "/" . $rows['thumb'] );
					}													
																				
			}
						
					//upload image again by CMND_Code
					@require_once ( NV_ROOTDIR . "/includes/class/upload.class.php" );
					$upload = new upload( array( 'images' ), $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT );
					$upload_info = $upload->save_file( $_FILES['avatar'], NV_UPLOADS_REAL_DIR . '/' . $module_name. "/images", false );				
					@unlink( $_FILES['avatar']['tmp_name'] );
					
					if( empty( $upload_info['error'] ) )
					{
						@chmod( $upload_info['name'], 0644 );		
						$image = $upload_info['name'];
						$basename = $basename_file = $upload_info['basename'];
						$imginfo = nv_is_image( $image );
						$weight = 150;
						$height = 150;
								        
						$basename = preg_replace( '/(.*)(\.[a-zA-Z]+)$/', '\1-' . $weight . '-' . $height . '\2', $basename );
								        
						@require_once ( NV_ROOTDIR . "/includes/class/image.class.php" );
								        
						$_image = new image( $image, $weight, $height );
						$_image->resizeXY( $weight, $height );
						$_image->save( NV_UPLOADS_REAL_DIR . '/' . $module_name . "/thumb", $basename );
								        
						if( file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_name . '/thumb/' . $basename ) )
						{
							$imgthumb = NV_UPLOADS_REAL_DIR . '/' . $module_name . '/thumb/' . $basename;
											
							$imgthumb = str_replace( NV_ROOTDIR . "/" . NV_UPLOADS_DIR . "/", "", $imgthumb );
											
						}	
						
						
						//execute to update CMND
						try{
							$sql = "UPDATE ".$db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data." SET CMND_Code=:CMND_Code, name=:name, birthday=:birthday, sex=:sex, image=:image, thumb=:thumb, hometown=:hometown, origin=:origin, place=:place, ethnic=:ethnic, religious=:religious, date_of_issue=:date_of_issue, where_licensing=:where_licensing, characteristics=:characteristics WHERE CMND_Code = '".$cmnd_code."'";
							
							$query = $db->prepare($sql);
							//$row = $query->fetch();
							$data['image'] = $module_data . "/images/" . $basename_file;
							$data['thumb'] = $imgthumb;
							
							$query->bindParam(':CMND_Code', $data['CMND_Code'], PDO::PARAM_STR, 255);
							$query->bindParam(':name', $data['name'], PDO::PARAM_STR, 255);
							$query->bindParam(':birthday', $data['birthday'], PDO::PARAM_STR);
							$query->bindParam(':sex', $data['sex'], PDO::PARAM_INT, 11);
							$query->bindParam(':image', $data['image'], PDO::PARAM_STR, 255);
							$query->bindParam(':thumb', $data['thumb'], PDO::PARAM_STR, 255);
							$query->bindParam(':hometown', $data['hometown'] , PDO::PARAM_STR, 255);
							$query->bindParam(':origin', $data['origin'], PDO::PARAM_STR, 255);
							$query->bindParam(':place', $data['place'], PDO::PARAM_STR, 255);
							$query->bindParam(':ethnic',$data['ethnic'], PDO::PARAM_STR, 255);
							$query->bindParam(':religious', $data['religious'], PDO::PARAM_STR, 255);
							$query->bindParam(':date_of_issue', $data['date_of_issue'], PDO::PARAM_STR);
							$query->bindParam(':where_licensing', $data['where_licensing'], PDO::PARAM_STR, 255);
							$query->bindParam(':characteristics', $data['characteristics'], PDO::PARAM_STR, 255);
							
							$query->execute();
						}
						catch(PDOException $e)
						{
							print_r($e);
							die();
						}
							//Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=CMND' );
							//die( );		
								
					}			
						
}	






	

//update image and thumb information to store in server
	
	
	

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>

  
