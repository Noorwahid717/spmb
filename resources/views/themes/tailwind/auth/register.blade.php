@extends('theme::layouts.app')

@section('content')


<div class="sm:mx-auto sm:w-full sm:max-w-md sm:pt-10">
    <h2 class="text-3xl font-extrabold leading-9 text-center text-gray-900 sm:mt-6 lg:text-5xl">
        Daftar sekarang
    </h2>
    <p class="mt-4 text-sm leading-5 text-center text-gray-600 max-w">
        atau kamu bisa
        <a href="{{ route('login') }}"
            class="font-medium transition duration-150 ease-in-out text-wave-600 hover:text-wave-500 focus:outline-none focus:underline">
            masuk disini
        </a>
    </p>
</div>

<div class="flex flex-col justify-center pb-10 sm:pb-20 sm:px-6 lg:px-8">


    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white border shadow border-gray-50 sm:rounded-lg sm:px-10">
            <form
                action="@if (setting('billing.card_upfront')) {{ route('wave.register-subscribe') }}@else{{ route('register') }} @endif"
                method="POST" enctype="multipart/form-data">
                @csrf
                <!-- If we want the user to purchase before they can create an account -->

                <div class="pb-3 sm:border-b sm:border-gray-200">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Profil
                    </h3>
                    <p class="max-w-2xl mt-1 text-sm leading-5 text-gray-500">
                        Informasi tentang akun Anda.
                    </p>
                </div>

                @csrf

                <div class="mt-6">
                    <label for="nik" class="block text-sm font-medium leading-5 text-gray-700">
                        NIK
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="nik" type="text" name="nik" placeholder="nomor induk kependudukan*" required
                            class="w-full form-input" value="{{ old('nik') }}" @if (!setting('billing.card_upfront'))
                            {{ 'autofocus' }} @endif>
                    </div>
                    @if ($errors->has('nik'))
                    <div class="mt-1 text-red-500">
                        {{ $errors->first('nik') }}
                    </div>
                    @endif
                </div>

                <div class="mt-6">
                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                        Nama
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="name" type="text" name="name" placeholder="nama lengkap sesuai ktp*" required
                            class="w-full form-input" value="{{ old('name') }}" @if (!setting('billing.card_upfront'))
                            {{ 'autofocus' }} @endif>
                    </div>
                    @if ($errors->has('name'))
                    <div class="mt-1 text-red-500">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>

                @if (setting('auth.username_in_registration') && setting('auth.username_in_registration') == 'yes')
                <div class="mt-6">
                    <label for="username" class="block text-sm font-medium leading-5 text-gray-700">
                        Username
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required
                            class="w-full form-input">
                    </div>
                    @if ($errors->has('username'))
                    <div class="mt-1 text-red-500">
                        {{ $errors->first('username') }}
                    </div>
                    @endif
                </div>
                @endif

                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            Alamat email
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="email" type="email" name="email" placeholder="Email utama"
                                value="{{ old('email') }}" required class="w-full form-input">
                        </div>
                        @if ($errors->has('email'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <label for="no_hp_camaba" class="block text-sm font-medium leading-5 text-gray-700">
                            Nomor Handphone Pribadi
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="no_hp_camaba" type="text" name="no_hp_camaba" placeholder="nomor whatsapp*"
                                required class="w-full form-input" value="{{ old('no_hp_camaba') }}"
                                @if (!setting('billing.card_upfront')) {{ 'autofocus' }} @endif>
                        </div>
                        @if ($errors->has('no_hp_camaba'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('no_hp_camaba') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <label for="no_hp_ortu" class="block text-sm font-medium leading-5 text-gray-700">
                            Nomor Handphone Ortu/Wali
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="no_hp_ortu" type="text" name="no_hp_ortu" placeholder="nomor whatsapp*" required
                                class="w-full form-input" value="{{ old('no_hp_ortu') }}"
                                @if (!setting('billing.card_upfront')) {{ 'autofocus' }} @endif>
                        </div>
                        @if ($errors->has('no_hp_ortu'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('no_hp_ortu') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                            Password
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password" type="password" name="password" required class="w-full form-input">
                        </div>
                        @if ($errors->has('password'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                            Konfirmasi Password
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="w-full form-input">
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-5 row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bukti_pembayaran">{{ __('Bukti Pembayaran Administrasi') }}</label>
                                @if(isset($dataTypeContent->bukti_pembayaran))
                                    <img src="{{ filter_var($dataTypeContent->bukti_pembayaran, FILTER_VALIDATE_URL) ? $dataTypeContent->bukti_pembayaran : Voyager::image( $dataTypeContent->bukti_pembayaran ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="bukti_pembayaran" name="bukti_pembayaran">
                            </div>
                            @error('bukti_pembayaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-center justify-center text-sm leading-5">
                        <span class="block w-full mt-5 rounded-md shadow-sm">
                            <button type="submit"
                                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-600 hover:bg-wave-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave active:bg-wave-700">
                                Daftar
                            </button>

                    </span>
                    <a href="{{ route('login') }}"
                        class="mt-3 font-medium transition duration-150 ease-in-out text-wave-600 hover:text-wave-500 focus:outline-none focus:underline">
                        Sudah memiliki akun?Masuk disini
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection