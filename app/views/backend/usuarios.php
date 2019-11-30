<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">

    <div class="col-lg-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>Adicionar</h5>
        </div>
        <div class="panel-body">
        	<div class="row">
            <div class="col-lg-12">
							<?php
								echo validation_errors('<div class="alert alert-danger">', '</div>');
								echo form_open('admin/usuarios/inserir');
							?>
							<div class="form-group">
              	<label id="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Informe o Nome" value="<?php echo set_value('nome') ?>">
              </div>
							<div class="form-group">
              	<label id="email">E-mail</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Informe o e-mail" value="<?php echo set_value('email') ?>">
              </div>
							<div class="form-group">
              	<label id="historico">Histórico</label>
                <textarea type="text" id="historico" name="historico" class="form-control" placeholder="Breve descrição do Usuário"><?php echo set_value('historico') ?></textarea>
              </div>
							<div class="form-group">
              	<label id="nomeuser">Nome de Acesso</label>
                <input type="text" id="nomeuser" name="nomeuser" class="form-control" placeholder="Informe o Nome para acesso" value="<?php echo set_value('nomeuser') ?>">
              </div>
							<div class="form-group">
              	<label id="senha">Senha (mínimo de 6 caracteres)</label>
                <input type="password" id="senha" name="senha" class="form-control">
              </div>
							<div class="form-group">
              	<label id="senha-conf">Confirmar Senha</label>
                <input type="password" id="senha-conf" name="senha-conf" class="form-control">
              </div>
							<button type="submit" class="btn btn-success">Cadastrar</button>
							<?php
								echo form_close();
							?>
            </div>
          </div>
          <!-- /.row (nested) -->
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
		<!-- /.col-lg-6 -->

    <div class="col-lg-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>Alterar/Excluir</h5>
        </div>
        <div class="panel-body">
        	<div class="row">
            <div class="col-lg-12">
							<style>
								img {
									width: 50px;
								}
							</style>
							<?php
								$this->table->set_heading("Foto", "Nome", "Alterar", "Excluir");
								foreach($usuarios as $usuario) {
									$nome = $usuario->nome;
									if ($usuario->img == 1) {
										$fotouser = img('assets/frontend/img/usuarios/'.md5($usuario->id).'jpg'.'.jpg');
									} else {
										$fotouser = img('assets/frontend/img/semFoto.png');
									}
									$alterar = anchor(base_url('admin/usuarios/alterar/'.md5($usuario->id)), '<span class="btn btn-primary"><i class="fa fa-edit fa-fw"></i></span>');
									$excluir = anchor(base_url('admin/usuarios/excluir/'.md5($usuario->id)), '<span class="btn btn-danger"><i class="fa fa-remove fa-fw"></i></span>');

									$this->table->add_row($fotouser, $nome, $alterar, $excluir);
								}
								$this->table->set_template(array(
									'table_open' => '<table class="table table-striped">'
								));
								echo $this->table->generate();
							?>
            </div>
          </div>
          <!-- /.row (nested) -->
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
		<!-- /.col-lg-6 -->

	</div>
  <!-- /.row -->
</div>
