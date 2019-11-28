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
          <?php echo 'Adicionar nova '.$subtitulo ?>
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
          <?php echo 'Alterar '.$subtitulo.' existente' ?>
        </div>
        <div class="panel-body">
        	<div class="row">
            <div class="col-lg-12">
							<?php
								$this->table->set_heading("Nome", "Alterar", "Excluir");
								foreach($categorias as $categoria) {
									$nomecat = $categoria->titulo;
									$alterar = anchor(base_url('admin/categoria'), '<i class="fa fa-edit fa-fw"></i>');
									$excluir = anchor(base_url('admin/categoria'), '<i class="fa fa-remove fa-fw"></i>');

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
<!-- /#page-wrapper -->
              <!-- <form role="form">
                <div class="form-group">
                  <label>Titulo</label>
                  <input class="form-control" placeholder="Entre com o texto">
                </div>
                <div class="form-group">
                  <label>Foto Destaque</label>
                    <input type="file">
                </div>
                <div class="form-group">
                  <label>Conteúdo</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label>Selects</label>
                    <select class="form-control">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                  	</select>
                  </div>
                  <button type="submit" class="btn btn-default">Cadastrar</button>
                	<button type="reset" class="btn btn-default">Limpar</button>
              </form> -->
