jQuery(document).ready(function($){
    /*
     * Attaches the image uploader to the input field
     */
    
    // Instantiates the variable that holds the media library frame.
    let meta_image_frame;
 
    // Runs when the image button is clicked.
    $('#custom_pic_button').click(function(e){
 
        e.preventDefault();
 
        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }
 
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: custom_pic.title,
            button: { text:  custom_pic.button },
            library: { type: 'image' }
        });
 
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
 
            // Grabs the attachment selection and creates a JSON representation of the model.
            let media_attachment = meta_image_frame.state().get('selection').first().toJSON();
 
            // Sends the attachment URL to our custom image input field.
            $('#custom_pic').val(media_attachment.url);
        });
 
        // Opens the media library frame.
        meta_image_frame.open();
        
    });

    // Clear custom pic field
    $('#remove_pic').click(function(e) {

        e.preventDefault();
        $('#custom_pic').val('');

    });

    // Clear all custom fields
    $('#clear_custom').click(function(e) {

        e.preventDefault();
        $('#custom_pic').val('');
        $('#custom_product_type option:first').prop('selected', true);

    });

    // Replace standard submit
    $('#publish').remove();
    let custom_submit = document.createElement("input"),
        attributes = {
            'type': 'submit',
            'name': 'save',
            'id': 'publish',
            'class': 'button button-primary button-large',
            'value': 'Custom Update'
        }
    $(custom_submit).attr(attributes);
    $('#publishing-action').append(custom_submit);

});