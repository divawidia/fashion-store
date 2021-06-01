<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class admin_notifications extends DatabaseNotification
{
    protected $table = 'admin_notifications';
}
