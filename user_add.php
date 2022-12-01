<?php require 'header.php';?>



   <!-- page content -->
        
        
    <div class="right_col" role="main">
      <!-- top tiles -->
      <div class="row" 
      style="display: flex;"
       >

       <?php 
      if(isset($_GET['sid'])){
        require 'form\usersform_edit.php';
      }else{
        require 'form\usersform.php';
      }   
      ?>
      
      
      </div>  
    </div>
    <!-- /page content -->



<?php require 'footer.php';?>
       
