

<div id="success-message" class="alert alert-success" style="display:none;"></div>
<div id="error-message" class="alert alert-error" style="display:none;"></div>

<form id="enquiry">

    <h2>Send Enquiry about <?php the_title(); ?></h2>

    <input type="hidden" name="registration" value="<?php the_field('registration');?>">
    <div class="form-group row">
        <div class="col-lg-6">
        <label for="frist_name">First name</label>
            <input type="text" name="fname" placeholder="First Name" class="form-control" required >
        </div>
        <div class="col-lg-6">
        <label for="last_name">Last name</label>
            <input type="text" name="lname" placeholder="Last Name" class="form-control" required >
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
        <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" class="form-control" required >
        </div>
        <div class="col-lg-6">
        <label for="phone">Phone No.</label>
            <input type="tel" name="phone" placeholder="Phone Number" class="form-control" required >
        </div>
    </div>

    <div class="form-group mb-2">
    <label for="your_enquiry">Write Your Enquiry here</label>
        <textarea name="enquiry" class="form-control" placeholder="Please Enter your Enquiry" required></textarea>
    </div>
    <div class="form-group d-grid gap-2 col-6 mx-auto">
        <button type="submit" class="btn btn-success btn-block">Send your Enquiry</button>
    </div> 
    
</form>

<script>


    (function($){

        $('#enquiry').submit(function(event){
            event.preventDefault();
            var endpoint = '<?php echo admin_url('admin-ajax.php');?>';
            var form = $('#enquiry').serialize();
            var formdata = new FormData;
            formdata.append('action', 'enquiry');
            formdata.append('nonce', '<?php echo wp_create_nonce('ajax-nonce');?>');
            formdata.append('enquiry', form);

            $.ajax(endpoint, {
                type:'POST',
                data:formdata,
                processData: false,
                contentType: false,

                success: function(res){

                        $('#enquiry').fadeOut(200);
                        $('#success-message').text('Thanks for your Enquiry').show();
                        $('#enquiry').trigger('reset');
                        $('#enquiry').fadeIn(500);
                },

                error: function(err){

                        alert(err.responseJSON.data)
                        // $('#enquiry').fadeOut(200);
                        // $('#error-message').text('Error occured').show();
                        // $('#enquiry').trigger('reset');
                        // $('#enquiry').fadeIn(500);

                }
            })
        })

        
    })(jQuery)
    

</script>