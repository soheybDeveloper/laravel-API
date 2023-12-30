<?php

// app/Enums/OrderStatus.php

namespace App\Enums;



enum OrderStatus:string
{


    public const PENDING = 'pending';
    public const PROCESSING = 'processing';
    public const COMPLETED = 'completed';
    public const CANCELLED = 'cancelled';



}
