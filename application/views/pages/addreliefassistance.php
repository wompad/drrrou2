<div class="row">
	<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
		<div class="panel-group">
    		<div class="panel panel-default" style="border-radius:0px">
      			<div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-plus-circle"></i> Add Augmentation Assistance</div>
      			<div class="panel-body">
              <form>
                <div class="form-group col-md-12">
                  <select class="form-control" id="province"></select>
                </div>
                <div class="form-group col-md-12">
                  <select class="form-control" id="city">
                    <option value="">-- Select City/Municipality --</option>
                  </select>
                </div>
                <div class="form-group col-md-12">
                  <input type="number" class="form-control" placeholder="Number served..." id="augnumberserved">
                </div>
                <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                  <label> Augmentation Date </label>
                    <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Augmentation Date" aria-describedby="inputSuccess2Status3">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                </div>
                <div class="form-group col-md-12">
                  <select class="form-control" id="assistancetype">
                    <option value="">-- Assistance Type --</option>
                    <option value="1">Augmentation Assistance</option>
                    <option value="2">Food for Work</option>
                    <option value="3">Cash for Work (Totally)</option>
                    <option value="4">Cash for Work (Partially)</option>
                    <option value="5">ESA (Totally)</option>
                    <option value="6">ESA (Partially)</option>
                    <option value="7">Modified Core Shelter Assistance</option>
                    <option value="8">Burial Assistance</option>
                    <option value="9">Medical Assistance</option>
                    <option value="10">Food Subsidy</option>
                    <option value="11">Balik Probinsya</option>
                    <option value="12">Educational Assistance</option>
                  </select>
                </div>
                <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th colspan="4"><center>----- Select Assistance to be Provided -----</center></th> 
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="width:300px">
                          <select class="form-control" id="chooseasst">
                            <option value="">--- Select Assistance ---</option>
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control" placeholder="Cost" min="0" id="acost">
                        </td>
                        <td>
                          <input type="number" class="form-control" placeholder="Quantity" min="0" id="quantity">
                        </td>
                        <td style="vertical-align:middle">
                          <button type="button" class="btn btn-primary btn-xs" id="addasst"><i class="fa fa-plus-circle"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table" style="margin-top:-25px" id="tbl_asstlist">
                    <thead>
                      <tr>
                        <th colspan="5"><center>----- List of Assistance to be Provided -----</center></th> 
                      </tr>
                      <tr>
                        <th style="width:25%"> Item </th> 
                        <th style="width:23%; text-align:right"> Cost </th> 
                        <th style="width:23%; text-align:right"> Quantity </th> 
                        <th style="width:23%; text-align:right"> Sub-Total </th> 
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5"> <center> ------NOTHING FOLLOWS------ </center> </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="form-group col-md-12">
                  <textarea class="form-control" rows="3" placeholder="Remarks/Particulars/Augmentation Details..." id="remarks_particulars"></textarea>
                </div>
                <div class="form-group col-md-12">
                  <select class="form-control" id="disasterevent">
                    <option value="">--- Select Disaster Event ---</option>
                    <option value="PARS"> Preparation for Upcoming Rainy Season </option>
                    <option value="PREP"> Prepositioning of Welfare Goods </option>
                  </select>
                </div>
                <div class="col-md-12">
                  <!-- <button type="reset" class="btn btn-warning pull-right btn-sm" id="saveasst_specreset"> <i class="fa fa-refresh"></i> Reset</button>
                  <button type="button" class="btn btn-danger pull-right btn-sm"> <i class="fa fa-times-circle"></i> Remove</button>
                  <button type="button" class="btn btn-primary pull-right btn-sm"> <i class="fa fa-edit"></i> Edit</button> -->
                  <button type="button" class="btn btn-success pull-right btn-sm" id="saveasst_spec"> <i class="fa fa-plus-circle"></i> Save Data</button>
                </div>
              </form>
      			</div>
    		</div>
  		</div>
	</div>
  <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
    <div class="panel-group">
        <div class="panel panel-default" style="border-radius:0px">
            <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-th"></i> List of LGUs Provided with Resource Augmentation</div>
            <div class="panel-body">
              <div class="col-md-4 pull-right">
                  <div class="form-group">
                    <select class="form-control" id="assttyperelief">
                      <option value="">-- Select Assistance Type --</option> 
                      <option value="aug">Augmentation Assistance </option> 
                      <option value="aug_ffw">Food for Work</option> 
                      <option value="cfwtot">Cash for Work (Totally)</option> 
                      <option value="cfwpart">Cash for Work (Partially)</option> 
                      <option value="esatot">ESA (Totally)</option> 
                      <option value="esapart">ESA (Partially)</option>
                      <option value="prep">Preposition Goods</option> 
                    </select>
                  </div>
              </div>
              <div class="col-md-4 pull-right">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search Month. Format (MM-YYYY)" id="searchmonthrelief">
                  </div>
              </div>
              <table class="table table-responsive table-stripe table-bordered" id="tbl_augmentation_list">
                <thead>
                  <tr>
                    <th> Province/City/Municipality</th>
                    <th style="text-align:center"> Number Served (Family) </th>
                    <th style="text-align:right"> Amount (₱) </th>
                    <th style="text-align:center"> Assistance Name </th>
                    <th style="text-align:center"> Assistance Type </th>
                    <th style="text-align:center"> Augmentation Date </th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
        </div>
      </div>
  </div>
</div>