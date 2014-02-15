<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-10-2010 20:59
 */

if( ! defined( 'NV_IS_FILE_MODULES' ) )
	die( 'Stop!!!' );

$sql_drop_module = array( );

$result = $db->query( 'SHOW TABLE STATUS LIKE ' . $db->quote( $db_config['prefix'] . '\_' . $lang . '\_' . $module_data ) );
while( $item = $result->fetch( ) )
{
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $item['name'];
}
$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . " (
`CMND_Code` char(50) NOT NULL,
`name` varchar(100) NOT NULL,
`birthday` date NOT NULL,
`sex` int(11) NOT NULL,
'image' varchar(255) NOT NULL,
'thumb' varchar(255) NOT NULL,
`hometown` varchar(100) NOT NULL,
`origin` varchar(100) NOT NULL,
`place` varchar(100) NOT NULL,
`ethnic` varchar(100) NOT NULL,
`religious` varchar(100) NOT NULL,
`date_of_issue` date NOT NULL,
`where_licensing` varchar(100) NOT NULL,
`characteristics` varchar(100) NOT NULL,
PRIMARY KEY (`CMND_Code`)
) ENGINE=MyISAM";
?>