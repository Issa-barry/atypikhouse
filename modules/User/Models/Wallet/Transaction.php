<?php

/**
* Project F2I / AtypikHouse 
* Vasylyshyn Roman
* Dienaba Camara
* Issa Barry
* Cedric HIHEGLO HODEWA
 */

namespace Modules\User\Models\Wallet;


use App\User;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Payment;

class Transaction extends \Bavix\Wallet\Models\Transaction
{

    public function payment(){
        return $this->belongsTo(Payment::class,'payment_id')->withDefault();
    }


    public function save(array $options = [])
    {
        if ($this->create_user) {
            $this->update_user = Auth::id();
        } else {
            $this->create_user = Auth::id();
        }
        return parent::save($options); // 
    }

    public function author(){
        return $this->belongsTo(User::class,'create_user')->withDefault();
    }

    public function getStatusNameAttribute(){
        if($this->confirmed){
            return __("Confirmed");
        }
        if(!$this->payment_id || !$this->payment){
            return __("Pending");
        }
        return $this->payment->status_name;
    }
    public function getStatusClassAttribute(){
        if($this->confirmed){
            return 'success';
        }
        if($this->payment_id && $this->payment){
            switch ($this->payment->status){
                case "processing":
                    return 'warning';
                    break;
            }
        }
        return 'warning';
    }
}
