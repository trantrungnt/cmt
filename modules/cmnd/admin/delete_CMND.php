<?php

//Authentication of delete_CMND.php in ADMIN folder
if( ! defined( 'NV_IS_FILE_ADMIN' ) )
	die( 'Stop!!!' );

//get cmnd_code from delete_CMND.tpl and delete this row 
$cmnd_code = $nv_Request->get_title('CMND_Code','get');

$sqldel_cmnd_code = "SELECT CMND_code , name , birthday , sex , image, thumb, hometown , origin , place , ethnic , religious , date_of_issue , where_licensing , characteristics 
FROM ".$db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data." WHERE CMND_Code='".$cmnd_code."'";

$_querydel_cmnd_code = $db->query($sqldel_cmnd_code);
$row = $_querydel_cmnd_code->fetch();


if( $row['image'] != '' && file_exists( NV_UPLOADS_REAL_DIR . "/" . $row['image'] ) )
		{
			//xoa anh goc
			if( @unlink( NV_UPLOADS_REAL_DIR . "/" . $row['image'] ) )
			{
				//xoa anh thum
				if( $row['thumb'] != '' && file_exists( NV_UPLOADS_REAL_DIR . "/" . $row['thumb'] ) )
				{
					@unlink( NV_UPLOADS_REAL_DIR . "/" . $row['thumb'] );
				}
				
				//xoa du lieu trong DB		
				$sql_delcmnd = "delete from ".$db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data." where CMND_Code = '".$cmnd_code."'";
				$db->query($sql_delcmnd);
				}
			}
	

//if (!empty($delcmnd_code))
//{
	
	//$db->exec();
//}

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );



//Display cmnd list again
$sql_cmnd = "SELECT CMND_code , name , birthday , sex , image, thumb, hometown , origin , place , ethnic , religious , date_of_issue , where_licensing , characteristics FROM ".$db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data;
$_query = $db->query($sql_cmnd); 

@require_once ( NV_ROOTDIR . "/includes/class/image.class.php" );

while($row = $_query->fetch())
{	
		$xtpl->assign('DATA', array(
		"cmnd_code" => $row['cmnd_code'],
		"name" => $row['name'],
		"birthday" => $row['birthday'],
		"sex" => $row['sex'],
		"image" =>  NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $row['image'],
	    "thumb" =>  NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $row['thumb'],
		"hometown" => $row['hometown'],
		"origin" => $row['origin'],
		"place" => $row['place'],
		"ethnic" => $row['ethnic'],
		"religious" => $row['religious'],
		"date_of_issue" => $row['date_of_issue'],
		"where_licensing" => $row['where_licensing'],
		"characteristics" => $row['characteristics']
		));
	
	
	$xtpl->parse('main.loop');
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';



?>