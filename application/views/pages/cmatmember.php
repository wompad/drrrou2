<div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="panel-group">
            <div class="panel panel-default" style="border-radius:0px">
                        <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-plus-circle"></i> Add New Contact > <b>CMAT Members</b></div>
                        <div class="panel-body">
                              <div class="form-group">
                                    <input type="text" class="form-control input-sm" placeholder="Fullname" id="fullname">
                              </div>
                              <div class="form-group">
                                    <input type="text" class="form-control input-sm" placeholder="Position" id="position">
                              </div>
                              <div class="form-group">
                                    <input type="text" class="form-control input-sm" placeholder="Program" id="program">
                              </div>
                              <div class="form-group">
                                    <select class="form-control input-sm" id="gender">
                                          <option value="">-- Select Gender -- </option>
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                    </select>
                              </div>
                              <div class="form-group">
                                    <select class="form-control input-sm" id="province">
                                    </select>
                              </div>
                              <div class="form-group">
                                    <select class="form-control input-sm" id="city">
                                        <option value=''>-- Select City/Municipality --</option>
                                    </select>
                              </div>
                              <div class="form-group">
                                    <input type="text" class="form-control input-sm" placeholder="Mobile Number" id="mobile">
                              </div>
                      <div class="form-group">
                          <input type="text" class="form-control input-sm" placeholder="Email Address" id="emailadd">
                      </div>
                      <div class="form-group pull-right">
                          <button type="button" class="btn btn-success btn-sm" id="savedata_matmember"> <i class="fa fa-plus-circle"></i></button>
                          <button type="button" class="btn btn-info btn-sm" disabled id="updatedata_matmember"> <i class="fa fa-edit "></i></button>
                          <button type="button" class="btn btn-danger btn-sm" disabled id="deletedata_matmember"> <i class="fa fa-times-circle"></i></button>
                          <button type="button" class="btn btn-primary btn-sm" onclick="resetAllMATMEMBER()"><i class="fa fa-refresh"></i></button>
                      </div>
                        </div>
            </div>
            </div>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div class="panel-group">
            <div class="panel panel-default" style="border-radius:0px;">
                        <div class="panel-heading" style="background-color: gray; color:#fff; border-radius:0px"><i class="fa fa-table"></i> Contact List > <b>CMAT Members</b></div>
                        <div class="panel-body">
                              <table class="table table-bordered table-hover table-striped" id="tbl_cmatmember">
                                    <thead>
                                          <tr>
                                                <th style="font-size:10px; text-align:left">Fullname</th>
                                                <th style="font-size:10px; text-align:center">Position</th>
                                                <th style="font-size:10px; text-align:center">Program</th>
                                                <th style="font-size:10px; text-align:center">Gender</th>
                                                <th style="font-size:10px; text-align:center">Province</th>
                                                <th style="font-size:10px; text-align:center">City/Municipality</th>
                                                <th style="font-size:10px; text-align:center">Mobile #</th>
                                                <th style="font-size:10px; text-align:center">Email Address</th>
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