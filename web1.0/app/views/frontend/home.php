    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
									<?php echo $titulo ?>
                    <small>> <?php echo $subtitulo ?></small>
                </h1>

				<?php
					foreach($postagens as $destaque) {
				?>
					<h2>
						<a href="<?php echo base_url('postagem/'.$destaque->id.'/'.limpar($destaque->titulo)) ?>"><?php echo $destaque->titulo ?></a>
					</h2>
					<p class="lead">
						por <a href="<?php echo base_url('autor/'.$destaque->idautor.'/'.limpar($destaque->nome)) ?>"><?php echo $destaque->nome ?></a>
					</p>
					<p><span class="glyphicon glyphicon-time"></span> <?php echo postadoem($destaque->data) ?></p>
					<hr>
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
					<p><?php echo $destaque->subtitulo ?></p>
					<a class="btn btn-primary" href="<?php echo base_url('postagem/'.$destaque->id.'/'.limpar($destaque->titulo)) ?>">Leia mais <span class="glyphicon glyphicon-chevron-right"></span></a>

					<hr>
				<?php
					}
				?>

            </div>
