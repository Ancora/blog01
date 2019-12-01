    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
							<?php
								foreach($postagens as $destaque) {
							?>
								<h1>
									<?php echo $destaque->titulo ?>
								</h1>
								<p class="lead">
									por <a href="<?php echo base_url('autor/'.$destaque->idautor.'/'.limpar($destaque->nome)) ?>"><?php echo $destaque->nome ?></a>
								</p>
								<p><span class="glyphicon glyphicon-time"></span> <?php echo postadoem($destaque->data) ?></p>
								<hr>
								<p><i><?php echo $destaque->subtitulo ?></i></p>
								<?php
								if ($destaque->img == 1) {
									$fotopost = base_url('assets/frontend/img/postagens/'.md5($destaque->id).'.jpg');
								?>
									<style type="text/css">
										img {
											width: 900px;
										}
									</style>
									<img class="img-responsive" src="<?php echo $fotopost ?>" alt="">
									<hr>
								<?php
								}
								?>
								<p><?php echo $destaque->conteudo ?></p>

								<hr>
							<?php
								}
							?>
            </div>
