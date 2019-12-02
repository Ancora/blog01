<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">

    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>Adicionar</h5>
        </div>
        <div class="panel-body">
        	<div class="row">
            <div class="col-lg-12">
							<?php
								echo validation_errors('<div class="alert alert-danger">', '</div>');
								echo form_open('admin/postagens/inserir');
							?>
							<div class="form-group">
								<label id="select-categoria">Categoria</label>
								<select id="select-categoria" name="select-categoria" class="form-control">
									<?php
										foreach($categorias as $categoria) {
									?>
										<option value="<?php echo $categoria->id ?>"><?php echo $categoria->titulo ?></option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label id="titulo">Título</label>
								<input type="text" id="titulo" name="titulo" class="form-control" placeholder="Informe o Título" value="<?php echo set_value('titulo') ?>">
							</div>
							<div class="form-group">
              	<label id="subtitulo">Subtítulo</label>
                <input type="text" id="subtitulo" name="subtitulo" class="form-control" placeholder="Informe o Subtítulo" value="<?php echo set_value('subtitulo') ?>">
              </div>
							<div class="form-group">
              	<label id="conteudo">Conteúdo</label>
                <textarea type="text" id="conteudo" name="conteudo" class="form-control" placeholder="Conteúdo do Post"><?php echo set_value('conteudo') ?></textarea>
              </div>
							<div class="form-group">
              	<label id="data">Data</label>
                <input type="datetime-local" id="data" name="data" class="form-control" placeholder="Data do Post" value="<?php echo set_value('data') ?>">
              </div>

							<input type="hidden" name="id-usuario" id="id-usuario" value="<?php echo $this->session->userdata('userlogado')->id ?>">

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

    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>Alterar/Excluir</h5>
        </div>
        <div class="panel-body">
        	<div class="row">
            <div class="col-lg-12">
							<style>
								img {
									width: 100px;
								}
							</style>
							<?php
								$this->table->set_heading("Foto", "Título", "Data", "Alterar", "Excluir");
								foreach($postagens as $postagem) {
									$titulo = $postagem->titulo;
									if ($postagem->img == 1) {
										$fotopost = img('assets/frontend/img/postagens/'.md5($postagem->id).'jpg'.'.jpg');
									} else {
										$fotopost = img('assets/frontend/img/semFoto2.png');
									}
									$data = postadoem($postagem->data);
									$alterar = anchor(base_url('admin/postagens/alterar/'.md5($postagem->id)), '<span class="btn btn-primary"><i class="fa fa-edit fa-fw"></i></span>');
									$excluir = anchor(base_url('admin/postagens/excluir/'.md5($postagem->id)), '<span class="btn btn-danger"><i class="fa fa-remove fa-fw"></i></span>');

									$this->table->add_row($fotopost, $titulo, $data, $alterar, $excluir);
								}
								$this->table->set_template(array(
									'table_open' => '<table class="table table-striped">'
								));
								echo $this->table->generate();
								/* Paginação */
								echo '<div class="pagination">'.$links_paginacao.'</div>';
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
