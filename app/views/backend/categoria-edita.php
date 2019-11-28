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
