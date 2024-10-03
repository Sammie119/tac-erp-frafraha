{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">

    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>TAC PRESS | Forgot Password</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="TAC PRESS | Forgot Password">
    <meta name="author" content="Sammav IT Services">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard">
    <meta name="keywords" content="TAC Press, TACPRESS"><!--end::Primary Meta Tags--><!--begin::Fonts-->

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}"><!--end::Required Plugin(AdminLTE)-->
</head> <!--end::Head--> <!--begin::Body-->

<body class="lockscreen bg-body-secondary">
    <div class="lockscreen-wrapper bg-body-secondary">
        <div class="lockscreen-logo"><b>Forgot Password</b> </div>
        <div class="lockscreen-name">Enter your valid Email Address</div>
        <div class="lockscreen-item">
            @empty($errors->all())

            @else
                <ul class="get-alert bg-body-secondary">
                    @foreach ((array) $errors->all() as $message)
                        <span class="text-danger"><li>{{ $message }}</li></span>
                    @endforeach
                </ul>
            @endempty
            <form class="bg-body-secondary" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group bg-body-secondary">
                    <input type="email" name="email" class="form-control" autofocus>
                </div>
                <div class="mt-3 bg-body-secondary">
                    <button  type="submit" class="btn btn-dark btn-block w-100 rounded-pill">{{ __('Email Password Reset Link') }}</button>
                </div>
            </form>
        </div>
        <div class="help-block text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
    </div>
</body><!--end::Body-->

</html>
