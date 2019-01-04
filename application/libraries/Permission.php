<?php

$roles = array(
			'' => array (
				'home' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
			),
			'administrator' => array (
				'assignmenu' => array ('index', 'list', 'insert', 'update', 'delete'),
				'menu' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail', 'modal_form', 'modal_table', 'data_form'),
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail', 'm_form_user_info', 'insert_user_info', 'm_user_info'),
				'role' => array ('index', 'list', 'insert', 'update', 'update_status', 'detail'),	
				'kppn' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),				
				'bidang' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),				
				'seksi' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),				
				'jenis_laporan' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),				
				'periode_laporan' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),				
				'status_laporan' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),				
				'laporan' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),				
			),
			'supervisor' => array (
				'user' => array ('index', 'list', 'detail'),		
			),
			'operator' => array (
				'menu' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),	
			),	
			'kppn' => array (
				'kppn' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail', 'm_form_user_info', 'insert_user_info', 'm_user_info'),
			),				
		);


