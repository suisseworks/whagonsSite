/*==============================================================*/
// Contact Form  JS
/*==============================================================*/
var sending = false;
(function($) {
    "use strict"; // Start of use strict

    

    $("#contactForm").validator().on("submit", function(event) {
        
        console.log(`validator ${sending}`);

        if (sending) return false;
        
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            console.log('Error');
            formError();
            submitMSG(false, "Favor completar los campos requeridos!");
        } else {
            // everything looks good!
            sending = true;
            console.log('BIEN');
            event.preventDefault();
            sendEmail();
        }
    });


    function submitForm() {

        // Initiate Variables With Form Content
        var name = $("#name").val();
        var email = $("#email").val();
        //var msg_subject = $("#msg_subject").val();
        //var phone_number = $("#phone_number").val();
        var message = $("#message").val();


        $.ajax({
            type: "POST",
            url: "assets/php/form-process.php",
            data: "name=" + name + "&email=" + email + "&message=" + message,
            success: function(text) {
                console.log(text);
                if (text == "success") {
                    formSuccess();
                } else {
                    formError();
                    submitMSG(false, text);
                }
            }
        });
    }

    function formSuccess() {
        $("#contactForm")[0].reset();
        submitMSG(true, "Message Submitted!");
        sending = false;
    }

    function formError() {
        $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            $(this).removeClass();
        });
    }

    function submitMSG(valid, msg) {
        if (valid) {
            var msgClasses = "h4 text-left tada animated text-success";
        } else {
            var msgClasses = "h4 text-left text-danger";
        }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }

    function sendEmail() {
        var name = $('#name').val();
        var email = $('#email').val();
        var consultation = $('#message').val();

        $("#loader").show();
        submitMSG(false, "Enviando mensaje...");


        $.ajax({
            url: 'assets/php/sendmail.php',
            type: 'POST',
            data: {
                name: name,
                email: email,
                organization: '',
                phone: '',
                consultation: consultation,
                whformtype: 'agendar-demo',
            },
            dataType: "json",
            success: function(response) {

                if (response.result) {
                    $("#loader").hide();
                    formSuccess();
                } else {
                    formError();
                    submitMSG(false, text);
                    sending = false;
                }
            }
        });
    }
}(jQuery)); // End of use strict