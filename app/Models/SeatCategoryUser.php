<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SeatCategoryUser extends Pivot
{
    protected $table = 'seat_category_user';
}
