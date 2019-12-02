<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('categorias_model', 'modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();
	}

	public function index($id, $slug = null)
	{
		$this->load->helper('funcoes');
		$dados['categorias'] = $this->categorias;
		$this->load->model('postagens_model', 'modelpostagens');
		$dados['postagens'] = $this->modelpostagens->postagem($id);

		/* Dados para envio ao Header */
		$dados['titulo'] = 'Post';
		$dados['subtitulo'] = '';
		$dados['subtitulodb'] = $this->modelpostagens->listar_titulo($id);

		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/postagem');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
}
