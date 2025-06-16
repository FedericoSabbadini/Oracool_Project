@extends('layouts.master')


    @section('head', 'Oracool > Log')

    @section('login-active', 'active')

    @section('body')
    @if(request()->has('expired'))
        <script>
            toastr.error("{{ __('error.session-expired') }}");
        </script>
    @endif


        @php 
            $emailRequired = __('auth.email_required');
            $passwordRequired = __('auth.password_required');
            $nameRequired = __('auth.name_required');
            $passwordConfirmRequired = __('auth.password_confirm_required');
            $keyRequired = __('auth.key_required');
            $passwordValid = __('auth.password_valid');
            $emailValid = __('auth.email_valid');
            $emailUnique = __('auth.email_unique');
            $passwordConfirmValid = __('auth.password_confirm_valid');

        @endphp
        <script>
            $(document).ready(function() {

                //validation messages
                const emailRequired = @json($emailRequired);
                const passwordRequired = @json($passwordRequired);
                const nameRequired = @json($nameRequired);
                const passwordConfirmRequired = @json($passwordConfirmRequired);
                const keyRequired = @json($keyRequired);
                const passwordValid = @json($passwordValid);
                const emailValid = @json($emailValid);
                const emailUnique = @json($emailUnique);
                const passwordConfirmValid = @json($passwordConfirmValid);

                //login control
                    $("#login-form").submit(function(event) {
                        var email = $("#mail-login").val();
                        var password = $("#password-login").val();
                        var remember = $("input[name='remember']").is(":checked");
                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex 
                        var error=false;

                        if (email.trim() === "") {
                            event.preventDefault();
                            $("#mail-login").addClass("error-input");
                            $("#mail-login").attr("placeholder", emailRequired);
                            !error && $("#mail-login").focus();
                            error=true;                        
                        } else if (!emailRegex.test(email)) {
                            event.preventDefault();
                            $("#mail-login").val('');
                            $("#mail-login").addClass("error-input");
                            $("#mail-login").attr("placeholder", emailValid);
                            !error && $("#mail-login").focus();
                            error=true;                        
                        }

                        if (password.trim() === "") {
                            event.preventDefault();
                            $("#password-login").addClass("error-input");
                            $("#password-login").attr("placeholder", passwordRequired);
                            !error && $("#password-login").focus();
                            error=true;                        
                        }
                    });
                

                //register control
                    $("#register-form").submit(function(event) {
                        // Always prevent the default form submission at first
                        event.preventDefault();
                        
                        var name = $("#name-register").val();
                        var email = $("#email-register").val();
                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex 
                        var password = $("#password-register").val();
                        var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // At least 8 characters, at least 1 letter and 1 number
                        var passwordConfirm = $("#confirmPassword-register").val();
                        var error=false;


                        if (name.trim() === "") {
                            $("#name-register").addClass("error-input");
                            $("#name-register").attr("placeholder", nameRequired);
                            !error && $("#name-register").focus();
                            error=true;                        
                        }

                        if (email.trim() === "") {
                            $("#email-register").addClass("error-input");
                            $("#email-register").attr("placeholder", emailRequired);
                            !error && $("#email-register").focus();
                            error=true;                        
                        } else if (!emailRegex.test(email)) {
                            $("#email-register").val('');
                            $("#email-register").addClass("error-input");
                            $("#email-register").attr("placeholder", emailValid);
                            !error && $("#email-register").focus();
                            error=true;                        
                        }

                        if (password.trim() === "") {
                            $("#password-register").addClass("error-input");
                            $("#password-register").attr("placeholder", passwordRequired);
                            !error && $("#password-register").focus();
                            error=true;                        
                        } else if (!passwordRegex.test(password)) {
                            $("#password-register").val('');
                            $("#confirmPassword-register").val('');
                            $("#password-register").addClass("error-input");
                            $("#password-register").attr("placeholder", passwordValid);
                            !error && $("#password-register").focus();
                            error=true;                        
                        }

                        if (passwordConfirm.trim() === "") {
                            $("#confirmPassword-register").addClass("error-input");
                            $("#confirmPassword-register").attr("placeholder", passwordConfirmRequired);
                            !error && $("#confirmPassword-register").focus();
                            error=true;                        
                        }

                        if (password.trim() !== passwordConfirm.trim()) {
                            $("#confirmPassword-register").val('');
                            $("#confirmPassword-register").addClass("error-input");
                            $("#confirmPassword-register").attr("placeholder", passwordConfirmValid);
                            !error && $("#confirmPassword-register").focus();
                            error = true;
                        }


                        if(!error) {
                            console.log("Starting email verification...");
                            $.ajax({
                                type: 'GET',
                                url: '/checkEmail',
                                data: { email: email.trim() },
                                
                                success: function(response) {
                                    if (response.exists) {
                                        $("#email-register").val('');
                                        $("#password-register").val('');
                                        $("#confirmPassword-register").val('');
                                        $("#confirmPassword-register").attr("placeholder", passwordConfirmRequired);
                                        $("#email-register").addClass("error-input");
                                        $("#email-register").attr("placeholder", emailUnique);
                                        $("#email-register").focus();
                                    } else {
                                        document.getElementById("register-form").submit();
                                    }
                                },

                            });
                        }
                    });
                
            
                //admin control
                    $("#admin-form").submit(function(event) {
                        var email = $("#mail-admin").val();
                        var password = $("#password-admin").val();
                        var key = $("#key-admin").val();
                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex 
                        var error=false;

                        if (email.trim() === "") {
                            event.preventDefault();
                            $("#mail-admin").addClass("error-input");
                            $("#mail-admin").attr("placeholder", emailRequired);
                            !error && $("#mail-admin").focus();
                            error=true;                        
                        } else if (!emailRegex.test(email)) {
                            event.preventDefault();
                            $("#mail-admin").val('');
                            $("#mail-admin").addClass("error-input");
                            $("#mail-admin").attr("placeholder", emailValid);
                            !error && $("#mail-admin").focus();
                            error=true;                        
                        }

                        if (password.trim() === "") {
                            event.preventDefault();
                            $("#password-admin").addClass("error-input");
                            $("#password-admin").attr("placeholder", passwordRequired);
                            !error && $("#password-admin").focus();
                            error=true;                        
                        }

                        if (key.trim() === "") {
                            event.preventDefault();
                            $("#key-admin").addClass("error-input");
                            $("#key-admin").attr("placeholder", keyRequired);
                            !error && $("#key-admin").focus();
                            error=true;                        
                        }
                    });


                    
            });
        </script>

        <div class="row bg-gradient-secondary justify-content-center align-items-center py-4">
            <div class="col-8 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                <ul class="nav nav-tabs" id="authTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link_auth active border-0" id="login-tab" data-bs-toggle="tab" 
                        data-bs-target="#login" type="button" role="tab">
                            Login
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link_auth border-0" id="register-tab" data-bs-toggle="tab" 
                        data-bs-target="#register" type="button" role="tab">
                            {{__('auth.registration') }}

                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link nav-link_auth border-0" id="admin-tab" data-bs-toggle="tab" 
                        data-bs-target="#admin" type="button" role="tab">
                            Admin
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="authTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel"> <!--riprende #login---->
                        <form action="{{ route('login.store') }}" method="POST" id="login-form">
                            @csrf                    
                            <div class="mb-3">
                                <input type="text" name="email" id="mail-login" class="form-control custom-input-form" placeholder="Email" autofocus/>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password-login" class="form-control custom-input-form" placeholder="Password"/>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">
                                {{ __('auth.remember_me') }}

                                </label>
                            </div>
                            <div class="d-grid">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                            <!-- <div class="text-center mt-3">
                                <a href="#">
                            {{ __('auth.forgot_password') }}
                                </a>
                            </div> -->
                        </form>
                    </div>

                    <div class="tab-pane fade" id="register" role="tabpanel"> <!--riprende #register---->
                        <form action="{{ route('register.store') }}" method="POST" id="register-form">
                            @csrf

                            <div class="input-group mb-3 ">
                                <span class="input-group-text" id="visible-addon">@</span>
                                <input type="text" name="name" class="form-control custom-input-form" id="name-register"placeholder="Username" aria-label="Username" aria-describedby="visible-addon">
                                <input type="text" class="form-control d-none" placeholder="Hidden input" aria-label="Hidden input" aria-describedby="visible-addon">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="email"  id="email-register" class="form-control custom-input-form" placeholder="Email" />
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password-register"class="form-control custom-input-form" placeholder="Password" />
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password_confirmation" id="confirmPassword-register" class="form-control custom-input-form" placeholder="{{ __('auth.confirm_password') }}" />
                            </div>
                            <div class="d-grid">
                                <input type="submit" id="register-action" class="btn btn-primary" value="{{ __('auth.register_now') }}">
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="admin" role="tabpanel"> <!--riprende #admin---->
                        <form action="{{ route('login.storeAdmin') }}" method="POST" id="admin-form">
                            @csrf                    
                            <div class="mb-3">
                                <input type="text" name="email" id="mail-admin" class="form-control custom-input-form" placeholder="Email" autocomplete="off" />
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password-admin" class="form-control custom-input-form" placeholder="Password" />
                            </div>

                            <div class="mb-3">
                                <input type="password" name="key" id="key-admin" class="form-control custom-input-form" placeholder="Key" />
                            </div>
                            
                            <div class="d-grid">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection