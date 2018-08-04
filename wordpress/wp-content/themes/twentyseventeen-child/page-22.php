<?php
$_ajax = admin_url('admin-ajax.php');
?>

<?php get_header() ?>

            <div id="container"> 
                <div id="content" role="main" style="padding: 20px 92px;">

                <h1 class="page-title">Register</h1>
<!--SUBMIT POST-->
                <form id="registered" name="registration" class="post_work" method="post" enctype="multipart/form-data">
                  <p id="message"></p>

                        <p><label for="title">Name</label><br />
                            <input type="text" id="name" class="required" value="" tabindex="1" size="20" name="name" />
                        </p>
                      

<!-- Listing Email --> 
                <fieldset class="listingemail"> 
                    <label for="listingemail">Your Email</label> 
                            <input type="text" value="" id="listingemail" tabindex="20" name="listingemail" /> 
                </fieldset>

<!-- Listing Phone --> 
                <fieldset class="listingphone"> 
                    <label for="listingphone">Your Phone</label> 
                    <input type="text" value="" id="listingphone" tabindex="20" name="listingphone" /> 
                </fieldset> 

                         <input type="hidden" name="wp_ajax_my_special_action" value="wp_ajax_nopriv_my_special_action"/>


                <p align="right"><input type="submit" value="Submit" tabindex="6" id="submit" name="submit" /></p>

                        <?php wp_nonce_field( 'new-post' ); ?>
            </form>


<!--SUBMIT POST END-->

            </div><!-- .content -->
        </div><!-- #container -->

<?php get_footer(); ?>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    // Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
    
      name: "required",
      listingphone: "required",
      listingemail: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },

    },
    // Specify validation error messages
    messages: {
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    
  var name = $('#name').val();
        var email = $('#listingemail').val();
    var phone = $('#listingphone').val();

        var leadData = { 
                email: email,
                name: name,
                phone : phone,
                action: 'my_special_action'
            };

        $.ajax({
            type: 'POST',
            url:"<?php echo $_ajax;?>",
            data: leadData,
            dataType: 'json',
        success: function(data) {
            $("#message").html(data);
            $("#message").addClass("alert alert-success");
            document.getElementById("registered").reset();
            },
          
        }); 


    }
  });
});

</script>