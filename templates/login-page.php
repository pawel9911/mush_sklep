<?php
/* Template Name: Login */

if ( is_user_logged_in() ) {
    wp_redirect( home_url( '/moje-konto/' ) );
    exit;
}

// Sprawdzenie czy formularz logowania został wysłany

$csrf_token = wp_create_nonce( 'login' );

if( isset( $_POST['submit'] ) && wp_verify_nonce( $_POST['csrf_token'], 'login' ) )
{
    // Pobranie pól formularza
    $username = sanitize_text_field( $_POST['username'] );
    $password = sanitize_text_field( $_POST['password'] );

    $errorMessage = [];

    // Sprawdzenie czy pola formularza nie są puste
    if( empty( $username ) || empty( $password ) )
    {
        $errorMessage['failed'] = __('Wszystkie pola są wymagane.', 'loginForm');
        wp_redirect( home_url( '/login' ) );
    }
    else
    {
        // Sprawdzenie czy użytkownik o podanym loginie istnieje w bazie
        $user = get_user_by( 'login', $username );

        // Sprawdzenie czy hasło jest poprawne
        if( $user && wp_check_password( $password, $user->user_pass, $user->ID ) )
        {
            // Jeśli dane logowania są poprawne zaloguj użytkownika i przekieruj na liste
            $credentials = array(
                'user_login' => $username,
                'user_password' => $password,
                'remember' => $_POST['rememberme'] ?? false
            );
            wp_signon( $credentials );
            wp_redirect( home_url( '/moje-konto' ) );
            exit;
        }
        else
        {
            $errorMessage['failed'] = __('Niepoprawny login lub hasło.', 'loginForm');
        }
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
                        <div class="col-12 mb-4">
                            <h5 class="text-center">Jesteś już użytkownikiem?</h5>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="p-2">
                            <form class="form-horizontal" name="loginform" id="loginform" method="post">

                                <input type="hidden" name="csrf_token" value="<?= esc_attr( $csrf_token ) ?>">

                                <div class="mb-4">
                                    <input type="text" name="username" class="form-control input--v2" id="user_login" placeholder="Email">
                                </div>

                                <div class="mb-4">
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" name="password" class="form-control input--v2" placeholder="Hasło" id="user_pass" aria-label="Password" aria-describedby="password-addon">
                                    </div>
                                </div>

                                <div class="text-danger"><?= $errorMessage['failed'] ?? '' ?></div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-check" name="rememberme">
                                    <label class="form-check-label" for="remember-check">
                                        Zapamiętaj mnie
                                    </label>
                                </div>
                                <?php do_action( 'login_form' ); ?>
                                <div class="mt-3 d-grid">
                                    <button class="btn--v1" name="submit" type="submit">Zaloguj się</button>
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="<?= HOME_URL.'/reset-password'?>" class="text-muted">Nie pamiętasz hasła?</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">

                    <div>
                        <p>Nie masz jeszcze konta? <a href="<?= HOME_URL.'/register' ?>" class="fw-medium text-primary"> Zarejestruj się </a> </p>
                        <p>© <script>document.write(new Date().getFullYear())</script> iMush.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
