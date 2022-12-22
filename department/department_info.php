<script src="js/jquery-3.6.0.min.js"></script>
<style>

</style>
<!-- <div class="container"> -->
<h1 class="justify-content-center">PHÒNG BAN</h1>
<div class="row">
  <div class="col-12">
    <nav>
      <div class="nav nav-tabs nav-fill justify-content-end" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
          aria-controls="nav-home" aria-selected="true">Thông tin</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
          aria-controls="nav-profile" aria-selected="false">Người dùng</a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
          aria-controls="nav-contact" aria-selected="false">Danh Sách Đề Án</a>
      </div>
    </nav>

    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <?php include('department_add_form.php'); ?>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          trang 2
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
          trang 3
        </div>
        <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
          trang4
        </div>
      </div>
    </div>
  </div>
  <!-- </div> -->