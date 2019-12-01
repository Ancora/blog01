<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?php echo $subtitulo ?></h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <?php echo $subtitulo ?>
        </div>
        <div class="panel-body">
        	<div class="row">
            <div class="col-lg-12">
							<h2><?php echo $this->session->userdata('userlogado')->nome; ?></h2>
              <h3>Bem vindo ao seu Painel Administrativo!</h3>
            </div>
          </div>
          <!-- /.row (nested) -->
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
	</div>
  <!-- /.row -->
</div>
<!-- /#page-wrapper -->
