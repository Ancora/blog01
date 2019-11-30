<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens_model extends CI_Model {

	public $id;
	public $categoria;
	public $titulo;
	public $subtitulo;
	public $conteudo;
	public $data;
	public $img;
	public $user;

	public function __construct() {
		parent::__construct();
	}

	public function destaques_home() {
		$this->db->select('usuario.id as idautor, usuario.nome, postagens.id, postagens.titulo, postagens.subtitulo, postagens.user,
		postagens.data, postagens.img');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id = postagens.user');
		$this->db->limit(4);
		$this->db->order_by('postagens.data', 'DESC');
		return $this->db->get()->result();
	}

	public function categoria_post($id) {
		$this->db->select('usuario.id as idautor, usuario.nome, postagens.id, postagens.titulo, postagens.subtitulo, postagens.user,
		postagens.data, postagens.img, postagens.categoria');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id = postagens.user');
		$this->db->where('postagens.categoria ='.$id);
		$this->db->order_by('postagens.data', 'DESC');
		return $this->db->get()->result();
	}

	public function postagem($id) {
		$this->db->select('usuario.id as idautor, usuario.nome, postagens.id, postagens.titulo, postagens.subtitulo, postagens.user,
		postagens.data, postagens.img, postagens.categoria, postagens.conteudo');
		$this->db->from('postagens');
		$this->db->join('usuario', 'usuario.id = postagens.user');
		$this->db->where('postagens.id ='.$id);
		return $this->db->get()->result();
	}

	public function listar_titulo($id) {
		$this->db->select('id, titulo');
		$this->db->from('postagens');
		$this->db->where('id ='.$id);
		return $this->db->get()->result();
	}

	public function listar_postagens() {
		$this->db->order_by('data', 'DESC');
		return $this->db->get('postagens')->result();
	}

	public function listar_postagem($id) {
		$this->db->where('md5(id)', $id);
		return $this->db->get('postagens')->result();
	}

	public function adicionar($titulo, $subtitulo, $conteudo, $data, $categoria, $user) {
		$dados['titulo'] = $titulo;
		$dados['subtitulo'] = $subtitulo;
		$dados['conteudo'] = $conteudo;
		$dados['data'] = $data;
		$dados['categoria'] = $categoria;
		$dados['user'] = $user;
		return $this->db->insert('postagens', $dados);
	}

	public function excluir($id) {
		$this->db->where('md5(id)', $id);
		return $this->db->delete('postagens');
	}

}
