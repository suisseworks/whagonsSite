/*==============================================================*/
// Contact Form  JS
/*==============================================================*/
var sending = false;
(function($) {
    "use strict"; // Start of use strict

    $(document).ready(function () {
        $('#contact_form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                subject: 'required',
                additional_details: 'required',
            },
            messages: {
                email: {
                    required: 'Por favor, introduzca su dirección de correo electrónico',
                    email: 'Por favor, introduce una dirección de correo electrónico válida'
                },
                subject: 'Por favor ingresa tu asunto',
                additional_details: 'Por favor ingresa tus datos adicionales',
            }
        });

        $(document).on('submit', '#contact_form', function(e) {
            if($('#contact_form').valid()) {
                e.preventDefault();
                var form = $("#contact_form").serialize();
                sendEmail();
            }
        });
    });


    function formSuccess() {
        $('#contact_form')[0].reset();
        $('#error_alert').hide();
        $('#success_alert').html('Correo electrónico enviado correctamente. Nos comunicaremos con usted en breve. Gracias.').show();
        setTimeout(function() { $('#success_alert').hide(); }, 5000);
    }

    function formError() {
        $('#success_alert').hide();
        $('#error_alert').html('Lo sentimos, se produjo un error al enviar el mensaje. Inténtelo de nuevo.').show();
        setTimeout(function() { $('#error_alert').hide(); }, 5000);
    }

    function showLoader(isLoading) {
        if (isLoading) {
            $("#btn-submit-contact").hide();
            $("#loader").css("display", "flex");
        } else {
            $("#btn-submit-contact").show();
            $("#loader").css("display", "none");
        }
    }

    function sendEmail() {
        // var name = $('#name').val();
        var subject = $('#subject').val();
        var email = $('#email').val();
        var description = $('#additional_details').val();

        showLoader(true);

        $.ajax({
            url: 'https://webadmin.whagons.com/api/sendContactEmail',
            type: 'POST',
            data: {
                name: '',
                subject: subject,
                email: email,
                organization: '',
                phone: '',
                description: description,
                whformtype: 'agendar-demo',
            },
            dataType: "json",
            success: function(response) {

                if (response.result) {
                    showLoader(false);
                    formSuccess();
                } else {
                    formError();
                    sending = false;
                }
            }
        });
    }
}(jQuery)); // End of use strict