$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});

/*Used to validate login password length*/
function validatePassword(event){
	var password = document.getElementById("password");
	var passwordRegExp = /(?=.{6,})/;
	var message2 = document.getElementById("message2");
	var button = document.getElementById("submit");
	
	if(passwordRegExp.test(password.value))
	{
		message2.innerHTML = "";
		button.disabled = false;
		return true;
	}
	else{
		if(password.value==="")
		{
			message2.innerHTML = "";
		}
		else {
			message2.innerHTML = "Password should be between 6 characters or more";
			button.disabled = true;
			return false;
		}
	}
}

/*Used to validate email pattern*/
function validate(event){
	var email = document.getElementById("email");
	var emailRegExp = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
	var button = document.getElementById("submit");
	var message = document.getElementById("message");
	var password = document.getElementById("password");
	
	if(emailRegExp.test(email.value))
	{
		
		message.innerHTML = "";
		if(password.value==="")
		{
			button.disabled = true;
		}
		else{
			button.disabled = false;
		}
		return true;
	}
	else{
		if(email.value==="")
			message.innerHTML = "";
		else
		{
			message.innerHTML = "Please enter a valid email such as mail@example.com";
			button.disabled = true;
			return false;
		}
	}
	
}

/*Used to validate register password*/
function registerValidatePassword(event){
	var message2 = document.getElementById("message2");
	var password = document.getElementById("password");
	var password2 = document.getElementById("password2");
	
		if(password.value!="")
		{
			if(password.value == password2.value)
			{
				message2.innerHTML = "";
			}
			else{
				message2.innerHTML = "Passwords do not match!";
				event.preventDefault();
			}
		
		}
}

/* Image validation*/
function validateImage(id) {
    var formData = new FormData();
 
    var file = document.getElementById(id).files[0];
 
    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png" && t != "gif") {
		document.getElementById('imageError').innerHTML = "Please select a valid image file";
        document.getElementById(id).value = '';
        return false;
    }
    if (file.size > 1024000) {
        document.getElementById('imageError').innerHTML = "Image size should not be more than 1mb";
        document.getElementById(id).value = '';
        return false;
    }
    return true;
}