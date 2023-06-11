<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use PDF;
use PhpParser\Node\Expr\Print_;

class ProductController extends Controller
{

    //////////////INDEX VIEW //////////////////
    public function index()
    {
        $products = Products::paginate(3);
        return view('products.index', ['data' => $products]);
    
        
    }
      //////////////DASHBOARD VIEW//////////////////
      public function dashboard(Request $request)
      {
          $totalStudents = Products::count();
      
          $categoryCounts = Products::select('category', DB::raw('count(*) as count'))
              ->groupBy('category')
              ->get();
      
          $query = Products::query();
      
          // Apply order by clause
          $query->orderBy('created_at', 'desc');
      
          $data = $query->paginate(3); // Set the number of items per page (e.g., 10)
      
          return view('dashboard', compact('data', 'totalStudents', 'categoryCounts'));
      }

        //////////////ADD FORM //////////////////
      public function add()
      {
          $categories = Category::get();
  
          return view('products.form', ['categories' => $categories]);
      }

    //////////////SAVE LKG//////////////////
    public function saveLKG(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'grade' => 'required',
            'dob' => 'required',
            'language' => 'required',
            'fathers_name' => 'required',
            'fathers_qualification' => 'required',
            'fathers_contact_details' => 'required',
            'fathers_occupation' => 'required',
            'mothers_name' => 'required',
            'mothers_qualification' => 'required',
            'mothers_contact_details' => 'required',
            'mothers_occupation' => 'required',
            'payment_details' => 'required',
            'address' => 'required',
            'student_image' => 'nullable',
            'sibling_details' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_name = '';


        $student = new Products();

        if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student_Photos'), $file_name);
        } else {
            $file_name = null;
        }


