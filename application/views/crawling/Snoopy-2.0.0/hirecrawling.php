		<!-- 채용정보 -->
		<?php
		include 'Snoopy.class.php'; 
		$snoopy=new snoopy; 
		$snoopy->fetch("http://www.saramin.co.kr/zf_user/jobs/list/job-category?page=1&cat_key=120311&search_optional_item=n&isAjaxRequest=0&page_count=50&sort=MD&type=job-category#searchTitle");

		// $snoopy->fetch("http://www.naver.com");
		$txt = $snoopy->results;

		// 기업명 
		$rex="/\<a class=\"str_tit\" onclick.+\">(.*)<span>(.*)\<\/span\>\<\/a\>/";
		preg_match_all($rex,$txt,$company,PREG_SET_ORDER);
		
		// 제목
		$rex2="/<a class=\"str_tit\" id=.+\">(.*)<span>(.*)<\/span><\/a>/";
		preg_match_all($rex2,$txt,$title,PREG_SET_ORDER);

		//link
		$rex3="/href=\"\/zf(.*)\" onmousedown=\"\">/";		
		preg_match_all($rex3,$txt,$link,PREG_SET_ORDER);
		//근무조건
		$rex4="/<p class=\"employment_type\">(.*)<\/p>/";
		preg_match_all($rex4,$txt,$ep_ty,PREG_SET_ORDER);

		//근무지
		$rex5="/<p class=\"work_place\">(.*)<\/p>/";
		preg_match_all($rex5,$txt,$wo_pl,PREG_SET_ORDER);

		//마감일
		$rex6="/<p class=\"deadlines\">(.*)<span class=\"reg_date\">/";		
		preg_match_all($rex6,$txt,$deadline,PREG_SET_ORDER);

		// print_r($company[2][1]);
		// var_dump($company); // 첫20개에서 홀짝끼리 중복
		// var_dump($title); //첫20개에서 홀짝끼리 중복
		// var_dump($link);
		//var_dump($ep_ty);
		//var_dump($wo_pl);
		// var_dump($deadline);
		// print_r($txt);

		$foo = array();
		
		foreach ($company as $key=>$value) {//기업명
			// echo $value[0];
			$foo[$key]['company'] = $value[0];
			?><?php
		}
		foreach ($title as $key=>$value) {//채용공고제목
			// echo $value[0];
			$foo[$key]['title'] = $value[0];
			?><?php
		}
		foreach ($link as $key=>$value) {//링크
			$result=preg_replace("/_user/", "/zf_user", $value[1]);
			// echo $result;
			$foo[$key]['link'] = $result;
			?><?php
		}
		foreach ($ep_ty as $key=>$value) {//근무조건
			// echo $value[0];
			$foo[$key]['ep_ty'] = $value[0];
			?><?php
		}
		foreach ($wo_pl as $key=>$value) {//근무지
			// echo $value[0];
			$foo[$key]['wo_pl'] = $value[0];
			?><?php
		}
		foreach ($deadline as $key=>$value) {//마감일
			// echo $value[0];
			$foo[$key]['deadline'] = $value[0];
			?><?php
		}
		?>



            <div class="page-title">
              <div class="title_left">
                <h3>채용 정보</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>채용 정보</h2>
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
                            <th class="column-title" style="text-align: center;">기업명 </th>
                            <th class="column-title" style="text-align: center;">채용공고명 </th>
                            <th class="column-title" style="text-align: center;">근무조건 </th>
                            <th class="column-title" style="text-align: center;">근무지 </th>
                            <th class="column-title" style="text-align: center;">마감일 </th>
                            <th class="column-title no-link last" style="text-align: center;"><span class="nobr">바로가기 </span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>






                        <tbody>
<?php $egg = 0; ?>
<?php foreach($foo as $row) {
if($egg == 40) break;
 ?>
                          <tr class="<?=$egg % 2 == 0 ? "even" : "odd"?> pointer recruit">
                            <td class=" "><?=$row['company']?></td>
                            <td class=" "><?=$row['title']?></td>
                            <td class=" "><?=$row['ep_ty']?></td>
                            <td class=" "><?=$row['wo_pl']?></td>
                            <td class=" "><?=$row['deadline']?></td>
                            <td class=" last" style="text-align: center;"><a class="btn btn-default" href="<?=$row['link']?>">바로가기</a>
                            </td>
                          </tr>
<?php $egg++; ?>
<?php } ?>
                        </tbody>
                      </table>
                    </div>
							
						
                  </div>
                </div>
              </div>
            </div>
			<script>
				$(document).ready(function() {
					$.each($('.recruit a'), function(index, value) {
						$(value).attr('href', 'http://www.saramin.co.kr' + $(value).attr('href'));
						$(value).attr('target', '_blank');
					});
				});
			</script>