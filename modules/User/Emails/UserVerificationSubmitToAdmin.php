<?php
/**
* Project F2I / AtypikHouse 
* Vasylyshyn Roman
* Dienaba Camara
* Issa Barry
* Cedric HIHEGLO HODEWA
 */
namespace Modules\User\Emails;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserVerificationSubmitToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    protected $email_type;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $subject = __('[:site_name] Un utilisateur a soumis des données de vérification.',['site_name'=>setting_item('site_title')]);

        return $this->subject($subject)->view('User::emails.user-submit-verify-data')->with([
            'user' => $this->user,
        ]);
    }
}
