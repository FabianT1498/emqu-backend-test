<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\LatencyTest;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'ipv4',
        'domain_name',
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->ipv4 = key_exists('ipv4', $attributes) ? $attributes['ipv4'] : '';
        $this->name =  key_exists('domain_name', $attributes) ? $attributes['domain_name'] : '';
    }

    public function latency_tests()
    {
        return $this->hasMany(LatencyTest::class);
    }
}
