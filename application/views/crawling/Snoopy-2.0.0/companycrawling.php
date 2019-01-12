		<!-- 기업정보 -->
		<?php
		include 'Snoopy.class.php'; 
		$snoopy=new snoopy; 
		$snoopy->fetch("https://www.jobplanet.co.kr/companies?industry_id=809&sort_by=review_avg_cache");

		// $snoopy->fetch("http://www.naver.com");
		$input_lines = $snoopy->results;

		// 기업명 
		preg_match_all("/<a href=\"\/companies\/[0-9]{5}\/info.+>(.*)<\/a>/", $input_lines, $company_name);
		
		//기업위치
		preg_match_all("/<span .+ class=\"us_stxt_1\">(.*)<\/span>/", $input_lines, $location);

		//평균연봉
		preg_match_all("/평균 <strong class='notranslate'>(.*)<\/strong>/", $input_lines, $avg_salary);
		// print_r($company_name);
		// print_r($location);
		// print_r($avg_salary);
/*
		foreach ($company_name[0] as $value) {
			echo "$value / ";
		}
		?><br><?php
		foreach ($location[0] as $value) {
			echo "$value / ";
		}
		?><br><?php
		foreach ($avg_salary[1] as $value) {
			echo "$value / ";
		}*/
		?>
<div class="page-title">
  <div class="title_left">
    <h3>기업 정보</h3>
  </div>
</div>

<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>기업 정보</h2>
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

		<div class="row">
			<div class="col-md-12">
				<div class="">
					<div class="x_content recruit">
						<div class="row">
<?php for($i=0 ; $i < 10 ; $i++) { ?>
							<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-building-o"></i>
									</div>
									<div class="count"><?=$location[0][$i]?></div>

									<h3><?=$company_name[0][$i]?></h3>
									<p>평균 <?=$avg_salary[1][$i]?>만 원</p>
								</div>
							</div>
<?php } ?>							
						</div>
					</div>
				</div>
			</div>
		</div>
						
      </div>
    </div>
  </div>
</div>
		<script>
			$(document).ready(function() {
				$.each($('.recruit a'), function(index, value) {
					$(value).attr('href', 'https://www.jobplanet.co.kr' + $(value).attr('href'));
					$(value).attr('target', '_blank');
				});
			});
		</script>