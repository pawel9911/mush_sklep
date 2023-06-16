<?php
/* Template Name: Register */


if ( is_user_logged_in() ) {
    wp_redirect( home_url( '/lista-zadan/' ) );
    exit;
}

// tworzymy token csrf
$csrf_token = wp_create_nonce( 'register' );

if ( isset( $_POST['submit'] ) && wp_verify_nonce( $_POST['csrf_token'], 'register' ) )
{
    $create = true;
    $errorMessage = [];

    // sprawdzamy czy username jest uzupełniony oraz czy ma tylko litery i cyfry
    if ( !empty( $_POST['username'] ) )
    {
        $username = sanitize_user( $_POST['username'] );
        if ( !ctype_alnum( $username ) )
        {
            $errorMessage['username'] = __('Pole może zawierać tylko litery i cyfry.', 'registerForm');
            $create = false;
        }

        // sprawdź czy taki uzytkownik istnieje
        if (get_user_by('login', $username))
        {
            $errorMessage['username'] = __('Nazwa użytkownika jest już zajęta.', 'registerForm');
            $create = false;
        }
    }
    else
    {
        $errorMessage['username'] = __('Uzupełnij nazwę użytkownika.', 'registerForm');
        $create = false;
    }

    // sprawdź czy hasło zostało wysłane
    if ( $_POST['password'] )
    {
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeat_password'];

        // sprawdź regexa hasła
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/';
        if (!preg_match($pattern, $password))
        {
            $errorMessage['password'] = __('Hasło musi zawierać conajmniej jedną cyfrę, dużą i małą literę, znak specjalny oraz powinno składać się z conajmniej 8 znaków.', 'registerForm');
            $create = false;
        }

        // sprawdź czy hasła są takie same
        if ( $password !== $repeatPassword )
        {
            $errorMessage['passwordRepeat'] = __('Hasła nie są takie same.', 'registerForm');
            $create = false;
        }
    }
    else
    {
        $errorMessage['password'] = __('Wprowadź hasło.', 'registerForm');
        $create = false;
    }

    //sprawdź czy email został wysłany
    if ( !empty( $_POST['email'] ) )
    {
        $email = sanitize_email( $_POST['email'] );

        // sprawdź czy email już jest zarejestrowany
        if ( email_exists( $email ) )
        {
            $errorMessage['email'] = __('Podany e-mail jest już zarejestrowany.', 'registerForm');
            $create = false;
        }

        // sprawdź poprawność emailu
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errorMessage['email'] = __('Podany e-mail jest niepoprawny.', 'registerForm');
            $create = false;
        }

    }
    else
    {
        $errorMessage['email'] = __('Uzupełnij e-mail', 'registerForm');
        $create = false;
    }

    // zarejestruj użytkownika jeśli $create jest true
    if ($create)
    {
        $user_id = wp_create_user( $username, $password, $email );
        if ( is_wp_error( $user_id ) )
        {
            echo __('Wystąpił błąd podczas rejestracji: ', 'registerForm') . $user_id->get_error_message();
            wp_redirect( home_url('/register') );
            exit;
        }

    // zaloguj użytkownika
        wp_set_auth_cookie( $user_id );
        wp_redirect( home_url('/lista-zadan') );
        exit;
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
                            <h5 class="text-center">Jesteś tu pierwszy raz?</h5>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="p-2">
                            <form class="needs-validation " novalidate  method="post" id="register-form">

                                <input type="hidden" name="csrf_token" value="<?= esc_attr( $csrf_token ) ?>">

                                <div class="mb-3">
                                    <input type="text" name="username" class="form-control input--v2" id="username" value="<?= $username ?? '' ?>" placeholder="Imię" required>
                                    <div class="invalid-feedback text-danger"><?= __('Wprowadź imię', 'registerForm') ?></div>
                                    <?php if (isset($errorMessage['username'])) echo '<div class="text-danger">' . $errorMessage['username'] . '</div>'; ?>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="lastname" class="form-control input--v2" id="lastname" value="<?= $lastname ?? '' ?>" placeholder="Nazwisko" required>
                                    <div class="invalid-feedback text-danger"><?= __('Wprowadź nazwisko', 'registerForm') ?></div>
                                    <?php if (isset($errorMessage['lastname'])) echo '<div class="text-danger">' . $errorMessage['lastname'] . '</div>'; ?>
                                </div>

                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control input--v2" id="useremail" value="<?= $email ?? '' ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Email" required>
                                    <div class="invalid-feedback text-danger"><?= __('Wprowadź poprawny adres e-mail', 'registerForm') ?></div>
                                    <?php if (isset($errorMessage['email'])) echo '<div class="text-danger">' . $errorMessage['email'] . '</div>'; ?>
                                </div>

                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control input--v2" id="userpassword" value=""  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}" title="<?= __('Hasło musi zawierać conajmniej jedną cyfrę, dużą i małą literę oraz powinno składać się z conajmniej 8 znaków.', 'registerForm') ?>" placeholder="Hasło" required>
                                    <div class="invalid-feedback text-danger" id="password-error"><?= __('Hasło musi zawierać conajmniej jedną cyfrę, dużą i małą literę oraz powinno składać się z conajmniej 8 znaków.', 'registerForm') ?></div>
                                    <?php if (isset($errorMessage['password'])) echo '<div class="text-danger">' . $errorMessage['password'] . '</div>'; ?>
                                </div>

                                 <div class="mb-3">
                                    <input type="password" name="repeat_password" class="form-control input--v2" id="userpasswordconfirmation" data-parsley-equalto="userpassword" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}"  placeholder="Powtórz hasło" required>
                                     <div class="invalid-feedback text-danger"><?= __('Hasła nie są takie same', 'registerForm') ?></div>
                                     <?php if (isset($errorMessage['passwordRepeat'])) echo '<div class="text-danger">' . $errorMessage['passwordRepeat'] . '</div>'; ?>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-check" name="rememberme">
                                    <label class="form-check-label" for="remember-check">
                                        Chcę otrzymywać informacje o nowościach i promocjach.
                                    </label>
                                </div>

                                <div class="mt-4 d-grid">
                                    <button class="btn--v1" type="submit" name="submit" id="register-button">Załóż konto</button>
                                </div>
                                <div class="mt-4 text-center">
                                    <small>
                                        <p class="mb-0">Klikając w przycisk Załóż konto, zgadzasz się z naszą <a href="<?= get_privacy_policy_url(); ?>" class="text-primary">Polityką prywatności</a></p>
                                    </small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <div>
                        <p>Masz już konto ? <a href="<?= HOME_URL.'/login' ?>" class="fw-medium text-primary"> Zaloguj się</a> </p>
                        <p>© <script>document.write(new Date().getFullYear())</script> iMush. </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

</script>