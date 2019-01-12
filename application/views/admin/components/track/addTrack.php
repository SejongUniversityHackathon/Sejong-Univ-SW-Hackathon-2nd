
            <div class="page-title">
              <div class="title_left">
                <h3>트랙 관리</h3>
              </div>
            </div>
            <div class="clearfix"></div>

<form action="<?=site_url()?>index.php/admin/track/addTrack" method="POST" id="track" data-parsley-validate class="form-horizontal form-label-left">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>트랙 설정 <small>트랙 정보를 입력하세요.</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">트랙명
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="trackName" id="trackName" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">단과대학
                        </label>
                        <div class="col-md-6 col-sm-6col-xs-12">
                          <select class="form-control" name="college">
                            <option value="">선택</option>
<?php foreach($colleges as $row): ?>
                            <option value="<?=$row->id?>"><?=$row->name?></option>
<?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">대상학과
                        </label>
                        <div class="col-md-6 col-sm-6col-xs-12">
                          <select class="form-control" name="major">
                            <option value="">선택</option>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>과목 추가 <small>트랙 과목을 추가하세요.</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                      <div class="majorList">
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="submit" class="btn btn-success">트랙 추가</button>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
</form>


            <script>
              $(document).on('ready', function() {

                $('select[name="college"]').on('change', function(e) {
                  e.preventDefault();
                  var collegeId = ($(this).find('option:selected').val());
                  var data = {
                    id: collegeId
                  };
                  $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: data,
                    url: 'http://darkgogi.com/ht/index.php/ajax/getCollegeMajors/',
                    success: function(result) {
                      var result = (JSON.parse(result));
                      var $target = $('select[name="major"]');
                      $target.html('<option value="">선택</option>');

                      $.each(result, function(index, value) {
                        $target.append('<option value="' + value.id + '">' + value.major_name + '</option>');
                      });
                    },
                    error: function(error) {
                      console.log(error);
                    }
                  });
                })

                $('select[name="major"]').on('change', function(e) {
                  e.preventDefault();
                  var collegeId = ($(this).find('option:selected').val());
                  var data = {
                    id: collegeId
                  };
                  var $majorList = $('.majorList');
                  $majorList.html('');
                  $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: data,
                    url: 'http://darkgogi.com/ht/index.php/ajax/getMajorLectures/',
                    success: function(result) {
                      var result = (JSON.parse(result));
                      console.log(result);
                      var divideCount = 0;
                      $.each(result, function(index, value) {

                        var elem = ''
                                 +'<div class="form-group">'
                                 +'<label class="control-label col-md-3 col-sm-3 col-xs-12">' + value.L_name + '</label>'
                                 +'<div class="col-md-9 col-sm-9 col-xs-12">'
                                 +  '<div id="gender" class="btn-group majorListPanel" data-toggle="buttons">'
                                 + '<label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="0">' + '없음' 
                                 + '</label>'
                                 + '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="1">' + '1-1' 
                                 + '</label>'
                                 + '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="2">' + '1-2' 
                                 + '</label>'
                                 + '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="3">' + '2-1' 
                                 + '</label>'
                                 + '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="4">' + '2-2' 
                                 + '</label>'
                                 + '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="5">' + '3-1' 
                                 + '</label>'
                                 + '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="6">' + '3-2' 
                                 + '</label>'
                                 + '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="7">' + '4-1' 
                                 + '</label>'
                                 + '<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">'
                                 +   '<input type="radio" name="' + 'L-' + value.lecuture_id + '" value="8">' + '4-2' 
                                 + '</label>'
                                 + '</div>'
                                 + '</div>'
                                 + '</div>';
                        $majorList.append(elem);
                        divideCount++;
                        if(divideCount % 5 == 0) $majorList.append('<br>'); 
                      });
                    },
                    error: function(error) {
                      console.log(error);
                    }
                  });
                })
                
              });
            </script>