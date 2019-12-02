<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}

		$this->load->model('categorias_model', 'modelcategorias');
		$this->load->model('postagens_model', 'modelpostagens');
		$this->categorias = $this->modelcategorias->listar_categorias();
	}

	public function index($pular = null, $post_por_pagina = null, $incluido = null)
	{
		$this->load->helper('funcoes');
		$this->load->library('table');
		$this->load->library('pagination');

		$config['base_url'] = base_url('admin/postagens');
		$config['total_rows'] = $this->modelpostagens->contar_posts();
		$post_por_pagina = 5;
		$config['per_page'] = $post_por_pagina;
		$this->pagination->initialize($config);
		$dados['links_paginacao'] = $this->pagination->create_links();

		$dados['categorias'] = $this->categorias;
		$dados['postagens'] = $this->modelpostagens->listar_postagens($pular, $post_por_pagina);
		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel Administrativo';
		$dados['subtitulo'] = 'Postagens';

		$dados['incluido'] = $incluido;

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/postagens');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');
		$this->form_validation->set_rules('subtitulo', 'Subtítulo', 'required|min_length[3]');
		$this->form_validation->set_rules('conteudo', 'Conteúdo', 'required|min_length[20]');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$titulo = $this->input->post('titulo');
			$subtitulo = $this->input->post('subtitulo');
			$conteudo = $this->input->post('conteudo');
			$data = $this->input->post('data');
			$categoria = $this->input->post('select-categoria');
			$user = $this->input->post('id-usuario');
			if ($this->modelpostagens->adicionar($titulo, $subtitulo, $conteudo, $data, $categoria, $user)) {
				redirect(base_url('admin/postagens/1'));
			} else {
				echo "Cadastro não realizado; verifique com o Administrador do Sistema!";
			}
		}
	}

	public function excluir($id) {
		if ($this->modelpostagens->excluir($id)) {
			redirect(base_url('admin/postagens'));
		} else {
			echo "Exclusão não realizada; verifique com o Administrador do Sistema!";
		}
	}

	public function alterar($id) {

		$this->load->library('table');
		$dados['categorias'] = $this->modelcategorias->listar_categorias();
		$dados['postagens'] = $this->modelpostagens->listar_postagem($id);
		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel Administrativo';
		$dados['subtitulo'] = 'Postagens';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-postagem');
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes($idCrip) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');
		$this->form_validation->set_rules('subtitulo', 'Subtítulo', 'required|min_length[3]');
		$this->form_validation->set_rules('conteudo', 'Conteúdo', 'required|min_length[20]');

		if ($this->form_validation->run() == FALSE) {
			$this->alterar($idCrip);
		} else {
			$titulo = $this->input->post('titulo');
			$subtitulo = $this->input->post('subtitulo');
			$conteudo = $this->input->post('conteudo');
			$data = $this->input->post('data');
			$categoria = $this->input->post('select-categoria');
			$id = $this->input->post('id');
			if ($this->modelpostagens->alterar($titulo, $subtitulo, $conteudo, $data, $categoria, $id)) {
				redirect(base_url('admin/postagens'));
			} else {
				echo "Alteração não realizada; verifique com o Administrador do Sistema!";
			}
		}
	}

	public function nova_foto() {
		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}

		$id = $this->input->post('id');
		$config['upload_path'] = './assets/frontend/img/postagens';
		$config['allowed_types'] = 'jpg';
		$config['file_name'] = $id.'jpg';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			echo $this->upload->display_errors();
		} else {
			$config2['source_image'] = './assets/frontend/img/postagens/'.$id.'jpg'.'.jpg';
			$config2['create_thumb'] = FALSE;
			$config2['width'] = 900;
			$config2['height'] = 300;
			$this->load->library('image_lib', $config2);

			if ($this->image_lib->resize()) {
				if ($this->modelpostagens->alterar_img($id)) {
					redirect(base_url('admin/postagens/alterar/'.$id));
				} else {
					echo "Alteração não realizada; verifique com o Administrador do Sistema!";
				}
			} else {
				echo $this->image_lib->display_errors();
			}
		}
	}
}
