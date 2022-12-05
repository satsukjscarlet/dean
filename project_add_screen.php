<?php 
require 'header.php';
?>



   <!-- page content -->
        
        
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="row" 
      style="display: flex;"
       >


      <?php 
      if(isset($_GET['sid'])){
        require 'form\projectform_edit.php';
      }else{
        require 'modun_project/project/project_add_form.php';
      }   
      ?>
      
      
      </div>  
    </div>
    <!-- /page content -->



<?php require 'footer.php';?>
       
