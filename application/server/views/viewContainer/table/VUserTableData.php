<?php 
while ($row = $result->fetch_assoc()) {
                        $i++;
                        ?>

                    <tr id="tr<?php echo $i;?>">
                            <td>
                                <a href="#" title="View Profile" target="_blank" data-toggle="modal" data-target="#Employee<?php echo $i; ?>"><?php echo $row["id"]; ?></a>
                                <div id="Employee<?php echo $i; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">User <?php echo $row["name"] ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <table class="table"> 
                                                                <tr>
                                                                    <th>User ID</th>
                                                                    <th>:</th>
                                                                    <td><?php echo $row["userid"]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Password</th>
                                                                    <th>:</th>
                                                                    <td><?php echo $row["password"]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Full Name</th>
                                                                    <th>:</th>
                                                                    <td><?php echo $row["name"]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Mobile No.</th>
                                                                    <th>:</th>
                                                                    <td><?php echo $row["mobileno"]; ?></td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <th>IP</th>
                                                                    <th>:</th>
                                                                    <td><?php echo $row["ip"]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Active</th>
                                                                    <th>:</th>
                                                                    <td><?php echo $row["is_active"]; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Create ON</th>
                                                                    <th>:</th>
                                                                    <td><?php echo $row["create_on"]; ?></td>
                                                                </tr>
                                                                
                                                            </table>
                                                            <strong>
                                                                0= Active| 1=Suspended
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            
                            <td><?php echo $row["userid"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["mobileno"]; ?></td>
                            <td><?php echo $row["balance"]; ?></td>
                          
                            <td>
                                <style>
                                    #t<?php echo $i;?>{
                                        display:none;
                                        width:100%;
                                    }
                                    #tr<?php echo $i;?>:hover #t<?php echo $i;?>{
                                        display:block;
                                    }
                                </style>
                                <div id="t<?php echo $i; ?>">
                                    
                                    <a href="#" data-toggle="modal" data-target="#Employee<?php echo $i; ?>" class="btn btn-primary btn-xs" title="View Saving Account Profile"><i class="fa fa-user"></i> View</a> | 
                                        <a href="#" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VGetBackUserBalance")."&uid=".$row["userid"]."&tk=0";?>','#main');" class="btn btn-danger btn-xs" title="get Back Balance"><i class="fa fa-rupee-sign"></i> Remove Balance</a> |
                                        <a href="#"  onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VAddUserBalance")."&uid=".$row["userid"]."&tk=0";?>','#main');" class="btn btn-primary btn-xs" title="Send Balance"><i class="fa fa-rupee"></i> Send Balance</a>|
                                        <a href="#"  onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VReport")."&uid=".$row["userid"]."&tk=0";?>','#main');" class="btn btn-primary btn-xs" title="User Report"><i class="fa fa-repeat"></i> Report</a>|
                                        <a href="#"  onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VEdit")."&uid=".$row["userid"]."&tk=0";?>','#main');" class="btn btn-primary btn-xs" title="Edit User"><i class="fa fa-edit"></i> Edit</a>

                                </div>
                            
                            </td>
                            <td>
                              <?php
                              if($row["is_active"]==0)
                              {
                                  echo "<span style='color:green;'>Active</span>";
                              }else{
                                  echo "<span style='color:red;'>Deactive</span>";
                              }
                              ?>
                            </td>
                            <td><a href="https://ipinfo.io/<?php echo $row["ip"];?>" target="_blank"><?php echo $row["ip"];?></a></td>
                            </tr>

                        <?php
                    }
                    
                    ?>