<?php

namespace App\Exports;

use App\Models\products;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Styles\Style;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;


class StudentExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{

    protected $student_name;
    protected $category;
    protected $academic_year;
    
    public function __construct($student_name,$category,$academic_year)
    {
        $this->student_name = $student_name;
        $this->category = $category;
        $this->academic_year = $academic_year;
    }


    public function collection()
    {

        $query = Products::select('first_name','last_name','dob','gender','academic_year','grade','language','sibling_details','fathers_name','fathers_qualification','fathers_email_details','fathers_contact_details',
    'fathers_occupation','mothers_name','mothers_qualification','mothers_email_details','mothers_contact_details','mothers_occupation','address','payment_details','category');
        
        if (!empty($this->student_name)) {
            $student_name = $this->student_name;
            $query->where(function ($q) use ($student_name) {
                $q->where('first_name', 'like', "%$student_name%")
                  ->orWhere('last_name', 'like', "%$student_name%");
                 
            });
        }
     
        
        if (!empty($this->category)) {
            $query->where('category', $this->category);
        }
        
        if (!empty( $this->academic_year)) {
            $query->where('academic_year',  $this->academic_year);
        }
        
        $data = $query->get();

        return $data;

    
    }

    public function headings(): array
    {
        // Define the headings for the Excel file
        return [
             'First Name',
             'Last Name',
              'Dob',
              'Gender',
              'Academic Year',
              'Grade',
              'Language',
              'Sibling Details',
              'Fathers Name',
              'Fathers Qualification',
              'Fathers Email Address',
              'Fathers Contact Details',
              'Fathers Occupation',
              'Mothers Name',
              'Mothers Qualification',
              'Mothers Contact Details',
              'Address',
              'Payment Details',
              'Category'
  
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the header row to make it bold
            1 => ['font' => ['bold' => true]],
        ];
    }
}
