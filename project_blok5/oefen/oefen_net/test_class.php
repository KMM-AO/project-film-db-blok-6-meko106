<?php  
 //test_class.php  
 include 'crud.php';  
 $data = new Databases;  
 $success_message = '';  
 if(isset($_POST["submit"]))  
 {  
      $insert_data = array(  
           'post_title'     =>     mysqli_real_escape_string($data->con, $_POST['post_title']),  
           'post_desc'          =>     mysqli_real_escape_string($data->con, $_POST['post_desc'])  
      );  
      if($data->insert('tbl_posts', $insert_data))  
      {  
           $success_message = 'Post Inserted';  
      }       
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Select or Fetch Data from Mysql Table using OOPS in PHP</title>  
      </head>  
      <body>  
      <br /><br />  
      <div class="container" style="width:700px;">  
      <form method="post">  
      <label>Post Title</label>  
                     <input type="text" name="post_title" class="form-control" />  
                     <br />  
                     <label>Post Description</label>  
                     <textarea name="post_desc" class="form-control"></textarea>  
                     <br />  
                     <input type="submit" name="submit" class="btn btn-info" value="Submit" />  
                     <span class="text-success">  
                     <?php  
                     if(isset($success_message))  
                     {  
                          echo $success_message;  
                     }  
                     ?>  
                     </span>  
                </form>  
                <br />  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <td width="30%">Post Name</td>  
                               <td width="50">Post Description</td>  
                               <td width="10%">Edit</td>  
                               <td width="10%">Delete</td>  
                          </tr>  
                          <?php  
                          $post_data = $data->select('tbl_posts');  
                          foreach($post_data as $post)  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $post["post_title"]; ?></td>  
                               <td><?php echo substr($post["post_desc"], 0, 200); ?></td>  
                               <td><a href="test_class.php?edit=1&post_id=<?php echo $post["post_id"]; ?>">Edit</a></td>  
                               <td><a href="#" id="<?php echo $post["post_id"]; ?>" class="delete">Delete</a></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  