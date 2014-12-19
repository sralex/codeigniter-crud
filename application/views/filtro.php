<div class="row clearfix">
    <div class="col-md-3" id="w_">
              <select class="form-control where" name="where" id="where">
                <option value=""></option>
                <?foreach($elementos as $e):?>
                <option value="<?=$e?>"><?=$e?></option>
                <?endforeach;?>
              </select>
    </div>
    <div class="col-md-2" >
              <select class="form-control operator" name="operator" id="operator">
                  <option value=""></option>
                  <option value="1">=</option>
                  <option value="2">&lt;</option>
                  <option value="3">&gt;</option>
                  <option value="4">&lt;=</option>
                  <option value="5">&lt;=</option>
                  <option value="6">LIKE</option>
                  <option value="7">!=</option>
              </select>
    </div>
    <div class="col-md-3" >
              <input required="" class="form-control " type="text" name="" value="" id="fecha">
    </div>
    <div class="col-md-3" >
              <a href="#" id="filtrar" class="btn btn-success">Filtrar</a>
    </div>
</div>