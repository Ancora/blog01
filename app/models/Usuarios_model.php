<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public $id;
	public $nome;
	public $email;
	public $img;
	public $historico;
	public $nomeuser;
	public $senha;

	public function __construct() {
		parent::__construct();
	}

	public function listar_autor($id) {
		$this->db->select('id, nome, historico, img');
		$this->db->from('usuario');
		$this->db->where('id ='.$id);
		return $this->db->get()->result();
	}

	public function listar_autores() {
		$this->db->select('id, nome, img');
		$this->db->from('usuario');
		$this->db->order_by('nome', 'ASC');
		return $this->db->get()->result();
	}

	public function adicionar($nome, $email, $historico, $nomeuser, $senha) {
		$dados['nome'] = $nome;
		$dados['email'] = $email;
		$dados['historico'] = $historico;
		$dados['user'] = $nomeuser;
		$dados['senha'] = md5($senha);
		return $this->db->insert('usuario', $dados);
	}

	public function excluir($id) {
		$this->db->where('md5(id)', $id);
		return $this->db->delete('usuario');
	}

	public function listar_usuario($id) {
		$this->db->select('id, nome, email, historico, user, img');
		$this->db->from('usuario');
		$this->db->where('md5(id)', $id);
		return $this->db->get()->result();
	}

	public function alterar($nome, $email, $historico, $nomeuser, $senha, $id) {
		$dados['nome'] = $nome;
		$dados['email'] = $email;
		$dados['historico'] = $historico;
		$dados['user'] = $nomeuser;
		if ($senha != '') {
			$dados['senha'] = md5($senha);
		}
		$this->db->where('id', $id);
		return $this->db->update('usuario', $dados);
	}

	public function alterar_img($id) {
		$dados['img'] = TRUE;
		$this->db->where('md5(id)', $id);
		return $this->db->update('usuario', $dados);
	}

}
