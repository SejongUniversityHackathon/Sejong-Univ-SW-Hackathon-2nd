
            <div class="page-title">
              <div class="title_left">
                <h3>트랙 관리</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                          <select class="form-control">
                            <option value="">선택</option>
                            <option value="1">인문과학대학</option>
                            <option value="2">사회과학대학</option>
                            <option value="3">경영대학</option>
                            <option value="4">호텔관광대학</option>
                            <option value="5">자연과학대학</option>
                            <option value="6">생명과학대학</option>
                            <option value="7">전자정보공학대학</option>
                            <option value="8">소프트웨어융합대학</option>
                            <option value="9">공과대학</option>
                            <option value="10">예체능대학</option>
                            <option value="11">대양휴머니티칼리지</option>
                            <option value="12">법학부</option>
                          </select>
                  </div>
                </div>
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
                            <th class="column-title no-link last"><span class="nobr">관심트랙</span>
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
                            <td class=" "><a href="<?=site_url()?>index.php/track/track/viewTrack/<?=$row->id?>"><?=$row->T_name?></a></td>
                            <td class=" "><?=$row->name?></td>
                            <td class=" "><?=$row->totalGrade?></td>
                            <td class=" ">0</td>
                            <td class=" "><?=$row->created?></td>
                            <td class=" last" style="text-align: center;"><a href="#" class="likeToggle <?=$row->isLiked ? 'active' : ''?>" data-target-id="<?=$row->id?>"><i class="fa fa-star"></i></a>
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
            <script>
              $(document).ready(function() {
                $('a.likeToggle').on('click', function(e) {
                  e.preventDefault();

                  var data = {
                    'student_id': <?=$session['id']?>,
                    'type': 1,
                    'target_id': $(this).data('target-id')
                  };
                  if($(this).hasClass('active')) {
                    var url = 'http://darkgogi.com/ht/index.php/ajax/unlike'; 
                    $(this).removeClass('active');
                  } else {
                    var url = 'http://darkgogi.com/ht/index.php/ajax/like'; 
                    $(this).addClass('active');
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
                  })
                });
              });
            </script>