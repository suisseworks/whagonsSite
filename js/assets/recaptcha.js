!function(r){"use strict";Berserk.behaviors.recaptcha={attach:function(e,a){var t=r('[data-brk-library="recaptcha"]:not(.brk-recaptcha-rendered)');if(t.length){if("undefined"==typeof grecaptcha)return console.log("Waiting for the grecaptcha"),void setTimeout(Berserk.behaviors.recaptcha.attach,a.timeout_delay,e,a);t.addClass("brk-recaptcha-rendered"),grecaptcha.ready(function(){grecaptcha.execute(Berserk.settings.recaptcha_api_key,{action:"login"}).then(function(e){t.append('<input name="g-recaptcha-response" type="hidden" value="'+e+'">')})})}}}}(jQuery);