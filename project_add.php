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
        require 'form\projectform.php';
      }   
      ?>
      
      
      </div>  
    </div>
    <!-- /page content -->



<?php require 'footer.php';?>
       
