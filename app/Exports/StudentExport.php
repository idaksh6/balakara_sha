<?php

namespace App\Exports;

use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;


class StudentExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithStyles
{
    protected $student_name;
    protected $category;
    protected $academic_year;

    public function __construct($student_name, $category, $academic_year)
    {
        $this->student_name = $student_name;
        $this->category = $category;
        $this->academic_year = $academic_year;
    }

    public function collection()
    {
        $query = Products::select(
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
            'category'
        );

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

        if (!empty($this->academic_year)) {
            $query->where('academic_year', $this->academic_year);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Student Image',
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
            'Mothers Email Address',
            'Mothers Contact Details',
            'Mothers Occupation',
            'Address',
            'Payment Details',
            'Category',
        ];
    }


    public function map($row): array
    {
        $imagePath = $row->student_image ? public_path('student_Photos/' . $row->student_image) : '';
    
        return [
            $imagePath ? '=HYPERLINK("' . $imagePath . '", "View Image")' : '', // Empty box if no image selected
            $row->first_name,
            $row->last_name,
            $row->dob,
            $row->gender,
            $row->academic_year,
            $row->grade,
            $row->language,
            $row->sibling_details,
            $row->fathers_name,
            $row->fathers_qualification,
            $row->fathers_email_details,
            $row->fathers_contact_details,
            $row->fathers_occupation,
            $row->mothers_name,
            $row->mothers_qualification,
            $row->mothers_email_details,
            $row->mothers_contact_details,
            $row->mothers_occupation,
            $row->address,
            $row->payment_details,
            $row->category,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();

        $range = 'A2:A' . $highestRow;
    
        $sheet->getStyle($range)->getFont()->getColor()->setRGB(Color::COLOR_BLUE);
    
        return [];
    
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
