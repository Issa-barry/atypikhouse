<?php
/**
* Project F2I / AtypikHouse 
* Vasylyshyn Roman
* Dienaba Camara
* Issa Barry
* Cedric HIHEGLO HODEWA
 */
namespace Modules\Booking\Models;

use App\BaseModel;

class Enquiry extends BaseModel
{
    protected $table      = 'bravo_enquiries';

    protected $fillable                           = [
        'object_id',
        'object_model',
        'name',
        'email',
        'phone',
        'note',
        'status',
        'vendor_id',
    ];

    public static $enquiryStatus = [
        'pending',
        'completed',
        'cancel',
    ];

    public function fill(array $attributes)
    {
        if (!empty($attributes)) {
            foreach ($this->fillable as $item) {
                $attributes[$item] = $attributes[$item] ?? null;
            }
        }
        return parent::fill($attributes); // 
    }

    public function service()
    {
        $all = get_bookable_services();
        if ($this->object_model and !empty($all[$this->object_model])) {
            return $this->hasOne($all[$this->object_model], 'id', 'object_id');
        }
        return $this->hasOne(\Modules\Tour\Models\Tour::class, 'id', 'object_id');
    }
    public function getStatusNameAttribute()
    {
        return booking_status_to_text($this->status);
    }
}
