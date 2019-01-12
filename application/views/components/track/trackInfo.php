
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
                    <h2><?=$track->T_name?> <small><?=$track->name?></small></h2>
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
                            <th class="column-title" style="text-align: center;">1-1 </th>
                            <th class="column-title" style="text-align: center;">1-2 </th>
                            <th class="column-title" style="text-align: center;">2-1 </th>
                            <th class="column-title" style="text-align: center;">2-2 </th>
                            <th class="column-title" style="text-align: center;">3-1 </th>
                            <th class="column-title" style="text-align: center;">3-2 </th>
                            <th class="column-title" style="text-align: center;">4-1 </th>
                            <th class="column-title" style="text-align: center;">4-2 </th>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="pointer">
                            <td class=" " style="text-align: center;">
<?php foreach($lectures[1] as $row):?>
                              <button type="button" class="btn btn-default lectureElem le-<?=$row->lecuture_id?>" data-lecture-id="<?=$row->lecuture_id?>" data-toggle="tooltip" data-placement="top" title="강의번호: <?=$row->lecuture_id?> / 학점: <?=$row->L_score?>"><?=$row->L_name?></button>
<?php endforeach; ?>
                            </td>
                            <td class=" " style="text-align: center;">
<?php foreach($lectures[2] as $row):?>
                              <button type="button" class="btn btn-default lectureElem le-<?=$row->lecuture_id?>" data-lecture-id="<?=$row->lecuture_id?>" data-toggle="tooltip" data-placement="top" title="강의번호: <?=$row->lecuture_id?> / 학점: <?=$row->L_score?>"><?=$row->L_name?></button>
<?php endforeach; ?>
                            </td>
                            <td class=" " style="text-align: center;">
<?php foreach($lectures[3] as $row):?>
                              <button type="button" class="btn btn-default lectureElem le-<?=$row->lecuture_id?>" data-lecture-id="<?=$row->lecuture_id?>" data-toggle="tooltip" data-placement="top" title="강의번호: <?=$row->lecuture_id?> / 학점: <?=$row->L_score?>"><?=$row->L_name?></button>
<?php endforeach; ?>
                            </td>
                            <td class=" " style="text-align: center;">
<?php foreach($lectures[4] as $row):?>
                              <button type="button" class="btn btn-default lectureElem le-<?=$row->lecuture_id?>" data-lecture-id="<?=$row->lecuture_id?>" data-toggle="tooltip" data-placement="top" title="강의번호: <?=$row->lecuture_id?> / 학점: <?=$row->L_score?>"><?=$row->L_name?></button>
<?php endforeach; ?>
                            </td>
                            <td class=" " style="text-align: center;">
<?php foreach($lectures[5] as $row):?>
                              <button type="button" class="btn btn-default lectureElem le-<?=$row->lecuture_id?>" data-lecture-id="<?=$row->lecuture_id?>" data-toggle="tooltip" data-placement="top" title="강의번호: <?=$row->lecuture_id?> / 학점: <?=$row->L_score?>"><?=$row->L_name?></button>
<?php endforeach; ?>
                            </td>
                            <td class=" " style="text-align: center;">
<?php foreach($lectures[6] as $row):?>
                              <button type="button" class="btn btn-default lectureElem le-<?=$row->lecuture_id?>" data-lecture-id="<?=$row->lecuture_id?>" data-toggle="tooltip" data-placement="top" title="강의번호: <?=$row->lecuture_id?> / 학점: <?=$row->L_score?>"><?=$row->L_name?></button>
<?php endforeach; ?>
                            </td>
                            <td class=" " style="text-align: center;">
<?php foreach($lectures[7] as $row):?>
                              <button type="button" class="btn btn-default lectureElem le-<?=$row->lecuture_id?>" data-lecture-id="<?=$row->lecuture_id?>" data-toggle="tooltip" data-placement="top" title="강의번호: <?=$row->lecuture_id?> / 학점: <?=$row->L_score?>"><?=$row->L_name?></button>
<?php endforeach; ?>
                            </td>
                            <td class="last " style="text-align: center;">
<?php foreach($lectures[8] as $row):?>
                              <button type="button" class="btn btn-default lectureElem le-<?=$row->lecuture_id?>" data-lecture-id="<?=$row->lecuture_id?>" data-toggle="tooltip" data-placement="top" title="강의번호: <?=$row->lecuture_id?> / 학점: <?=$row->L_score?>"><?=$row->L_name?></button>
<?php endforeach; ?>
                            </td>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
							
						
                  </div>
                </div>
              </div>
            </div>

            <script>
              $(document).ready(function() {
                var data = {
                  'student_id': <?=$session['id']?>,
                  'lecuture_id': $(this).data('lecture-id')
                }
                var url = "http://darkgogi.com/ht/index.php/ajax/isDone/";
                $.ajax({
                  type: "POST",
                  dataType: "json",
                  data: data,
                  url: url,
                  success: function(result) {
                    $.each(result, function(index, value) {
                      $('button.le-' + value.lecuture_id).addClass('btn-primary');
                    });
                  },
                  error: function(error) {
                    console.log(error);
                  }
                });

                $('button.lectureElem').on('click', function(e) {

                  e.preventDefault();

                  var data = {
                    'student_id': <?=$session['id']?>,
                    'lecuture_id': $(this).data('lecture-id')
                  }
                  if($(this).hasClass('btn-primary')) {
                    var url = "http://darkgogi.com/ht/index.php/ajax/undone/";
                    $(this).removeClass('btn-primary');
                  } else {
                    var url = "http://darkgogi.com/ht/index.php/ajax/done/";
                    $(this).addClass('btn-primary');
                  }

                  $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: data,
                    url: url,
                    success: function(result) {
                      console.log(result);
                    },
                    error: function(error) {
                      console.log(error);
                    }
                  });

                });
              });
            </script>