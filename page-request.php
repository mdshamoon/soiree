<?php

get_header();



?>


<div class="container mx-auto mt-3 pb-4" style="width: 30%;background-color: #f1f1f1" id="myform"> 
   <form action="<?php echo get_permalink(get_page_id_by_title('Thank you')); ?>" method="POST" >
      <p class="text-center pt-2 font-weight-bold">Request an invite</p> 
 
 
    <input type="text" name="name" class="form-control" id="name"  placeholder="name" >

  <br> 
   
     <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
 
<br>
  
  
    
    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone number">
  <br> 
  
  
  


 <!--  <div class="form-check form-check-inline">
    <p style="display: inline">Gender :</p>
  <label class="form-check-label ml-2">
    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male"> Male
  </label>


  <label class="form-check-label">
    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"> Female
  </label>
< /div> -->
<br> 
 <div class="text-center"> 
  <div  name="submit" class="btn btn-primary mt-2" id="click" value="submit">Submit</div>
 </div> 
</form>



</div>

<div class="well text-center" id="congrat" style="display: none">
  </div>
<?php
get_footer();
?>