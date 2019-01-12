
            <div class="page-title">
              <div class="title_left">
                <h3>트랙 관리</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>트랙 설정</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">트랙 번호 </th>
                            <th class="column-title">트랙명 </th>
                            <th class="column-title">소속그룹 </th>
                            <th class="column-title">학점 </th>
                            <th class="column-title">이수 학생 수 </th>
                            <th class="column-title">생성일 </th>
                            <th class="column-title no-link last"><span class="nobr">비고</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
<?php $egg = 0; ?>
<?php foreach($tracks as $row): ?>
                          <tr class="<?=$egg % 2 == 0 ? "even" : "odd"?> pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" "><?=$row->id?></td>
                            <td class=" "><a href="<?=site_url()?>index.php/admin/track/viewTrack/<?=$row->id?>"><?=$row->T_name?></a></td>
                            <td class=" "><?=$row->name?></td>
                            <td class=" "><?=$row->totalGrade?></td>
                            <td class=" ">0</td>
                            <td class=" "><?=$row->created?></td>
                            <td class=" last"><a href="<?=site_url() . 'index.php/admin/track/removeTrack/' . $row->id?>">삭제</a>
                            </td>
                          </tr>
<?php $egg++; ?>
<?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
							
						
                  </div>
                </div>
              </div>
            </div>