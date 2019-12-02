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
								foreach ($postagens as $postagem) {
									echo form_open('admin/postagens/salvar_alteracoes/'.md5($postagem->id));
							?>
							<div class="form-group">
								<label id="select-categoria">Categoria</label>
								<select id="select-categoria" name="select-categoria" class="form-control">
									<?php
										foreach($categorias as $categoria) {
									?>
										<option value="<?php echo $categoria->id ?>"
										<?php if ($categoria->id == $postagem->categoria) {
											echo "selected";
										}
										?>
										>
										<?php echo $categoria->titulo ?>
										</option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label id="titulo">Título</label>
								<input type="text" id="titulo" name="titulo" class="form-control" placeholder="Informe o Título" value="<?php echo $postagem->titulo; ?>">
							</div>
							<div class="form-group">
              	<label id="subtitulo">Subtítulo</label>
                <input type="text" id="subtitulo" name="subtitulo" class="form-control" placeholder="Informe o Subtítulo" value="<?php echo $postagem->subtitulo; ?>">
              </div>
							<div class="form-group">
              	<label id="conteudo">Conteúdo</label>
                <textarea type="text" id="conteudo" name="conteudo" class="form-control" placeholder="Conteúdo do Post"><?php echo $postagem->conteudo; ?></textarea>
              </div>
							<div class="form-group">
              	<label id="data">Data</label>
                <input type="datetime-local" id="data" name="data" class="form-control" placeholder="Data do Post"
								value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($postagem->data)); ?>">
              </div>

							<input type="hidden" name="id" value="<?php echo $postagem->id; ?>">

							<!-- <input type="hidden" name="id-usuario" id="id-usuario" value="<?php echo $this->session->userdata('userlogado')->id ?>"> -->

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
				<style type="text/css">
					img {
						width: 450px;
					}
				</style>
        <div class="panel-body">
					<div class="row" style="padding-bottom: 10px;">
            <div class="col-lg-8 col-lg-offset-1">
							<?php
								if ($postagem->img == 1) {
									echo img('assets/frontend/img/postagens/'.md5($postagem->id).'jpg'.'.jpg');
								} else {
									echo img('assets/frontend/img/semFoto2.png');
								}
							?>
						</div>
					</div>
        	<div class="row">
            <div class="col-lg-12">
							<?php
								$divopen = '<div class="form-group">';
								$divclose = '</div>';
								$imagem = array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
								$botao = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'class' => 'btn btn-primary', 'value' => 'Carregar Foto');

								echo form_open_multipart('admin/postagens/nova_foto');
								echo form_hidden('id', md5($postagem->id));
								/* echo form_hidden('user', $usuario->user); */
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
