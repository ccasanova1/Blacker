<div class="content-wrapper">
    <section class="content-header">
        <h1>inicio</h1>
    </section>
    <section class="content">
        <div class="box box-solid">
            <div class="box-body">
                <div class="row justify-content-md-center">
                    <div class="col-lg-6">
                        <?php if($this->session->flashdata("error")):?>
                        <div class="alert alert-danger">
                            <p><?php echo $this->session->flashdata("error") ?></p>
                        </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url('publicacion/publicar'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Comentario</label>
                                <textarea class="form-control" placeholder="Una descripcion de la paguina" name="comentario" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <button type="submit" class="btn btn-primary">Publicar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
