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
									$excluir = anchor(base_url('admin/categoria/excluir/'.md5($categoria->id)), '<span class="btn btn-danger"><i class="fa fa-remove fa-fw"></i></span>');

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
