<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 26 Jan 2014 09:56:50 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );

$sql = "SELECT CMND_code , name , birthday , sex, image, thumb , hometown , origin , place , ethnic , religious , date_of_issue , where_licensing , characteristics FROM ".$db_config['prefix'] . "_" . NV_LANG_DATA . "_" . $module_data;
$query = $db->query($sql);

@require_once ( NV_ROOTDIR . "/includes/class/image.class.php" );

while($row = $query->fetch()){
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

$page_title = $lang_module['CMND'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';

?>