

        
                <?php 
                $csvComments = $ingredient['COMMENTS'];
                
                if(isset($_SESSION["ValidUser"]) && $_SESSION["ValidUser"] === "TRUE" && isset($_POST["com"])){
                    $validcomment = filter_var($_POST["comment"], FILTER_SANITIZE_STRING);
                    $c = array();
                    $i =0;
                    $c[$i++] = makeNewComment($_SESSION["UserName"], $validcomment);
                    writeComments($csvComments, $c);
                  }  
                  if(file_exists($csvComments)){
                ?><center><div id ="comments_box" style="background-color:#bfdf78; border: 2px solid black; border-radius: 4px; text-align:left; outline:none;width:50%; padding:1% ;">
                <?php 
                
                    $comments = readComments($csvComments);
                    foreach($comments as $com){
                    echo $com->username . ": " . $com->comment;
                    }
                    
               
                
                ?></div></center><?php
                 }
                if((!isset($_SESSION["ValidUser"]) || $_SESSION["ValidUser"] === "FALSE") && isset($_POST["com"])){
                ?> <center><p>***Must be logged in to comment on page***</p></center><?php
                }
                
                ?>
        
                </div>
   
	<!-- thrid col -->				
			<div class="col-xs-6" >
			
			
            <?php if (empty($_POST["comment"])) {
                    $comment = "";
                  } 
                else {
                $comment = filter_var($_POST["comment"], FILTER_SANITIZE_STRING);
                }
                ?>
                
                <form method="POST" action="#" id="comment_form">  
               
      <center> <textarea name="comment" rows="12" cols="60" placeholder="Comment"></textarea>
      <br></br>
                <input type="hidden" value="done" name="com">
                <input type="submit" value="Submit Comment">
     </center>
</form>
