<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('categorias_model', 'modelcategorias');
		$this->categorias = $this->modelcategorias->listar_categorias();
		$this->load->model('usuarios_model', 'modelusuarios');
	}

	public function index()
	{
		$this->load->helper('funcoes');
		$dados['categorias'] = $this->categorias;
		$dados['autores'] = $this->modelusuarios->listar_autores();

		/* Dados para envio ao Header */
		$dados['titulo'] = 'Sobre';
		$dados['subtitulo'] = 'Conheça Nossa Equipe';

		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/sobre');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}

	public function autores($id, $slug=null) {

		$this->load->helper('funcoes');
		$dados['categorias'] = $this->categorias;
		$dados['autores'] = $this->modelusuarios->listar_autor($id);

		/* Dados para envio ao Header */
		$dados['titulo'] = 'Sobre';
		$dados['subtitulo'] = 'Autor';

		$this->load->view('frontend/template/html-header', $dados);
		$this->load->view('frontend/template/header');
		$this->load->view('frontend/autor');
		$this->load->view('frontend/template/aside');
		$this->load->view('frontend/template/footer');
		$this->load->view('frontend/template/html-footer');
	}
}
