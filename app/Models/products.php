<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $fillable = [
    'student_image',
    'first_name',
    'last_name',
     'dob', 
     'gender',
     'academic_year',
     'grade',
     'language',
     'sibling_details',
     'fathers_name',
     'fathers_qualification',
     'fathers_email_details',
     'fathers_contact_details',
     'fathers_occupation',
     'mothers_name',
     'mothers_qualification',
     'mothers_email_details',
     'mothers_contact_details',
     'mothers_occupation',
     'address',
     'payment_details',
     'category',
    ];
}
