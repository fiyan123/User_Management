<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public $guarded = [''];
    public $timestamps = true;

     public function image()
    {
        if ($this->foto && file_exists(public_path('images/article/' . $this->foto))) {
            return asset('images/article/' . $this->foto);
        } else {
            return asset('images/no_image.jpg');
        }
    }

    // mengahupus image(foto) di storage(penyimpanan) public
    public function deleteImage()
    {
        if ($this->foto && file_exists(public_path('images/article/' . $this->foto))) {
            return unlink(public_path('images/article/' . $this->foto));
        }
    }
}
