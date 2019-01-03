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
			),
			'supervisor' => array (
				'user' => array ('index', 'list', 'detail'),		
			),
			'operator' => array (
				'menu' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),	
			),	
		);


