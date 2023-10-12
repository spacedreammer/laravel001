<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    // public static function find($id)
    // {
    //     $listings = self::all();

    //     foreach ($listings as $listing) {
    //         if ($listing['id'] == $id) {
    //             return $listing;
    //         }
    //     }
    // }
    use HasFactory;

    // you can filter like that bellow or you can go to the file AppServiceprovider.php and on boot fxn use "Model::unguard()"
    //protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags', 'logo'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    //Relaship to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
