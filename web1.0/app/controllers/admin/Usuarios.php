<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}
		$this->load->helper('funcoes');
		$this->load->library('table');
		$this->load->model('usuarios_model', 'modelusuarios');
		$dados['usuarios'] = $this->modelusuarios->listar_autores();

		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel Administrativo';
		$dados['subtitulo'] = 'Usuários';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/usuarios');
		$this->load->view('backend/template/html-footer');
	}

	public function inserir() {
		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}
		$this->load->model('usuarios_model', 'modelusuarios');
		/* Validações */
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required|min_length[5]');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[usuario.email]');
		$this->form_validation->set_rules('historico', 'Histórico', 'required|min_length[20]');
		$this->form_validation->set_rules('nomeuser', 'Nome de Acesso', 'required|min_length[6]|is_unique[usuario.user]');
		$this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
		$this->form_validation->set_rules('senha-conf', 'Confirmar Senha', 'required|matches[senha]');
		/* Fim validações */
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$nome = $this->input->post('nome');
			$email = $this->input->post('email');
			$historico = $this->input->post('historico');
			$nomeuser = $this->input->post('nomeuser');
			$senha = $this->input->post('senha');
			if ($this->modelusuarios->adicionar($nome, $email, $historico, $nomeuser, $senha)) {
				redirect(base_url('admin/usuarios'));
			} else {
				echo "Cadastro não realizado; verifique com o Administrador do Sistema!";
			}
		}
	}

	public function excluir($id) {
		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}
		$this->load->model('usuarios_model', 'modelusuarios');
		if ($this->modelusuarios->excluir($id)) {
			redirect(base_url('admin/usuarios'));
		} else {
			echo "Exclusão não realizada; verifique com o Administrador do Sistema!";
		}
	}

	public function alterar($id) {
		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}
		$this->load->model('usuarios_model', 'modelusuarios');
		$dados['usuarios'] = $this->modelusuarios->listar_usuario($id);
		/* Dados para envio ao Header */
		$dados['titulo'] = 'Painel Administrativo';
		$dados['subtitulo'] = 'Usuários';

		$this->load->view('backend/template/html-header', $dados);
		$this->load->view('backend/template/template');
		$this->load->view('backend/alterar-usuario');
		$this->load->view('backend/template/html-footer');
	}

	public function salvar_alteracoes($idCrip, $userComp, $emailComp) {
		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}
		$this->load->model('usuarios_model', 'modelusuarios');
		/* Validações */
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required|min_length[5]');

		$email = limpar($this->input->post('email'));
		if ($emailComp != $email) {
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[usuario.email]');
		}

		$this->form_validation->set_rules('historico', 'Histórico', 'required|min_length[20]');

		$user = $this->input->post('nomeuser');
		If ($userComp != $user) {
			$this->form_validation->set_rules('nomeuser', 'Nome de Acesso', 'required|min_length[6]|is_unique[usuario.user]');
		}

		$senha = $this->input->post('senha');
		if ($senha != '') {
			$this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
			$this->form_validation->set_rules('senha-conf', 'Confirmar Senha', 'required|matches[senha]');
		}
		/* Fim validações */
		if ($this->form_validation->run() == FALSE) {
			$this->alterar($idCrip);
		} else {
			$nome = $this->input->post('nome');
			$email = $this->input->post('email');
			$historico = $this->input->post('historico');
			$nomeuser = $this->input->post('nomeuser');
			$senha = $this->input->post('senha');
			$id = $this->input->post('id');
			if ($this->modelusuarios->alterar($nome, $email, $historico, $nomeuser, $senha, $id)) {
				redirect(base_url('admin/usuarios'));
			} else {
				echo "Alteração não realizada; verifique com o Administrador do Sistema!";
			}
		}
	}

	public function nova_foto() {
		if (!$this->session->userdata('logado')) {
			redirect(base_url('admin/login'));
		}
		$this->load->model('usuarios_model', 'modelusuarios');

		$id = $this->input->post('id');
		$nomeuser = $this->input->post('user');
		$config['upload_path'] = './assets/frontend/img/usuarios';
		$config['allowed_types'] = 'jpg';
		$config['file_name'] = $id.'jpg';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			echo $this->upload->display_errors();
		} else {
			$config2['source_image'] = './assets/frontend/img/usuarios/'.$id.'.jpg';
			$config2['create_thumb'] = FALSE;
			$config2['width'] = 200;
			$config2['height'] = 200;
			$this->load->library('image_lib', $config2);

			if ($this->image_lib->resize()) {
				if ($this->modelusuarios->alterar_img($id)) {
					redirect(base_url('admin/usuarios/alterar/'.$id));
				} else {
					echo "Alteração não realizada; verifique com o Administrador do Sistema!";
				}
			} else {
				echo $this->image_lib->display_errors();
			}
		}

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
			$this->db->where('senha', md5($senha));
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
