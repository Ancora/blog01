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
								if ($incluido == 1) {
									echo '<div class="alert alert-success">Categoria cadastrada!!!</div>';
								}
								echo validation_errors('<div class="alert alert-danger">', '</div>');
								echo form_open('admin/categoria/inserir');
							?>
							<div class="form-group">
              	<label id="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Informe o Nome">
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
							<?php
								$this->table->set_heading("Nome", "Alterar", "Excluir");
								foreach($categorias as $categoria) {
									$nomecat = $categoria->titulo;
									$alterar = anchor(base_url('admin/categoria/alterar/'.md5($categoria->id)), '<span class="btn btn-primary"><i class="fa fa-edit fa-fw"></i></span>');
									/* $excluir = anchor(base_url('admin/categoria/excluir/'.md5($categoria->id)), '<span class="btn btn-danger"><i class="fa fa-remove fa-fw"></i></span>'); */

									/* Modal EXCLUIR */
									$excluir= '<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".excluir-modal-'.$categoria->id.'"><i class="fa fa-remove fa-fw"></i></button>';
										echo $modal= '
										<div class="modal fade excluir-modal-'.$categoria->id.'" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<span><i class="fa fa-exclamation-triangle fa-fw"></i></span>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
														<h4 class="modal-title" id="myModalLabel2">Exclusão de Categoria</h4>
													</div>
													<div class="modal-body">
														<h4>Deseja Excluir a Categoria '.$categoria->titulo.'?</h4>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
														<a type="button" class="btn btn-outline-danger" href="'.base_url("admin/categoria/excluir/".md5($categoria->id)).'">Excluir</a>
													</div>
												</div>
											</div>
                    </div>';
									/* Fim modal EXCLUIR */

									$this->table->add_row($nomecat, $alterar, $excluir);
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
