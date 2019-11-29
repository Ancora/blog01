<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}

		$this->load->model('categorias_model', 'modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();
	}

	public function index()
	{
		$this->load->library('table');
		$dados['categorias'] = $this->categorias;
		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel Administrativo';
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
				echo "Cadastro não realizado; verifique com o Administrador do Sistema!";
			}
		}
	}

	public function excluir($id) {
		if ($this->modelcategorias->excluir($id)) {
			redirect(base_url('admin/categoria'));
		} else {
			echo "Exclusão não realizada; verifique com o Administrador do Sistema!";
		}
	}

	public function alterar($id) {

		$this->load->library('table');
		$dados['categorias'] = $this->modelcategorias->listar_categoria($id);
		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel Administrativo';
		$dados['subtitulo'] = 'Categoria';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-categoria');
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]|is_unique[categoria.titulo]');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$titulo = $this->input->post('nome');
			$id = $this->input->post('id');
			if ($this->modelcategorias->alterar($titulo, $id)) {
				redirect(base_url('admin/categoria'));
			} else {
				echo "Alteração não realizada; verifique com o Administrador do Sistema!";
			}
		}
	}
}
