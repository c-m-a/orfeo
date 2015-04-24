<?php
/**
 *	File Upload Progress JavaScript Class version 0.1, PHP helper
 *	Copyright (C) 2010 Hoppinger BV
 *	www.hoppinger.com
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Lesser General Public License as published by
 *	the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version. See <http://www.gnu.org/licenses/>.
**/


/**
 * 
 * Helper for the JS uploadProgress
 * Handles both the progress and the file upload
 * 
 * @author Korstiaan de Ridder
 * @version 27-05-2010 0.1
**/

// If progress is requested
if($_GET['p'])
{
	$a_status = apc_fetch('upload_'.$_GET['p']);
	$a_iniOptions = array('upload_max_filesize','post_max_size');
	foreach($a_iniOptions as $s_option)
	{
		$a_iniValues[] = return_bytes(ini_get($s_option));
	}
	$i_max = (int)(min($a_iniValues) * 0.9);
	$a_status['max_size'] = $i_max;
	if($a_status['max_size'] < $a_status['total'])
	{
		// Size exceeds max size
		$a_status['error'] = 1;
	}
	if($a_status['done'] == 1)
	{

		$a_status['files'] = apc_fetch('files_'.$_GET['p']);
	}

	print json_encode($a_status);
	die();
}
elseif(($s_progressId = $_POST['APC_UPLOAD_PROGRESS']) || ($s_progressId = $_GET['APC_UPLOAD_PROGRESS']))
{
	// If the file has finished uploading add content to APC cache
	apc_store('files_'.$s_progressId, $_FILES);
	die();
}


// Kindly ripped from php.net
function return_bytes($val) 
{
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last)
	{
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}

?>