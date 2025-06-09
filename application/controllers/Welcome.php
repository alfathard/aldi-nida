<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('ucapan');
	}

	public function index()
	{
		$data['tamu'] = $this->input->get('tamu');

		$this->load->view('index-2', $data);
	}

	public function konfirmasi(){
		$data['data'] = $this->ucapan->get_all();

		$this->load->view('konfirmasi', $data);
	}

	public function showall(){
		$ucapan = $this->ucapan->get_all();
		header('Content-Type: application/json');
		echo json_encode($ucapan);
	}

	public function show(){
		$ucapan = $this->ucapan->limit(5);
		header('Content-Type: application/json');
		echo json_encode($ucapan);
	}

	public function ucapan(){
		$storeData = array(
			'nama'	=>	ucwords($this->input->post('nama')),
			'pesan'		=>	$this->input->post('pesan'),
			'hadir' => $this->input->post('hadir')
		);

		$this->ucapan->insert($storeData);

		header('Content-Type: application/json');
		echo json_encode(['status' => "success"]);

//		$captcha_response = trim($this->input->post('g-recaptcha-response'));
//		print_r($captcha_response);
//		if($captcha_response != '') {
//			$keySecret = '6LeAHVUrAAAAAHOxdPrKC4F-D0NKftPZ_EpeloBL';
//
//			$check = array(
//				'secret'		=>	$keySecret,
//				'response'		=>	$this->input->post('g-recaptcha-response')
//			);
//
//			$startProcess = curl_init();
//
//			curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
//
//			curl_setopt($startProcess, CURLOPT_POST, true);
//
//			curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
//
//			curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
//
//			curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
//
//			$receiveData = curl_exec($startProcess);
//
//			$finalResponse = json_decode($receiveData, true);
//
//			if($finalResponse['success']) {
//				$storeData = array(
//					'nama'	=>	ucwords($this->input->post('nama')),
//					'pesan'		=>	$this->input->post('pesan')
//				);
//
//				$this->ucapan->insert($storeData);
//
//
//				header('Content-Type: application/json');
//				echo json_encode(['status' => "success"]);
//			} else {
//				header('Content-Type: application/json');
//				echo json_encode(['status' => "success"]);
//			}
//		} else {
//			$this->session->set_flashdata('message', 'Validation Fail Try Again');
//			redirect('/');
//		}
	}
}
