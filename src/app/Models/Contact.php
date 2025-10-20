<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function getDetail()
    {
        $txt = $this->last_name . ' ' . $this->first_name;

        return $txt;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getGenderLabelAttribute()
    {
    return [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ][$this->gender] ?? '';
    }

    public function getFullNameAttribute()
    {
    return "{$this->last_name} {$this->first_name}";
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
        $query->where(function ($query) use ($keyword) {
            $query->where('last_name', 'like', '%' . $keyword . '%')
            ->orWhere('first_name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%');
        });
        }
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)) {
        $query->where('gender', $gender);
        }
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
        $query->where('category_id', $category_id);
        }
    }

    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            return $query->whereDate('created_at', $date);
        }
        return $query;
    }

}