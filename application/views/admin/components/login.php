
            <div class="page-title">
              <div class="title_left">
                <h3>관리자 로그인</h3>
              </div>

            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>로그인 <small>아이디와 비밀번호를 입력하세요.</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="<?=site_url()?>index.php/admin/login/loginCheck" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">아이디
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="userid" id="userid" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">비밀번호</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="password" id="password" class="date-picker form-control col-md-7 col-xs-12" required="required" type="password">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="submit" class="btn btn-success">로그인</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>