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

	public function login() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user', 'Usuário', 'required|min_length[6]');
		$this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE) {
			$this->page_login();
		} else {
			$user = $this->input->post('user');
			$senha = $this->input->post('senha');
			$this->db->where('user', $user);
			$this->db->where('senha', $senha);
			$userlogado = $this->db->get('usuario')->result();

			if (count($userlogado) == 1) {
				$dadosSessao['userlogado'] = $userlogado[0];
				$dadosSessao['logado'] = TRUE;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin'));
			} else {
				$dadosSessao['userlogado'] = NULL;
				$dadosSessao['logado'] = FALSE;
				$this->session->set_userdata($dadosSessao);
				redirect(base_url('admin/login'));
			}
		}
	}

	public function logout() {
		$dadosSessao['userlogado'] = NULL;
		$dadosSessao['logado'] = FALSE;
		$this->session->set_userdata($dadosSessao);
		redirect(base_url('admin/login'));
	}
}
