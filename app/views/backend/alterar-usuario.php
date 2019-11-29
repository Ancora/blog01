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
          <h5>Alterar</h5>
        </div>
        <div class="panel-body">
        	<div class="row">
            <div class="col-lg-12">
							<?php
								echo validation_errors('<div class="alert alert-danger">', '</div>');
								echo form_open('admin/usuarios/salvar_alteracoes');
								foreach($usuarios as $usuario) {
							?>
									<div class="form-group">
										<label id="nome">Nome</label>
										<input type="text" id="nome" name="nome" class="form-control" placeholder="Informe o Nome" value="<?php echo $usuario->nome ?>">
									</div>
									<div class="form-group">
										<label id="email">E-mail</label>
										<input type="text" id="email" name="email" class="form-control" placeholder="Informe o e-mail" value="<?php echo $usuario->email ?>">
									</div>
									<div class="form-group">
										<label id="historico">Histórico</label>
										<textarea type="text" id="historico" name="historico" class="form-control" placeholder="Breve descrição do Usuário"><?php echo $usuario->historico ?></textarea>
									</div>
									<div class="form-group">
										<label id="nomeuser">Nome de Acesso</label>
										<input type="text" id="nomeuser" name="nomeuser" class="form-control" placeholder="Informe o Nome para acesso" value="<?php echo $usuario->user ?>">
									</div>
									<div class="form-group">
										<label id="senha">Senha (mínimo de 6 caracteres)</label>
										<input type="password" id="senha" name="senha" class="form-control">
									</div>
									<div class="form-group">
										<label id="senha-conf">Confirmar Senha</label>
										<input type="password" id="senha-conf" name="senha-conf" class="form-control">
									</div>
									<input type="hidden" name="id" id="id" value="<?php echo $usuario->id ?>">
									<button type="submit" class="btn btn-primary">Atualizar</button>
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
          <h5>Foto</h5>
        </div>
        <div class="panel-body">
        	<div class="row">
            <div class="col-lg-12">
							<?php
								$divopen = '<div class="form-group">';
								$divclose = '</div>';
								$imagem = array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
								$botao = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'class' => 'btn btn-primary', 'value' => 'Carregar Foto');

								echo form_open_multipart('admin/usuarios/nova_foto');
								echo form_hidden('id', md5($usuario->id));
								echo $divopen;
								echo form_upload($imagem);
								echo $divclose;
								echo $divopen;
								echo form_submit($botao);
								echo $divclose;
								echo form_close();
								}
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
