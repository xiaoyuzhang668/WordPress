<?php 
/* 
Template name: Contact
*/
?>
<?php 
 $response = "";
  //function to generate response
  function my_contact_form_generate_response($type, $message){
    global $response;
    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";
  }

  $missing_content = "Please answer the required questions.";
  $name_blank = "Name can not be blank.";
  $email_blank = "Email can not be blank.";
  $email_invalid = "Email is not valid.";
  $message_unsent  = "Message was not sent. Try again.";
  $message_sent    = "Thanks! Your message has been sent to catzhang1@hotmail.ca."; 

  //user posted variables
  $name = $_POST['message_name'];
  $email = $_POST['message_email'];
  $text = $_POST['message_text'];
  //php mailer variables
  $to = get_option('admin_email');
  $subject = "Someone sent a message from ".get_bloginfo('name');

  // body message markup
  $body = "
  Name is: ${name},
  Email is: ${email},
  Message is: ${text},
  ";
    $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

 if(empty($email)) {
          my_contact_form_generate_response("error", $email_blank);
  } else {
      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            my_contact_form_generate_response("error", $email_invalid);
      } else  { //email is valid
          if (empty($name)) {
                my_contact_form_generate_response("error", $name_blank);
          } else  {
            $sent = wp_mail($to, $subject, $body, $headers);
            if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
            else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent           
          }        
      }
  }
  // else { ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);}
?>
<?php get_header(); ?>
<div class="loader"></div>
          <style type="text/css">
                .error{
                  padding: 5px 9px;
                  border: 1px solid red;
                  color: red;
                  border-radius: 3px;
                  background-color: rgba(255, 255, 255, 0.8);
                }
                .success{
                  padding: 5px 9px;
                  border: 1px solid green;
                  color: green;
                  border-radius: 3px;
                  background-color: rgba(255, 255, 255, 0.8);
               }
            </style>
<section class="contact-form">
<img src="<?php echo get_theme_mod('contact_image', get_bloginfo('template_url').'/images/category_image.jpg'); ?>" class="img-fluid" alt="Default Image"> 
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3 contact-location">
            <form class="p-4 shadow-lg bg-white rounded"  action="<?php the_permalink(); ?>" method="post">
              <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>     
              <div class="entry"> 
                <?php the_content(); ?>
              </div>                                         
              <?php endwhile; ?>      
              <?php endif; ?>
              <div class="row">
                <div class="col-md-6">
                  <!-- form group for first name -->
                  <div class="form-group">
                      <label for="message_name"></label>
                      <input type="text" class="form-control" id="message_name" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="message_email"></label>
                      <input type="textarea" row=10 class="form-control" id="message_email" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>">
                  </div>
                </div>                
                <div class="col-12">
                   <!-- form group for email -->
                  <div class="form-group">
                      <label for="message_text"></label>
                      <textarea rows="4" class="form-control" id="message_text" name="message_text" value="<?php echo esc_attr($_POST['message_text']); ?>"></textarea>     
                  </div>
                </div>
                <div class="col-12 text-center">                  
                  <button type="submit" name="submitted" class="btn btn-secondary mb-2">Send</button>  
                </div>  
                <div class="col-12 text-center"> 
                  <?php echo $response; ?>   
                 
                </div>                     
              </div>              
            </form> 
        </div><!-- End col-md-6 -->       
      </div><!-- end row -->
    </div><!-- end container -->      
</section>
<?php get_footer(); ?>