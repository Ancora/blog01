<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('categorias_model', 'modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();
	}

	public function index($id, $nome, $pular = null, $post_por_pagina = null)
	{
		$this->load->model('postagens_model', 'modelpostagens');
		$this->load->library('pagination');

		$config['base_url'] = base_url('categoria/'.$id.'/'.$nome);
		$config['total_rows'] = $this->modelpostagens->contar_posts_categoria($id);
		$post_por_pagina = 3;
		$config['per_page'] = $post_por_pagina;
		$this->pagination->initialize($config);
		$dados['links_paginacao'] = $this->pagination->create_links();

		$this->load->helper('funcoes');
		$dados['categorias'] = $this->categorias;
		$dados['postagens'] = $this->modelpostagens->categoria_post($id, $pular, $post_por_pagina);

		/* Dados para envio ao Header */
		$dados['titulo'] = 'Categorias';
		$dados['subtitulo'] = '';
		$dados['subtitulodb'] = $this->modelcategorias->listar_titulo($id);

		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/categoria');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
}