        $student->student_image = $file_name;
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->gender = $request->input('gender');
        $student->dob = $request->input('dob');
        $student->academic_year = $request->input('academic_year');
        $student->grade = $request->input('grade');
        $student->language = $request->input('language');
        $student->sibling_details = $request->input('sibling_details');
        $student->fathers_name = $request->input('fathers_name');
        $student->fathers_qualification = $request->input('fathers_qualification');
        $student->fathers_email_details = $request->input('fathers_email_details');
        $student->fathers_contact_details = $request->input('fathers_contact_details');
        $student->fathers_occupation = $request->input('fathers_occupation');
        $student->mothers_name = $request->input('mothers_name');
        $student->mothers_qualification = $request->input('mothers_qualification');
        $student->mothers_email_details = $request->input('mothers_email_details');
        $student->mothers_contact_details = $request->input('mothers_contact_details');
        $student->mothers_occupation = $request->input('mothers_occupation');
        $student->address = $request->input('address');
        $student->payment_details = $request->input('payment_details');
        $student->category = 'lkg';
        $student->save();
    }

    //////////////SAVE UKG//////////////////

    public function saveUKG(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'grade' => 'required',
            'dob' => 'required',
            'language' => 'required',
            'fathers_name' => 'required',
            'fathers_qualification' => 'required',
            'fathers_contact_details' => 'required',
            'fathers_occupation' => 'required',
            'mothers_name' => 'required',
            'mothers_qualification' => 'required',
            'mothers_contact_details' => 'required',
            'mothers_occupation' => 'required',
            'payment_details' => 'required',
            'address' => 'required',
            'student_image' => 'nullable',
            'sibling_details' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_name = '';


        $student = new Products();

        if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student_Photos'), $file_name);
        } else {
            $file_name = null;
        }


        $student->student_image = $file_name;
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->gender = $request->input('gender');
        $student->dob = $request->input('dob');
        $student->academic_year = $request->input('academic_year');
        $student->grade = $request->input('grade');
        $student->language = $request->input('language');
        $student->sibling_details = $request->input('sibling_details');
        $student->fathers_name = $request->input('fathers_name');
        $student->fathers_qualification = $request->input('fathers_qualification');
        $student->fathers_email_details = $request->input('fathers_email_details');
        $student->fathers_contact_details = $request->input('fathers_contact_details');
        $student->fathers_occupation = $request->input('fathers_occupation');
        $student->mothers_name = $request->input('mothers_name');
        $student->mothers_qualification = $request->input('mothers_qualification');
        $student->mothers_email_details = $request->input('mothers_email_details');
        $student->mothers_contact_details = $request->input('mothers_contact_details');
        $student->mothers_occupation = $request->input('mothers_occupation');
        $student->address = $request->input('address');
        $student->payment_details = $request->input('payment_details');
        $student->category = 'ukg';
        $student->save();

    }

    //////////////SAVE NURSERY//////////////////

    public function saveNursery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'grade' => 'required',
            'language' => 'required',
            'fathers_name' => 'required',
            'fathers_qualification' => 'required',
            'fathers_contact_details' => 'required',
            'fathers_occupation' => 'required',
            'mothers_name' => 'required',
            'mothers_qualification' => 'required',
            'mothers_contact_details' => 'required',
            'mothers_occupation' => 'required',
            'payment_details' => 'required',
            'address' => 'required',
            'student_image' => 'nullable',
            'sibling_details' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_name = '';


        $student = new Products();

        if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student_Photos'), $file_name);
        } else {
            $file_name = null;
        }

        $student->student_image = $file_name;
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->gender = $request->input('gender');
        $student->dob = $request->input('dob');
        $student->academic_year = $request->input('academic_year');
        $student->grade = $request->input('grade');
        $student->language = $request->input('language');
        $student->sibling_details = $request->input('sibling_details');
        $student->fathers_name = $request->input('fathers_name');
        $student->fathers_qualification = $request->input('fathers_qualification');
        $student->fathers_email_details = $request->input('fathers_email_details');
        $student->fathers_contact_details = $request->input('fathers_contact_details');
        $student->fathers_occupation = $request->input('fathers_occupation');
        $student->mothers_name = $request->input('mothers_name');
        $student->mothers_qualification = $request->input('mothers_qualification');
        $student->mothers_email_details = $request->input('mothers_email_details');
        $student->mothers_contact_details = $request->input('mothers_contact_details');
        $student->mothers_occupation = $request->input('mothers_occupation');
        $student->address = $request->input('address');
        $student->payment_details = $request->input('payment_details');
        $student->category = 'nursery';
        $student->save();
    }


    //////////////EDIT FORM//////////////////
    public function edit($id, Request $request)
    {
        $product = Products::find($id);

        if ($request->input('category') == 'ukg') {
            return view('products.ukg_student', ['product' => $product]);
        } elseif ($request->input('category') == 'lkg') {
            return view('products.lkg_student', ['product' => $product]);
        } elseif ($request->input('category') == 'nursery') {
            return view('products.nursery_student', ['product' => $product]);
        }

    }


    //////////////UPDATE FORM//////////////////

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'grade' => 'required',
            'language' => 'required',
            'fathers_name' => 'required',
            'fathers_qualification' => 'required',
            'fathers_contact_details' => 'required',
            'fathers_occupation' => 'required',
            'mothers_name' => 'required',
            'mothers_qualification' => 'required',
            'mothers_contact_details' => 'required',
            'mothers_occupation' => 'required',
            'payment_details' => 'required',
            'student_image' => 'nullable',
            'address' => 'required',
            'sibling_details' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Products::find($id);

        if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student_Photos'), $file_name);
            $student->student_image = $file_name;
        }

        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->gender = $request->input('gender');
        $student->dob = $request->input('dob');
        $student->academic_year = $request->input('academic_year');
        $student->grade = $request->input('grade');
        $student->language = $request->input('language');
        $student->sibling_details = $request->input('sibling_details');
        $student->fathers_name = $request->input('fathers_name');
        $student->fathers_qualification = $request->input('fathers_qualification');
        $student->fathers_email_details = $request->input('fathers_email_details');
        $student->fathers_contact_details = $request->input('fathers_contact_details');
        $student->fathers_occupation = $request->input('fathers_occupation');
        $student->mothers_name = $request->input('mothers_name');
        $student->mothers_qualification = $request->input('mothers_qualification');
        $student->mothers_email_details = $request->input('mothers_email_details');
        $student->mothers_contact_details = $request->input('mothers_contact_details');
        $student->mothers_occupation = $request->input('mothers_occupation');
        $student->address = $request->input('address');
        $student->payment_details = $request->input('payment_details');
        $student->category = 'lkg';

        $student->save();
        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    //////////////DELETE FORM//////////////////
    public function delete($id)
    {
        Products::find($id)->delete();

        return redirect()->route('products');
    }

    //////////////SEARCH DATA//////////////////
    public function search(Request $request)
    {
        $studentName = $request->input('student_name');
        $category = $request->input('category');
        $academicYear = $request->input('academic_year');

        $query = Products::query();

        if (!empty($studentName)) {
            $query->where(function ($q) use ($studentName) {
                $q->where('first_name', 'like', "%$studentName%")
                    ->orWhere('last_name', 'like', "%$studentName%");
            });
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if (!empty($academicYear)) {
            $query->where('academic_year', $academicYear);
        }

        $data = $query->paginate(2);

        if ($data->isEmpty()) {
            $noDataFoundMessage = 'No matching results found';
        } else {
            $noDataFoundMessage = null;
        }

        // Rest of your code

        return view('products.index', compact('data', 'noDataFoundMessage'));
    }




    //////////////EXPORT TO EXCEL//////////////////
    public function export(Request $request)
    {
        $studentName = $request->input('student_name');
        $category = $request->input('category');
        $academicYear = $request->input('academic_year');

        return Excel::download(new StudentExport($studentName, $category, $academicYear), 'students_registrations.xlsx');
    }



    //////////////EXPORT TO PDF//////////////////
    public function exportPDF(Request $request)
    {

        $studentName = $request->input('student_name');
        $category = $request->input('category');
        $academicYear = $request->input('academic_year');

        $query = Products::select(
            'first_name',
            'last_name',
            'dob',
            'gender',
            'academic_year',
            'category'
        );

        if (!empty($studentName)) {
            $student_name = $studentName;
            $query->where(function ($q) use ($student_name) {
                $q->where('first_name', 'like', "%$student_name%")
                    ->orWhere('last_name', 'like', "%$student_name%");
            });
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if (!empty($academicYear)) {
            $query->where('academic_year', $academicYear);
        }

        $data = $query->get();

        $pdf = PDF::loadView('products.export-pdf', compact('data'));

        return $pdf->download('student_registration.pdf');

    }


    //////////////////View Nursery FORM//////////////
    public function viewNurseryForm(Request $request)
    {
        return view('products.nursery_student');
    }

    //////////////////View LKG FORM//////////////
    public function viewLKGForm(Request $request)
    {
        return view('products.lkg_student');
    }

    //////////////////View UKG Form//////////////
    public function viewUKGForm(Request $request)
    {
        return view('products.ukg_student');
    }
}