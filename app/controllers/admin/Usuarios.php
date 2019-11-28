<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel Administrativo';
		$dados['subtitulo'] = 'Home';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/home');
		$this->load->view('backend/template/html-footer');
	}

	public function page_login() {
		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel Administrativo';
		$dados['subtitulo'] = 'Login';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/login');
		$this->load->view('backend/template/html-footer');
	}
}
