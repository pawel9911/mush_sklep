<?php
/* Template Name: Reset Password */

if ( 'POST' == $_SERVER['REQUEST_METHOD'] )
{
    $statusMessage = [];

    $userData = get_user_by( 'email', $_POST['useremail'] );

    if ( empty( $userData ) )
    {
        $statusMessage['message'] = __('Podany adres e-mail nie jest przypisany do żadnego konta.', 'resetForm');
    }
    else
    {
        $userLogin = $userData->user_login;
        $useEmail = $userData->user_email;
        print_r($useEmail);
        $key = get_password_reset_key( $userData );
        $message = __('Witaj! Otrzymujesz tę wiadomość, ponieważ złożyłeś(aś) wniosek o reset hasła dla swojego konta na naszej stronie. Aby zresetować swoje hasło, kliknij w poniższy link:', 'resetForm'). "\r\n\r\n";
        $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($userLogin), 'login') . "\r\n";
        $headers = array(
            'From: Letknow <letknow@l4web.pl>',
            'Content-Type: text/html; charset=UTF-8',
        );

        wp_mail($useEmail, __('Resetowanie hasła', 'resetForm'), $message, $headers);
        $statusMessage['message'] = __('Wysłaliśmy e-mail z linkiem resetującym hasło na Twój adres e-mail.', 'resetForm');
    }
}

get_header();
?>

 <div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center my-5">
                            <img src="<?= THEME_IMAGES_URI ?>/Mush-logo.png" alt="Logo mush" class="logo logo--xl">
                        </div>
                        <div class="col-12 mb-2">
                            <h5 class="text-center">Nie pamiętasz hasła?</h5>
                            <p class="text-muted text-center">
                                <small>Wpisz adres e-mail, który został podany podczas zakładania konta na naszym sklepie, a prześlemy Ci link umożliwiający zmianę hasła.</small>
                            </p>
                        </div>
                    </div>
                    <div class="card-body pt-0">

                        <div class="p-2">
                            <form class="form-horizontal" method="post">

                                <div class="mb-3">
                                    <input type="email" class="form-control input--v2" id="useremail" name="useremail" placeholder="Email">
                                </div>

                                <div class="mt-4 d-grid">
                                    <button class="btn--v1" type="submit" name="submit" id="reset-button">Odzyskaj hasło</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <p>Pamiętasz? <a href="<?= HOME_URL.'/login' ?>" class="fw-medium text-primary">  Zaloguj się</a> </p>
                    <p>© <script>document.write(new Date().getFullYear())</script> iMush. </p>
                </div>

            </div>
        </div>
    </div>
</div>