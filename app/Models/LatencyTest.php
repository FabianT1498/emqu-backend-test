<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatencyTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'latency',
        'server_ipv4',
        'user_id'
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->status = key_exists('status', $attributes) ? $attributes['status'] : 'FAILURE';
        $this->latency =  key_exists('latency', $attributes) ? $attributes['latency'] : '';
        $this->server_ipv4 = key_exists('server_ipv4', $attributes) ? $attributes['server_ipv4'] : '';
        $this->user_id =  key_exists('user_id', $attributes) ? $attributes['user_id'] : '';
    }

    public function latency_tests()
    {
        return $this->hasMany(LatencyTest::class);
    }
}
