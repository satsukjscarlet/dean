<?php require 'header.php';?>



   <!-- page content -->
        
        
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="row" 
      style="display: flex;"
       >

       <?php 
      if(isset($_GET['sid'])){
        require 'user\user_edit_form.php';
      }else{
        require 'user\user_add_form.php';
      }   
      ?>
      
      
      </div>  
    </div>
    <!-- /page content -->



<?php require 'footer.php';?>
       
