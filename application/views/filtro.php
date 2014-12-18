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
              <div class="input-group input" id="datetimepicker0" data-date-format="YYYY-MM-DD hh:mm:ss">
                  <input required="" class="form-control fecha" type="text" name="fecha" value="" id="fecha">
                  <span class="input-group-addon">
                  <span class="glyphicon-calendar glyphicon"></span>
                  </span>
              </div>
    </div>
    <div class="col-md-3" >
              <a href="#" id="filtrar" class="btn btn-success">Filtrar</a>
    </div>
</div>