<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./review.css">


   <title>Snap Up</title>
</head>



<body>
   <?php include('nav.php'); ?>


   <div> &nbsp; &nbsp; &nbsp;</div>
      <div class="review">

          <p>Rate and review purchased product</p>
          <div class="row">
         <div class="col-2">
          <img src="image/mincedmeat.jpg" alt="Not found">
         </div>

         <div class="col-10">
            <p>This is minced meat blablaalanlaaaaaa..............</p>
            <form action="/review.php">
            <div class="star-icon col-7">
                     
                     <input type="radio" name="rating1" id="rating1">
                     <label for="rating1" class="fa fa-star"></label>
                     <input type="radio" name="rating1" id="rating2">
                     <label for="rating2" class="fa fa-star"></label>
                     <input type="radio" name="rating1" id="rating3">
                     <label for="rating3" class="fa fa-star"></label>
                     <input type="radio" name="rating1" id="rating4">
                     <label for="rating4" class="fa fa-star"></label>
                     <input type="radio" name="rating1" id="rating5">
                     <label for="rating5" class="fa fa-star"></label>
                    
               </div>

               <div class="col-10">
               <p>Give Your Feedback</p>
                  <textarea id="review" name="review" ></textarea>
            </div>
            <input type="submit" value="Submit">
            </form>
         </div>
         

</div>
</div>
<?php include('footer.php'); ?>
   
                
          

 


</body>
</html>