<?php if (!($hide ?? false) ) : ?>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    const isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

    window.
        fbAsyncInit = function() {
        FB.init({
            xfbml: isMobile,
            version: 'v3.3',
            appId: '1182041845253530',
        });

        const fbChatDialogOpened = !!sessionStorage.getItem('fb_chat_dialog_opened');

        if (!isMobile && !fbChatDialogOpened) {
            setTimeout(() => {
                FB.XFBML.parse(document.body, FB.CustomerChat.showDialog);
                sessionStorage.setItem('fb_chat_dialog_opened', 'true');
            }, 5000);
        } else if (!isMobile && fbChatDialogOpened) {
            $('.fb-customerchat').attr('greeting_dialog_display', 'show');
            FB.XFBML.parse();
        }
    };
</script>
<script async defer src="https://connect.facebook.net/de_DE/sdk/xfbml.customerchat.js"></script>
<!-- Your customer chat code -->
<div class="fb-customerchat"
     attribution="setup_tool"
     page_id="242727883083783"
     logged_in_greeting="Finde jetzt das perfekte Produkt mit deinem Shopping Assistenten"
     logged_out_greeting="Finde jetzt das perfekte Produkt mit deinem Shopping Assistenten"
     greeting_dialog_display="hide">
</div>
<style>
    .fb_customer_chat_bounce_in_v2 {bottom: 155pt !important;}
    .fb_dialog {bottom: 110pt !important;}
   @media (max-width: 756px) {
       .fb_customer_chat_bounce_in_v2 {bottom: 175pt !important;}
       .fb_dialog {bottom: 130pt !important;}
   }
</style>
<?php endif; ?>
