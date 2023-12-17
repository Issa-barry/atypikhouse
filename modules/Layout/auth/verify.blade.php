@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center bravo-login-form-page bravo-login-page">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérifiez votre adresse e-mail.') }}</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Le lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </div>
                    @endif
                    {{ __('Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification de la part d'AtypikHouse.') }}
                    {{ __('Si vous n'avez pas reçu l'e-mail,') }}, <a href="{{ route('verification.resend') }}">{{ __('cliquez ici pour en demander un autre.') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
