<div class="row">
	<div role="main">
      <!-- top tiles -->
      <div class="row tile_count" data-step="1" data-intro="This part shows all the total of the all the affected families aswell as the amount of assistance given in a year!">
        <?php if($_SESSION["user_level_access"] == "region"){ ?>
          <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count">
            <center><h4><strong>Total for Disaster Events <?php echo date("Y") ?></strong></h4></center>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-map-marker"></i> Total LGUs Affected</span>
            <div class="count red" id="aff_brgy" style="font-size:30px; cursor:pointer">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-user"></i> Total Affected Families</span>
            <div class="count red" id="aff_families" style="font-size:30px; cursor:pointer">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-users"></i> Total Affected Individuals</span>
            <div class="count red" id="aff_individuals" style="font-size:30px; cursor:pointer">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-money"></i> Total DSWD Assistance</span>
            <div class="count green" id="tot_assistance" style="font-size:30px; cursor:pointer">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-user"></i> Total Families Inside ECs</span>
            <div class="count" style="color:#EC971F; font-size:30px; cursor:pointer" id="aff_inec">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-user"></i> Total Families Outside ECs</span>
            <div class="count" style="color:#EC971F; font-size:30px; cursor:pointer" id="aff_outec">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?> </span></center>
          </div>
        <?php }else{ ?>
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-map-marker"></i> Total LGUs Affected</span>
            <div class="count red" id="aff_brgy" style="font-size:30px; cursor:pointer">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-user"></i> Total Affected Families</span>
            <div class="count red" id="aff_families" style="font-size:30px; cursor:pointer">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-users"></i> Total Affected Individuals</span>
            <div class="count red" id="aff_individuals" style="font-size:30px; cursor:pointer">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-user"></i> Total Families Inside ECs</span>
            <div class="count" style="color:#EC971F; font-size:30px; cursor:pointer" id="aff_inec">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?></span></center>
          </div>
          <div class="col-md-2 col-sm-12 col-xs-12 tile_stats_count">
            <center><span class="count_top"><i class="fa fa-user"></i> Total Families Outside ECs</span>
            <div class="count" style="color:#EC971F; font-size:30px; cursor:pointer" id="aff_outec">0</div>
            <span class="count_bottom"> For the Year <?php echo date("Y") ?> </span></center>
          </div>
        <?php } ?>
      </div>
      <!-- /top tiles -->
      <hr class="line" style="border:1px solid #ADB2B5">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="dashboard_graph">
            <?php if($_SESSION["user_level_access"] == "region"){ ?>
              <div class="col-md-5 col-sm-12 col-xs-12" data-step="2" data-intro="This pie graph shows the total number of affected families per disaster event. Clicking the specific disaster event will breakdown the graph to total affected families per municipality!">
                <div class="x_panel tile overflow_hidden" style="height:500px; border: 3px solid #1ABB9C">
                  <div class="x_title">
                    <h4 class="green"><strong>Pie Chart of Total Affected Families (<?php echo date("Y"); ?>) </strong></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="tot_family_graph">
                  </div>
                </div>
              </div>
              <div class="col-md-5 col-sm-12 col-xs-12" data-step="3" data-intro="This graph shows the total amount of assistance per disaster event. Clicking the specific disaster event will breakdown the graph to total amount of assistance per municipality!">
                <div class="x_panel tile" style="height:500px; overflow: auto; border: 3px solid #34B4EB">
                  <div class="x_title blue"><h4><strong>Pie Chart of DSWD Total Assistance (<?php echo date("Y"); ?>) </strong></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="x_content" id="tot_assistance_graph">
                  </div>
                </div>
              </div>
              <div class="col-md-2 col-sm-12 col-xs-12" data-step="10" data-intro="This part shows the list of all the created reports of disaster incidents in a year.">
                <div class="x_panel tile" style="height:500px; overflow: auto; border: 3px solid #EB4C3C">
                  <div class="x_title red"><h6><strong>My Disaster Reports Year (<?php echo date("Y"); ?>)</strong></h6>
                    <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="x-content">
                    <input type="hidden" id="hiddenisadmin" value="<?php echo $_SESSION['isadmin']; ?>">
                    <div class="dashboard-widget-content">
                      <ul class="list-unstyled timeline widget" id="current_situations">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php }else{ ?>
              <div class="col-md-8 col-sm-12 col-xs-12" data-step="2" data-intro="This pie graph shows the total number of affected families per disaster event. Clicking the specific disaster event will breakdown the graph to total affected families per municipality!">
                <div class="x_panel tile overflow_hidden" style="height:500px; border: 3px solid #1ABB9C">
                  <div class="x_title">
                    <h4 class="green"><strong>Pie Chart of Total Affected Families (<?php echo date("Y"); ?>) </strong></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="tot_family_graph">
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12" data-step="10" data-intro="This part shows the list of all the created reports of disaster incidents in a year.">
                <div class="x_panel tile" style="height:500px; overflow: auto; border: 3px solid #EB4C3C">
                  <div class="x_title red"><h6><strong>My Disaster Reports Year (<?php echo date("Y"); ?>)</strong></h6>
                    <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="x-content">
                    <input type="hidden" id="hiddenisadmin" value="<?php echo $_SESSION['isadmin']; ?>">
                    <div class="dashboard-widget-content">
                      <ul class="list-unstyled timeline widget" id="current_situations">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <div class="col-md-12 col-sm-12 col-xs-12" data-step="4" data-intro="This column graph shows the total number of affected families per disaster event. Clicking the specific disaster event will breakdown the graph to total affected families per municipality!">
              <div class="x_panel tile overflow_hidden" style="height:600px; border: 3px solid #1ABB9C">
                <div class="x_title">
                  <h4 class="green"><strong>Column Chart of Total Affected Families (<?php echo date("Y"); ?>) </strong></h4>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" id="tot_family_graph_column" style='height:85%'>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-3 col-sm-12 col-xs-12" data-step="5" data-intro="This part shows the latest weather update issued by PAGASA!">
                <div class="x_panel" style="border: 3px solid #E74C3C; height:653px; overflow:auto">
                  <div class="x-title green"><h4><strong>Public Weather Advisories</strong></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x-content">
                    <a class="twitter-timeline" href="https://twitter.com/dost_pagasa?ref_src=twsrc%5Etfw">Tweets by dost_pagasa</a>
                      <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12" data-step="6" data-intro="This part shows the latest radar image forecast issued by PAGASA!">
                <div class="x_panel" style="height: auto; border: 3px solid #EC971F">
                  <div class="x-title green"><h4><strong>Weather Radar Image </strong></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x-content">
                    <div class="dashboard-widget-content" style="text-align:justify">
                      <object data="https://www1.pagasa.dost.gov.ph/images/radar/mosaic/mosaic_rain_radar.php" style="width:100%; height:530px" id="radarphp"></object>
                    </div>
                    <div class="dashboard-widget-content" style="text-align:justify">
                      <h5>Source: <a href="http://bagong.pagasa.dost.gov.ph/" target="_blank">http://bagong.pagasa.dost.gov.ph/</a></h5>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-12 col-xs-12" data-step="7" data-intro="This part shows the Philippine Standard Time and the later weather forecast of PAGASA!">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel" style="height: auto; border: 3px solid #199919; padding:0px">
                    <div>
                      <div>
                        <div class="x_panel" style="padding:0px">
                          <div class="x-content">
                            <div class="dashboard-widget-content" style="text-align:justify;">
                              <object data="https://oras.pagasa.dost.gov.ph/widget.shtml" class="form-control" style="height:150px; border:0px"></object>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div>
                      <div>
                        <div class="x_panel" style="padding:0px">
                          <div class="x-content" style="padding:0px">
                            <div class="dashboard-widget-content" style="text-align:justify; overflow-y:hidden;">
                              <iframe src="https://feed.mikle.com/widget/v2/27254/" class="form-control" style="height:449px; border:0px;"></iframe>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-3 col-sm-12 col-xs-12" data-step="8" data-intro="This part shows the latest advisories issued by PHIVOLCS" data-position='left'>
                <div class="x_panel" style="border: 3px solid #E74C3C; overflow:auto; height: 1123px">
                  <div class="x-title red"><h4><strong>PHIVOLCS Advisories</strong></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x-content">
                    <a class="twitter-timeline" href="https://twitter.com/phivolcs_dost?ref_src=twsrc%5Etfw">Tweets by phivolcs_dost</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                  </div>
                </div>
              </div>

              <div class="col-md-9 col-sm-12 col-xs-12" data-step="9" data-intro="This part shows the Hazard Visualization for weather monitoring!" data-position='left'>
                <div class="x_panel" style="border: 3px solid #E74C3C; overflow:auto">
                  <div class="x-title red"><h4><strong>Hazard Visualization</strong></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x-content">
                    <div class="dashboard-widget-content" style="text-align:justify">
                      <iframe height="1000px" src="https://embed.windy.com/embed2.html?lat=10.790&lon=121.069&zoom=5&level=surface&overlay=rain&menu=&message=true&marker=&calendar=&pressure=true&type=map&location=coordinates&detail=&detailLat=14.649&detailLon=121.051&metricWind=default&metricTemp=default" frameborder="0" style="width:100%"></iframe>
                    </div>
                    <div class="dashboard-widget-content" style="text-align:justify">
                      <h5>Source: <a href="https://www.windy.com/?rain,14.649,121.051,5,i:pressure" target="_blank">https://www.windy.com/</a></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
          </div>
        </div>
      </div>
  </div>
</div>