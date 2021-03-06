<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('auth');			
		$this->load->helper('url');			
		$this->load->database();
		$this->load->model('laporan_model');
		$this->load->model('jenis_laporan_model');
		$this->load->model('periode_laporan_model');
		$this->load->model('status_laporan_model');
		$this->load->model('seksi_model');
		$this->load->model('kppn_model');
		$this->load->model('bidang_model');
		$this->load->model('menu_model');
		$this->data['menu'] = $this->menu_model->get_menu($this->session->userdata('ROLE_ID'));
		$this->data['sub_menu'] = $this->menu_model->get_sub_menu($this->session->userdata('ROLE_ID'));	
		$this->load->model('app_data_model');		
		$this->data['app_data'] = $this->app_data_model->get();			
		$this->data['error'] = array();
		$this->data['title'] = 'Laporan';
	}

	public function index(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		$this->data['subtitle'] = 'List';
		$this->data['class'] = __CLASS__;
		$this->load->view('section_header', $this->data);
		$this->load->view('section_sidebar');
		$this->load->view('section_nav');
		$this->load->view('main_index');	
		$this->load->view('section_footer');			
	}

	public function list(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		$filters = array();
		$limit = array('10', '0');
		$r_nama = '';
		$r_sumber = '';
		$r_jenis_laporan = '';
		$r_periode_laporan = '';
		$r_status_laporan = '';
		$r_seksi = '';
		$r_kppn = '';
		$r_bidang = '';
		
		if ($this->session->userdata('ROLE_NAME') == 'kppn'){
			$filters[] = "F.KODE = '" . $this->session->userdata('USERNAME') . "'";
		}
		
		//var_dump($_POST['nama']);
		if(isset($_POST['submit'])){
			if (isset($_POST['nama'])) {
				if ($_POST['nama'] != '' or $_POST['nama'] != null) {
					$filters[] = "A.NAMA LIKE '%" . $_POST['nama'] . "%'";
					$r_nama = $_POST['nama'];
				}
			}
			if (isset($_POST['sumber'])) {
				if ($_POST['sumber'] != '' or $_POST['sumber'] != null) {
					$filters[] = "a.sumber = '" . $_POST['sumber'] . "'";
					$r_sumber = $_POST['sumber'];
				}
			}
			if (isset($_POST['jenis_laporan'])) {
				if ($_POST['jenis_laporan'] != '' or $_POST['jenis_laporan'] != null) {
					$filters[] = "a.jenis_laporan_id = '" . $_POST['jenis_laporan'] . "'";
					$r_jenis_laporan = $_POST['jenis_laporan'];
				}
			}
			if (isset($_POST['periode_laporan'])) {
				if ($_POST['periode_laporan'] != '' or $_POST['periode_laporan'] != null) {
					$filters[] = "a.periode_laporan_id = '" . $_POST['periode_laporan'] . "'";
					$r_periode_laporan = $_POST['periode_laporan'];
				}
			}
			if (isset($_POST['status_laporan'])) {
				if ($_POST['status_laporan'] != '' or $_POST['status_laporan'] != null) {
					$filters[] = "a.status_laporan_id = '" . $_POST['status_laporan'] . "'";
					$r_status_laporan = $_POST['status_laporan'];
				}
			}
			if (isset($_POST['seksi'])) {
				if ($_POST['seksi'] != '' or $_POST['seksi'] != null) {
					$filters[] = "a.seksi_id = '" . $_POST['seksi'] . "'";
					$r_seksi = $_POST['seksi'];
				}
			}
			if (isset($_POST['kppn'])) {
				if ($_POST['kppn'] != '' or $_POST['kppn'] != null) {
					$filters[] = "a.kppn_id = '" . $_POST['kppn'] . "'";
					$r_kppn = $_POST['kppn'];
				}
			}
			if (isset($_POST['bidang'])) {
				if ($_POST['bidang'] != '' or $_POST['bidang'] != null) {
					$filters[] = "a.bidang_id = '" . $_POST['bidang'] . "'";
					$r_bidang = $_POST['bidang'];
				}
			}
			if (isset($_POST['offset'])) {
				if ($_POST['offset'] != '' or $_POST['offset'] != null) {
					$limit[1] = $_POST['offset'];
				}
			}			
		}
		
		$data = $this->laporan_model->get($filters, $limit);
		//var_dump($data);
		$total_data = count($this->laporan_model->get($filters));
		$limit[] = $total_data;
		
		//var_dump($data);

		$no_body = 0;
		$body= array();
		if(isset($data)){
            if (empty($data)) {
                $body[$no_body] = array(
                    (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'No Data')
                );
			} else {
				foreach ($data as $value) {
					if ($this->session->userdata('ROLE_NAME') == 'kanwil'){
						$edit_status = (object) array( 'classes' => ' align-center ', 'value' => '<a href="javascript:void(0)" title="edit status" onclick="show_modal(\'laporan/m_form_edit_status/'.$value->ID.'/\')"><i style="font-size: 16px;" class="fas fa-pen-alt"></i></a>' );
						
						$body[$no_body] = array(
							(object) array( 'classes' => ' hidden ', 'value' => $value->ID ),
							(object) array( 'classes' => ' bold align-center ', 'value' => $no_body+1 ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->NAMA ),
							(object) array( 'classes' => ' align-center ', 'value' => $value->SUMBER ),
							(object) array( 'classes' => ' align-center ', 'value' => '<a href="'.$value->FILE.'" target="_blank" title="view"><i style="font-size: 16px;" class="far fa-eye"></i></a>' ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->BNAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->CNAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->DNAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->ENAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->FNAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->GNAMA ),
							$edit_status
						);						
					}else{
						$body[$no_body] = array(
							(object) array( 'classes' => ' hidden ', 'value' => $value->ID ),
							(object) array( 'classes' => ' bold align-center ', 'value' => $no_body+1 ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->NAMA ),
							(object) array( 'classes' => ' align-center ', 'value' => $value->SUMBER ),
							(object) array( 'classes' => ' align-center ', 'value' => '<a href="'.$value->FILE.'" target="_blank" title="view"><i style="font-size: 16px;" class="far fa-eye"></i></a>' ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->BNAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->CNAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->DNAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->ENAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->FNAMA ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->GNAMA ),
						);						
					}
					$no_body++;
				}
			}
        } else {
            $body[$no_body] = array(
                (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'Filter First')
            );
        }
		
		$header = array(
			array (
				(object) array ('rowspan' => 2, 'classes' => 'bold align-center capitalize', 'value' => 'No'),
				(object) array ('colspan' => 3, 'classes' => 'bold align-center capitalize', 'value' => 'detail laporan'),								
				(object) array ('colspan' => 3, 'classes' => 'bold align-center capitalize', 'value' => 'keterangan laporan'),								
				(object) array ('colspan' => 2, 'classes' => 'bold align-center capitalize', 'value' => 'dari'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'kepada'),		
			),
			array (
				(object) array ('colspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'nama'),								
				//(object) array ('colspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'nomor'),								
				//(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'tanggal'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'sumber'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'file'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'jenis'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'periode'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'status'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'seksi'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'kppn'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'bidang'),			
			)			
		);
			
		$opt_sumber = array();
		$opt_sumber[] = (object) array('label'=>'upload', 'value'=>'upload');
		$opt_sumber[] = (object) array('label'=>'gdrive', 'value'=>'gdrive');
		
		$filters = array();
		$filters[] = "STATUS = '1'";
		$opt_jenis = $this->get_option_data($this->jenis_laporan_model, $filters);				
		
		$filters = array();
		$filters[] = "STATUS = '1'";
		$opt_periode = $this->get_option_data($this->periode_laporan_model, $filters);	

		$filters = array();
		$filters[] = "STATUS = '1'";
		$opt_status = $this->get_option_data($this->status_laporan_model, $filters);

		$filters = array();
		$filters[] = "A.STATUS = '1'";
		$opt_seksi = $this->get_option_data($this->seksi_model, $filters);

		$filters = array();
		$filters[] = "STATUS = '1'";
		$opt_kppn = $this->get_option_data($this->kppn_model, $filters);

		$filters = array();
		$filters[] = "STATUS = '1'";
		$opt_bidang = $this->get_option_data($this->bidang_model, $filters);		
			
		$fields = array();
		$fields[] = (object) array(
			'type' 			=> 'text',
			'label' 		=> 'Nama',
			'placeholder' 	=> 'Nama',
			'name' 			=> 'nama',
			'value' 		=> $r_nama,
			'classes' 		=> 'full-width',
		);		
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'Sumber',
			'name' 			=> 'sumber',
			'placeholder'	=> '-- Pilih Sumber --',
			'options' 		=> $opt_sumber,
			'value' 		=> $r_sumber,				
			'classes' 		=> 'full-width',
		);					
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'Jenis Laporan',
			'name' 			=> 'jenis_laporan',
			'placeholder'	=> '-- Pilih Jenis --',
			'options' 		=> $opt_jenis,
			'value' 		=> $r_jenis_laporan,				
			'classes' 		=> 'full-width',
		);
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'Periode Laporan',
			'name' 			=> 'periode_laporan',
			'placeholder'	=> '-- Pilih Periode --',
			'options' 		=> $opt_periode,
			'value' 		=> $r_periode_laporan,				
			'classes' 		=> 'full-width',
		);
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'Status Laporan',
			'name' 			=> 'status_laporan',
			'placeholder'	=> '-- Pilih Status --',
			'options' 		=> $opt_status,
			'value' 		=> $r_status_laporan,				
			'classes' 		=> 'full-width',
		);			
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'Dari Seksi',
			'name' 			=> 'seksi',
			'placeholder'	=> '-- Pilih Seksi --',
			'options' 		=> $opt_seksi,
			'value' 		=> $r_seksi,				
			'classes' 		=> 'full-width',
		);
		if ($this->session->userdata('ROLE_NAME') != 'kppn'){
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'KPPN',
				'name' 			=> 'kppn',
				'placeholder'	=> '-- Pilih KPPN --',
				'options' 		=> $opt_kppn,
				'value' 		=> $r_kppn,				
				'classes' 		=> 'full-width',
			);
		}
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'Ke Bidang',
			'name' 			=> 'bidang',
			'placeholder'	=> '-- Pilih Bidang --',
			'options' 		=> $opt_bidang,
			'value' 		=> $r_bidang,				
			'classes' 		=> 'full-width',
		);

		if ($this->session->userdata('ROLE_NAME') == 'kppn'){
			$deletable = false;
			$insertable = true;
			$editable = true;
		}else if($this->session->userdata('ROLE_NAME') == 'kanwil'){
			$deletable = false;
			$insertable = false;
			$editable = false;
		}else{
			$deletable = true;
			$insertable = true;
			$editable = true;
		}
		
		//var_dump($body);
		
		$this->data['list'] = (object) array (
			'type'  	=> 'table_default',
			'data'		=> (object) array (
				'classes'  	=> 'striped bordered hover',
				'insertable'=> $insertable,
				'editable'	=> $editable,
				'deletable'	=> $deletable,
				'statusable'=> false,
				'detailable'=> true,
				'pdf'		=> false,
				'xls'		=> false,
				'pagination'=> $limit,
				'filters'  	=> $fields,
				'toolbars'	=> null,
				'header'  	=> $header,
				'body'  	=> $body,
				'footer'  	=> null,
			)
		);		
		echo json_encode($this->data['list']);
	}
	
	public function m_form_edit_status($laporan_id = null){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if($laporan_id != null){
			$r_id = '';
			$r_status_laporan = '';
			$r_catatan = '';
			
			$filter = array();
			$filter[] = "A.ID = ". $laporan_id;
			$this->data['result'] = $this->laporan_model->get($filter);
			foreach($this->data['result'] as $value){
				$r_id 	= $value->ID;
				$r_status_laporan = $value->STATUS_LAPORAN_ID;
				$r_catatan = $value->CATATAN;
			}

			$filters = array();
			$filters[] = "STATUS = '1'";
			$opt_status = $this->get_option_data($this->status_laporan_model, $filters);
			
			$fields = array();
			$fields[] = (object) array(
				'type' 		=> 'hidden',
				'label' 	=> 'id',
				'name' 		=> 'id',
				'value' 	=> $r_id,
				'classes' 	=> '',
			);				
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Status Laporan',
				'name' 			=> 'status_laporan',
				'placeholder'	=> '-- Pilih Status --',
				'options' 		=> $opt_status,
				'value' 		=> $r_status_laporan,				
				'classes' 		=> 'full-width',
			);			
			$fields[] = (object) array(
				'type' 			=> 'textarea',
				'label' 		=> 'Catatan',
				'name' 			=> 'catatan',
				'placeholder'	=> 'catatan',
				'value' 		=> $r_catatan,
				'classes' 		=> 'full-width',
			);					
			
			$this->data['output'] = (object) array (
				'type'  	=> 'modal_form',
				'data'		=> (object) array (
					'target'	=> site_url( __CLASS__ ).'/edit_status',
					'reload'	=> true,
					'title'		=> 'User Information',
					'id'		=> 'modal-form-1',
					'fields'  	=> $fields,
					
				)
			);	
			echo json_encode($this->data['output']);
		}
	}
	
	public function edit_status(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}
		$error_info = array();
		$error_status = false;		
		if($_POST['status_laporan'] == ''){
			$error_info[] = 'status laporan can not be null';
			$error_status = true;
		}
		
		if($error_status == true){
			$this->data['error'] = (object) array (
				'type'  	=> 'error',
				'data'		=> (object) array (
					'info'	=> $error_info,
				)
			);				
			echo json_encode($this->data['error']);
		}else{
			$this->data['update'] = array(
				'STATUS_LAPORAN_ID' => $_POST['status_laporan'],
				'CATATAN' => $_POST['catatan']
			);
			$result = $this->laporan_model->update($this->data['update'], $_POST['id']);
			if($result == true){
				$info = array();
				$info[] = 'Update data successfully';						
				$this->data['info'] = (object) array (
					'type'  	=> 'success',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);
			}else{
				$info = array();
				$info[] = 'Update data not successfull';
				$this->data['info'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);
			}				
			echo json_encode($this->data['info']);			
		}
	}
	
	public function insert(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['submit'])){
			//validation
			$error_info = array();
			$error_status = false;
			if($_POST['nama'] == ''){
				$error_info[] = 'Nama can not be null';
				$error_status = true;
			}
			if($_POST['sumber'] == ''){
				$error_info[] = 'sumber can not be null';
				$error_status = true;
			}	
			if($_POST['jenis_laporan'] == ''){
				$error_info[] = 'jenis laporan can not be null';
				$error_status = true;
			}
			if($_POST['periode_laporan'] == ''){
				$error_info[] = 'periode laporan can not be null';
				$error_status = true;
			}
			if($_POST['status_laporan'] == ''){
				$error_info[] = 'status laporan can not be null';
				$error_status = true;
			}
			if($_POST['seksi'] == ''){
				$error_info[] = 'dari seksi can not be null';
				$error_status = true;
			}
			if($_POST['kppn'] == ''){
				$error_info[] = 'kppn can not be null';
				$error_status = true;
			}
			if($_POST['bidang'] == ''){
				$error_info[] = 'bidang can not be null';
				$error_status = true;
			}
			$file = '';
			if($_POST['sumber'] == 'gdrive'){
				if($_POST['gdrive'] == ''){
					$error_info[] = 'link gdrive can not be null';
					$error_status = true;					
				}else{
					$file = $_POST['gdrive'];
				}
			}else if($_POST['sumber'] == 'upload'){
				if(isset($_FILES["upload"])){
					if($_FILES["upload"] != null){
						$allowed_exts = array("pdf");
						$extension = explode("/", $_FILES["upload"]["type"]);
						$extension = end($extension);
						$true_ext = false;
						foreach($allowed_exts as $val){
							if($extension == $val){
								$true_ext = true;
							}
						}
						if($true_ext == false){
							$error_info[] = 'Only accept pdf';
							$error_status = true;				
						}
						if($_FILES["upload"]["size"] > '5000000'){
							$error_info[] = 'Max file size 5mb';
							$error_status = true;								
						}
						if($error_status == false){
							//upload file
							$filename = $_FILES['upload']['name'];
							$target_dir = FCPATH."public/files/";
							$uniq = date('YmdHis');
							$rename = $uniq . '_' . $filename;
							$success_upload = move_uploaded_file($_FILES["upload"]["tmp_name"], $target_dir . $rename);
							
							if(!$success_upload){
								$error_info[] = 'Error upload photo';
								$error_status = true;
							}else{
								$file = base_url().'public/files/'.$rename;
							}
						}
					}
				}else{
					$error_info[] = 'File laporan can not be null';
					$error_status = true;							
				}
			}
			
			if($error_status == true){
				$this->data['error'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $error_info,
					)
				);				
				echo json_encode($this->data['error']);
			}else{
				$this->data['insert'] = array(
					'NAMA' => $_POST['nama'],
					'NOMOR' => $_POST['nomor'],
					'TANGGAL' => $_POST['tanggal'],
					'SUMBER' => $_POST['sumber'],
					'FILE' => $file,
					'JENIS_LAPORAN_ID' => $_POST['jenis_laporan'],
					'PERIODE_LAPORAN_ID' => $_POST['periode_laporan'],
					'STATUS_LAPORAN_ID' => $_POST['status_laporan'],
					'SEKSI_ID' => $_POST['seksi'],
					'KPPN_ID' => $_POST['kppn'],
					'BIDANG_ID' => $_POST['bidang'],
					'USER_ID' => $this->session->userdata('ID'),
					'CATATAN' => $_POST['catatan']
				);	
				//var_dump($this->data['insert']);die;
				$result = $this->laporan_model->insert($this->data['insert']);
				if($result == true){
					$info = array();
					$info[] = 'Insert data successfully';						
					$this->data['info'] = (object) array (
						'type'  	=> 'success',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);
				}else{
					$info = array();
					$info[] = 'Insert data not successfull';
					$this->data['info'] = (object) array (
						'type'  	=> 'error',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);
				}				
				echo json_encode($this->data['info']);			
			}
		}else{
			$opt_sumber = array();
			$opt_sumber[] = (object) array('label'=>'upload', 'value'=>'upload');
			$opt_sumber[] = (object) array('label'=>'gdrive', 'value'=>'gdrive');
			
			$filters = array();
			$filters[] = "STATUS = '1'";
			$opt_jenis = $this->get_option_data($this->jenis_laporan_model, $filters);				
			
			$filters = array();
			$filters[] = "STATUS = '1'";
			$opt_periode = $this->get_option_data($this->periode_laporan_model, $filters);	

			$filters = array();
			$filters[] = "STATUS = '1'";
			if ($this->session->userdata('ROLE_NAME') == 'kppn'){
				$filters[] = "ID = '1'";
			}
			$opt_status = $this->get_option_data($this->status_laporan_model, $filters);

			$filters = array();
			$filters[] = "A.STATUS = '1'";
			$opt_seksi = $this->get_option_data($this->seksi_model, $filters);

			$filters = array();
			$filters[] = "STATUS = '1'";
			if ($this->session->userdata('ROLE_NAME') == 'kppn'){
				$filters[] = "KODE = '".$this->session->userdata('USERNAME')."'";
			}
			$opt_kppn = $this->get_option_data($this->kppn_model, $filters);

			$filters = array();
			$filters[] = "STATUS = '1'";
			$opt_bidang = $this->get_option_data($this->bidang_model, $filters);			
			
			$fields = array();	
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Nama',
				'name' 			=> 'nama',
				'placeholder'	=> 'nama',
				'value' 		=> '',
				'classes' 		=> 'full-width',
			);	
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Nomor',
				'name' 			=> 'nomor',
				'placeholder'	=> 'nomor',
				'value' 		=> '',
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'date',
				'label' 		=> 'Tanggal',
				'name' 			=> 'tanggal',
				'placeholder'	=> 'tanggal',
				'value' 		=> '',
				'classes' 		=> '',
			);	
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Sumber',
				'name' 			=> 'sumber',
				'placeholder'	=> '-- Pilih Sumber --',
				'options' 		=> $opt_sumber,
				'value' 		=> '',				
				'classes' 		=> '',
			);				
			$fields[] = (object) array(
				'type' 			=> 'file',
				'label' 		=> 'File',
				'name' 			=> 'upload',
				'placeholder'	=> 'file',
				'value' 		=> '',
				'classes' 		=> 'active-when-sumber-upload',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Link Gdrive',
				'name' 			=> 'gdrive',
				'placeholder'	=> 'gdrive',
				'value' 		=> '',
				'classes' 		=> 'active-when-sumber-gdrive',
			);	
			$fields[] = (object) array(
				'type' 			=> 'separation',
				'classes' 		=> 'full-width',
			);			
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Jenis Laporan',
				'name' 			=> 'jenis_laporan',
				'placeholder'	=> '-- Pilih Jenis --',
				'options' 		=> $opt_jenis,
				'value' 		=> '',				
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Periode Laporan',
				'name' 			=> 'periode_laporan',
				'placeholder'	=> '-- Pilih Periode --',
				'options' 		=> $opt_periode,
				'value' 		=> '',				
				'classes' 		=> '',
			);
			if ($this->session->userdata('ROLE_NAME') == 'kppn'){
				$fields[] = (object) array(
					'type' 			=> 'hidden',
					'label' 		=> 'Status Laporan',
					'name' 			=> 'status_laporan',
					'value' 		=> '1',		
					'classes' 		=> '',
				);				
			}else{
				$fields[] = (object) array(
					'type' 			=> 'select',
					'label' 		=> 'Status Laporan',
					'name' 			=> 'status_laporan',
					'placeholder'	=> '-- Pilih Status --',
					'options' 		=> $opt_status,
					'value' 		=> '',				
					'classes' 		=> 'full-width',
				);
			}
			$fields[] = (object) array(
				'type' 			=> 'separation',
				'classes' 		=> 'full-width',
			);				
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Dari Seksi',
				'name' 			=> 'seksi',
				'placeholder'	=> '-- Pilih Seksi --',
				'options' 		=> $opt_seksi,
				'value' 		=> '',				
				'classes' 		=> '',
			);
			if ($this->session->userdata('ROLE_NAME') == 'kppn'){
				$fields[] = (object) array(
					'type' 			=> 'select',
					'label' 		=> 'KPPN',
					'name' 			=> 'kppn',
					'placeholder'	=> '',
					'options' 		=> $opt_kppn,
					'value' 		=> '',				
					'classes' 		=> '',
				);
			}else{
				$fields[] = (object) array(
					'type' 			=> 'select',
					'label' 		=> 'KPPN',
					'name' 			=> 'kppn',
					'placeholder'	=> '-- Pilih KPPN --',
					'options' 		=> $opt_kppn,
					'value' 		=> '',				
					'classes' 		=> '',
				);				
			}
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Ke Bidang',
				'name' 			=> 'bidang',
				'placeholder'	=> '-- Pilih Bidang --',
				'options' 		=> $opt_bidang,
				'value' 		=> '',				
				'classes' 		=> 'full-width',
			);
			$fields[] = (object) array(
				'type' 			=> 'separation',
				'classes' 		=> 'full-width',
			);
			$fields[] = (object) array(
				'type' 			=> 'textarea',
				'label' 		=> 'Catatan',
				'name' 			=> 'catatan',
				'placeholder'	=> 'catatan',
				'value' 		=> '',
				'classes' 		=> 'full-width',
			);				
			$this->data['insert'] = (object) array (
				'type'  	=> 'insert_default',
				'data'		=> (object) array (
					'classes'  	=> '',
					'fields'  	=> $fields,
				)
			);	
			echo json_encode($this->data['insert']);				
		}
	}
	
	private function get_option_data($model, $filters){
		$data = $model->get($filters);
		$opt_data = array();
		if(empty($data)){
			$opt_data[] = (object) array('label'=>'No Data', 'value'=>'No Data');
		}else{
			foreach($data as $value){
				$opt_data[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
			}
		}
		return $opt_data;
	}
	
	public function update(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['submit'])){
			//validation
			$error_info = array();
			$error_status = false;
			if($_POST['nama'] == ''){
				$error_info[] = 'Nama can not be null';
				$error_status = true;
			}
			if($_POST['sumber'] == ''){
				$error_info[] = 'sumber can not be null';
				$error_status = true;
			}	
			if($_POST['jenis_laporan'] == ''){
				$error_info[] = 'jenis laporan can not be null';
				$error_status = true;
			}
			if($_POST['periode_laporan'] == ''){
				$error_info[] = 'periode laporan can not be null';
				$error_status = true;
			}
			if($_POST['status_laporan'] == ''){
				$error_info[] = 'status laporan can not be null';
				$error_status = true;
			}
			if($_POST['seksi'] == ''){
				$error_info[] = 'dari seksi can not be null';
				$error_status = true;
			}
			if($_POST['kppn'] == ''){
				$error_info[] = 'kppn can not be null';
				$error_status = true;
			}
			if($_POST['bidang'] == ''){
				$error_info[] = 'bidang can not be null';
				$error_status = true;
			}
			$file = '';
			if($_POST['sumber'] == 'gdrive'){
				if($_POST['gdrive'] == ''){
					$error_info[] = 'link gdrive can not be null';
					$error_status = true;					
				}else{
					$file = $_POST['gdrive'];
				}
			}else if($_POST['sumber'] == 'upload'){
				if(isset($_FILES["upload"])){
					if($_FILES["upload"] != null){
						$allowed_exts = array("pdf");
						$extension = explode("/", $_FILES["upload"]["type"]);
						$extension = end($extension);
						$true_ext = false;
						foreach($allowed_exts as $val){
							if($extension == $val){
								$true_ext = true;
							}
						}
						if($true_ext == false){
							$error_info[] = 'Only accept pdf';
							$error_status = true;				
						}
						if($_FILES["upload"]["size"] > '5000000'){
							$error_info[] = 'Max file size 5mb';
							$error_status = true;								
						}
						if($error_status == false){
							//upload file
							$filename = $_FILES['upload']['name'];
							$target_dir = FCPATH."public/files/";
							$uniq = date('YmdHis');
							$rename = $uniq . '_' . $filename;
							$success_upload = move_uploaded_file($_FILES["upload"]["tmp_name"], $target_dir . $rename);
							
							if(!$success_upload){
								$error_info[] = 'Error upload photo';
								$error_status = true;
							}else{
								$file = base_url().'public/files/'.$rename;
								if($_POST['recent_sumber'] == 'upload' and ($_POST['recent_file'] != '' or $_POST['recent_file'] != null)){
									$recent_file = explode('/', $_POST['recent_file']);
									$recent_file = end($recent_file);
									unlink(FCPATH."public/files/".$recent_file);
								}
							}
						}
					}
				}else{
					if($_POST['recent_sumber'] == 'upload' and ($_POST['recent_file'] != '' or $_POST['recent_file'] != null)){
						
					}else{
						$error_info[] = 'File laporan can not be null';
						$error_status = true;
					}					
				}
			}
			
			if($error_status == true){
				$this->data['error'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $error_info,
					)
				);				
				echo json_encode($this->data['error']);
			}else{
				$this->data['update'] = array(
					'NAMA' => $_POST['nama'],
					'NOMOR' => $_POST['nomor'],
					'TANGGAL' => $_POST['tanggal'],
					'SUMBER' => $_POST['sumber'],
					'FILE' => $file,
					'JENIS_LAPORAN_ID' => $_POST['jenis_laporan'],
					'PERIODE_LAPORAN_ID' => $_POST['periode_laporan'],
					'STATUS_LAPORAN_ID' => $_POST['status_laporan'],
					'SEKSI_ID' => $_POST['seksi'],
					'KPPN_ID' => $_POST['kppn'],
					'BIDANG_ID' => $_POST['bidang'],
					'USER_ID' => $this->session->userdata('ID'),
					'CATATAN' => $_POST['catatan']
				);	
				//var_dump($this->data['update']);die;
				$result = $this->laporan_model->update($this->data['update'], $_POST['id']);
				if($result == true){
					$info = array();
					$info[] = 'update data successfully';						
					$this->data['info'] = (object) array (
						'type'  	=> 'success',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);
				}else{
					$info = array();
					$info[] = 'update data not successfull';
					$this->data['info'] = (object) array (
						'type'  	=> 'error',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);
				}				
				echo json_encode($this->data['info']);			
			}			
		}else{
			$r_nama = '';
			$r_nomor = '';
			$r_tanggal = '';
			$r_sumber = '';
			$r_file = '';
			$r_jenis_laporan = '';
			$r_periode_laporan = '';
			$r_status_laporan = '';
			$r_seksi = '';
			$r_kppn = '';
			$r_bidang = '';
			$r_catatan = '';
			
			$filter = array();
			$filter[] = "A.ID = ". $_POST['id'];
			$this->data['result'] = $this->laporan_model->get($filter);
			foreach($this->data['result'] as $value){
				$r_id 	= $value->ID;
				$r_nama = $value->NAMA;
				$r_nomor = $value->NOMOR;
				$r_tanggal = $value->TANGGAL;
				$r_sumber = $value->SUMBER;
				$r_file = $value->FILE;
				$r_jenis_laporan = $value->JENIS_LAPORAN_ID;
				$r_periode_laporan = $value->PERIODE_LAPORAN_ID;
				$r_status_laporan = $value->STATUS_LAPORAN_ID;
				$r_seksi = $value->SEKSI_ID;
				$r_kppn = $value->KPPN_ID;
				$r_bidang = $value->BIDANG_ID;
				$r_catatan = $value->CATATAN;
			}
			
			$opt_sumber = array();
			$opt_sumber[] = (object) array('label'=>'upload', 'value'=>'upload');
			$opt_sumber[] = (object) array('label'=>'gdrive', 'value'=>'gdrive');
			
			$filters = array();
			$filters[] = "STATUS = '1'";
			$opt_jenis = $this->get_option_data($this->jenis_laporan_model, $filters);				
			
			$filters = array();
			$filters[] = "STATUS = '1'";
			$opt_periode = $this->get_option_data($this->periode_laporan_model, $filters);	

			$filters = array();
			$filters[] = "STATUS = '1'";
			if ($this->session->userdata('ROLE_NAME') == 'kppn'){
				$filters[] = "ID = '1'";
			}
			$opt_status = $this->get_option_data($this->status_laporan_model, $filters);

			$filters = array();
			$filters[] = "A.STATUS = '1'";
			$opt_seksi = $this->get_option_data($this->seksi_model, $filters);

			$filters = array();
			$filters[] = "STATUS = '1'";
			if ($this->session->userdata('ROLE_NAME') == 'kppn'){
				$filters[] = "KODE = '".$this->session->userdata('USERNAME')."'";
			}
			$opt_kppn = $this->get_option_data($this->kppn_model, $filters);

			$filters = array();
			$filters[] = "STATUS = '1'";
			$opt_bidang = $this->get_option_data($this->bidang_model, $filters);			
			
			$fields = array();
			$fields[] = (object) array(
				'type' 		=> 'hidden',
				'label' 	=> 'id',
				'name' 		=> 'id',
				'value' 	=> $r_id,
				'classes' 	=> '',
			);				
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Nama',
				'name' 			=> 'nama',
				'placeholder'	=> 'nama',
				'value' 		=> $r_nama,
				'classes' 		=> 'full-width',
			);	
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Nomor',
				'name' 			=> 'nomor',
				'placeholder'	=> 'nomor',
				'value' 		=> $r_nomor,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'date',
				'label' 		=> 'Tanggal',
				'name' 			=> 'tanggal',
				'placeholder'	=> 'tanggal',
				'value' 		=> $r_tanggal,
				'classes' 		=> '',
			);	
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Sumber',
				'name' 			=> 'sumber',
				'placeholder'	=> '-- Pilih Sumber --',
				'options' 		=> $opt_sumber,
				'value' 		=> $r_sumber,				
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'hidden',
				'label' 		=> 'Recent Sumber',
				'name' 			=> 'recent_sumber',
				'value' 		=> $r_sumber,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'info',
				'label' 		=> 'Recent File',
				'placeholder'	=> 'recent file',
				'value' 		=> '<a href="'.$r_file.'" target="_blank" title="view"><i style="font-size: 16px;" class="far fa-eye"></i></a>',
				'classes' 		=> '',
			);	
			$fields[] = (object) array(
				'type' 			=> 'hidden',
				'label' 		=> 'Recent File',
				'name' 			=> 'recent_file',
				'value' 		=> $r_file,
				'classes' 		=> '',
			);				
			$fields[] = (object) array(
				'type' 			=> 'file',
				'label' 		=> 'File',
				'name' 			=> 'upload',
				'placeholder'	=> 'file',
				'value' 		=> '',
				'classes' 		=> 'active-when-sumber-upload full-width',
			);
			if($r_sumber == 'gdrive'){
				$fields[] = (object) array(
					'type' 			=> 'text',
					'label' 		=> 'Link Gdrive',
					'name' 			=> 'gdrive',
					'placeholder'	=> 'gdrive',
					'value' 		=> $r_file,
					'classes' 		=> 'active-when-sumber-gdrive full-width',
				);
			}else{
				$fields[] = (object) array(
					'type' 			=> 'text',
					'label' 		=> 'Link Gdrive',
					'name' 			=> 'gdrive',
					'placeholder'	=> 'gdrive',
					'value' 		=> '',
					'classes' 		=> 'active-when-sumber-gdrive full-width',
				);				
			}
			$fields[] = (object) array(
				'type' 			=> 'separation',
				'classes' 		=> 'full-width',
			);			
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Jenis Laporan',
				'name' 			=> 'jenis_laporan',
				'placeholder'	=> '-- Pilih Jenis --',
				'options' 		=> $opt_jenis,
				'value' 		=> $r_jenis_laporan,				
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Periode Laporan',
				'name' 			=> 'periode_laporan',
				'placeholder'	=> '-- Pilih Periode --',
				'options' 		=> $opt_periode,
				'value' 		=> $r_periode_laporan,				
				'classes' 		=> '',
			);
			if ($this->session->userdata('ROLE_NAME') == 'kppn'){
				$fields[] = (object) array(
					'type' 			=> 'hidden',
					'label' 		=> 'Status Laporan',
					'name' 			=> 'status_laporan',
					'value' 		=> '1',				
					'classes' 		=> '',
				);				
			}else{
				$fields[] = (object) array(
					'type' 			=> 'select',
					'label' 		=> 'Status Laporan',
					'name' 			=> 'status_laporan',
					'placeholder'	=> '-- Pilih Status --',
					'options' 		=> $opt_status,
					'value' 		=> $r_status_laporan,				
					'classes' 		=> 'full-width',
				);
			}
			$fields[] = (object) array(
				'type' 			=> 'separation',
				'classes' 		=> 'full-width',
			);				
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Dari Seksi',
				'name' 			=> 'seksi',
				'placeholder'	=> '-- Pilih Seksi --',
				'options' 		=> $opt_seksi,
				'value' 		=> $r_seksi,				
				'classes' 		=> '',
			);
			if ($this->session->userdata('ROLE_NAME') == 'kppn'){
				$fields[] = (object) array(
					'type' 			=> 'select',
					'label' 		=> 'KPPN',
					'name' 			=> 'kppn',
					'placeholder'	=> '',
					'options' 		=> $opt_kppn,
					'value' 		=> $r_kppn,				
					'classes' 		=> '',
				);				
			}else{
				$fields[] = (object) array(
					'type' 			=> 'select',
					'label' 		=> 'KPPN',
					'name' 			=> 'kppn',
					'placeholder'	=> '-- Pilih KPPN --',
					'options' 		=> $opt_kppn,
					'value' 		=> $r_kppn,				
					'classes' 		=> '',
				);
			}
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Ke Bidang',
				'name' 			=> 'bidang',
				'placeholder'	=> '-- Pilih Bidang --',
				'options' 		=> $opt_bidang,
				'value' 		=> $r_bidang,				
				'classes' 		=> 'full-width',
			);
			$fields[] = (object) array(
				'type' 			=> 'separation',
				'classes' 		=> 'full-width',
			);
			$fields[] = (object) array(
				'type' 			=> 'textarea',
				'label' 		=> 'Catatan',
				'name' 			=> 'catatan',
				'placeholder'	=> 'catatan',
				'value' 		=> $r_catatan,
				'classes' 		=> 'full-width',
			);					

			$this->data['update'] = (object) array (
				'type'  	=> 'update_default',
				'data'		=> (object) array (
					'classes'  	=> '',
					'fields'  	=> $fields,
				)
			);
			echo json_encode($this->data['update']);
		}
	}
	
	public function detail($id=null){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['id']) and $_POST['id'] != null){
			$filters = array();
			$filters[] = "A.ID = ". $_POST['id'];
			$data = $this->laporan_model->get($filters);
			
			$body= array();			
			if (empty($data)) {
                $body[] = array(
                    (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'No Data')
                );
			} else {
				foreach($data as $value){
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Nama' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->NAMA ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Nomor' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->NOMOR ),
					);					
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Tanggal' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->TANGGAL ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Sumber' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->SUMBER ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'File' ),
						(object) array( 'classes' => ' align-left ', 'value' => '<a href="'.$value->FILE.'" target="_blank" title="view"><i style="font-size: 16px;" class="far fa-eye"></i></a>' ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Jenis Laporan' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->BNAMA ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Periode Laporan' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->CNAMA ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Status Laporan' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->DNAMA ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Dari Seksi' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->ENAMA ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'KPPN' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->FNAMA ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Ke Bidang' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->GNAMA ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Catatan' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->CATATAN ),
					);					
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Create Date' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->CREATE_DATE ),
					);					
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Update Date' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->UPDATE_DATE ),
					);
				}
			}
			
			$header = array(
				array (
					(object) array ('rowspan' => 1, 'classes' => 'bold align-left capitalize', 'value' => 'Label'),
					(object) array ('colspan' => 1, 'classes' => 'bold align-left capitalize', 'value' => 'Value'),	
				)		
			);			
			
			$this->data['detail'] = (object) array (
				'type'  	=> 'detail_default',
				'data'		=> (object) array (
					'classes'	=> 'striped bordered hover',
					'header'	=> $header,
					'body'		=> $body,
				)
			);			
			echo json_encode($this->data['detail']);
		}
	}
	
	public function update_status(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['id']) and $_POST['id'] != null){
			$filters = array();
			$filters[] = "ID = ". $_POST['id'];
			
			$result = $this->laporan_model->get($filters);
			if($result != null){
				foreach($result as $item){
					$status = $item->STATUS;
				}
				if($status == '1'){
					$new_status = '0';
				}else if($status == '0'){
					$new_status = '1';
				}
			}
			
			$this->data['update'] = array(
					'STATUS' => $new_status,
				);	
				
			$result = $this->laporan_model->update($this->data['update'], $_POST['id']);
			if($result == true){
				$info = array();
				$info[] = 'Update status data successfully';						
				$this->data['info'] = (object) array (
					'type'  	=> 'success',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);
			}else{
				$info = array();
				$info[] = 'Update status data not successfull';
				$this->data['info'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);
			}			
			echo json_encode($this->data['info']);	
		}
	}
	
	public function delete(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		$this->data['delete'] = array(
				'ID' => $_POST['id'],
			);		
		$result = $this->laporan_model->delete($this->data['delete']);
		
		if($result == true){
			$info = array();
			$info[] = 'Delete data successfully';			
			$info[] = 'Have a nice day';			
			$this->data['info'] = (object) array (
				'type'  	=> 'success',
				'data'		=> (object) array (
					'info'	=> $info,
				)
			);
		}else{
			$info = array();
			$info[] = 'Delete data not successfull';
			$this->data['info'] = (object) array (
				'type'  	=> 'error',
				'data'		=> (object) array (
					'info'	=> $info,
				)
			);
		}
		echo json_encode($this->data['info']);			
	}
	
}

