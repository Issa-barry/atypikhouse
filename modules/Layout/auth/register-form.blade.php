<form class="form bravo-form-register" method="post" action="{{route('auth.register.store')}}">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="{{__("Nom")}}">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-first_name"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="{{__("Prenom")}}">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-last_name"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="phone" autocomplete="off" placeholder="{{__('Phone')}}">
        <i class="input-icon field-icon icofont-ui-touch-phone"></i>
        <span class="invalid-feedback error error-phone"></span>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" autocomplete="off" placeholder="{{__('Address email')}}">
        <i class="input-icon field-icon icofont-mail"></i>
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="{{__('Mot de passe')}}">
        <i class="input-icon field-icon icofont-ui-password"></i>
        <span class="invalid-feedback error error-password"></span>
    </div>
    <div class="form-group">
        <label for="term">
            <input id="term" type="checkbox" name="term" class="mr5">
            {!! __("En m'inscrivant,<a href=':link' target='_blank'> j'accepte les conditions générales d'utilisation et consens à l'utilisation sécurisée de mes données conformément à la politique de confidentialité.</a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]) !!}
            <span class="checkmark fcheckbox"></span>
        </label>
        <div><span class="invalid-feedback error error-term"></span></div>
    </div>

    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-submit">
            {{ __('Sing up') }}
            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
    @if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable'))
        <div class="advanced">
            <p class="text-center f14 c-grey">{{__("ou continuer avec")}}</p>
            <div class="row">
                @if(setting_item('facebook_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('/social-login/facebook')}}" class="btn btn_login_fb_link"
                           data-channel="facebook">
                            <i class="input-icon fa fa-facebook"></i>
                            {{__('Facebook')}}
                        </a>
                    </div>
                @endif
                @if(setting_item('google_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('social-login/google')}}" class="btn btn_login_gg_link" data-channel="google">
                            <i class="input-icon fa fa-google"></i>
                            {{__('Google')}}
                        </a>
                    </div>
                @endif
                @if(setting_item('twitter_enable'))
                    <div class="col-xs-12 col-sm-4">
                        <a href="{{url('social-login/twitter')}}" class="btn btn_login_tw_link" data-channel="twitter">
                            <i class="input-icon fa fa-twitter"></i>
                            {{__('Twitter')}}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="c-grey f14 text-center">
       {{__("Avez-vous un compte ?")}}
        <a href="#" data-target="#login" data-toggle="modal">{{__("Connexion")}}</a>
    </div>
</form>
