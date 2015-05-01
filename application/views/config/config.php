<?$this->load->view('config/header');?>
            <?=form_open('config/config');?>
            	<h3>Configuración del sistema </h3>
            	<input name="name" class="form-control" type="text" placeholder="nombre del sistema" value="<?=$system->name?>">
                <input name="admin" class="form-control" type="text" placeholder="descripcion" value="<?=$system->administrator?>">
                <input name="title" class="form-control" type="text" placeholder="titulo" value="<?=$system->title?>">
                <input name="tags" class="form-control" type="text" placeholder="tags" value="<?=$system->tags?>">
                <textarea name="description" class="form-control" type="text" placeholder="tags"><?=$system->description?></textarea>
                <h3>Configuración de la base de dato</h3>
                <input name="host" class="form-control" type="text" placeholder="host" value="<?=$database->host?>">
                <input name="user" class="form-control" type="text" placeholder="usuario" value="<?=$database->user?>">
                <input name="password" class="form-control" type="password" placeholder="contraseña" value="<?=$database->password?>">
                <input name="database" class="form-control" type="text" placeholder="base de datos" value="<?=$database	->database?>">

                <input class="btn btn-success" type="submit" value="Guardar">
            </form>
<?$this->load->view('footer');?>