<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('categorias_model', 'modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();
	}

	public function index()
	{
		$this->load->library('table');
		$dados['categorias'] = $this->categorias;
		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel de Controle';
		$dados['subtitulo'] = 'Categoria';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/categoria');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]|is_unique[categoria.titulo]');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$titulo = $this->input->post('nome');
			if ($this->modelcategorias->adicionar($titulo)) {
				redirect(base_url('admin/categoria'));
			} else {
				echo "Cadastro não realizado; verifique com o Administardor!";
			}
		}
	}
}
