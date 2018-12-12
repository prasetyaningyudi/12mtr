<?php

$roles = array(
			'' => array (
				'home' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
			),
			'administrator' => array (
				'assignmenu' => array ('index', 'list', 'insert', 'update', 'delete'),
				'menu' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
				'role' => array ('index', 'list', 'insert', 'update', 'update_status'),
				'broadcast' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),				
			),
			'supervisor' => array (
				'menu' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),		
			),
			'operator' => array (
				'menu' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),	
			),	
		);


