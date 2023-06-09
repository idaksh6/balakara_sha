<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use PDF;
use PhpParser\Node\Expr\Print_;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::paginate(2);

        return view('products.index', ['data' => $products]);
    }

    public function add()
    {
        $categories = Category::get();

        return view('products.form', ['categories' => $categories]);
    }

    public function saveLKG(Request $request)
    {


    

        $validator = Validator::make($request->all(), [
            'first_name'=>'required',  
            'last_name'=>'required',  
            'gender'=>'required', 
            'student_image'=>'nullable',
            'sibling_details'=>'nullable' 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_name='';


        $student = new Products();  

         if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student_Photos'), $file_name);
        } else {
            $file_name = null; 
         }

        //  $tab = $request->input('tab');

        //  print_R($tab); exit();

        // print_R($request->input('first_name')); exit();
         

        $student->student_image =  $file_name;  
        $student->first_name =  $request->input('first_name');  
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


        $student->category =  'lkg';


        $student->save();  

        // Determine the current tab
        // $tab = $request->input('tab');

        // // Redirect back to the current view with the active tab
        // return redirect()->route('products.form', ['tab' => $tab]);
   
    }

    public function edit($id,Request $request)
    {
        $product = Products::find($id);

        //print_R($request->input('category')); exit();

        if($request->input('category') == 'ukg') {
            return view('products.ukg_student', ['product' => $product]);
        } elseif($request->input('category') == 'lkg') {
            return view('products.lkg_student', ['product' => $product]);
        } elseif($request->input('category') == 'nursery') {
            return view('products.nursery_student', ['product' => $product]);
        }
       
    }

    public function update($id, Request $request)
{
    
   


    $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'gender' => 'required',
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

    return redirect('products')->with('success', 'Student updated successfully.');
}

    public function delete($id)
    {
        Products::find($id)->delete();

        return redirect()->route('products');
    }

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
        
        $data = $query->paginate(1);

        if ($data->isEmpty()) {
            $noDataFoundMessage = 'No matching results found';
        } else {
                $noDataFoundMessage = null;
        }
        
        // Rest of your code
        
        return view('products.index', compact('data','noDataFoundMessage'));
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
    public function exportPDF(Request $request) {

        $studentName = $request->input('student_name');
        $category = $request->input('category');
        $academicYear = $request->input('academic_year');

        $query = Products::select('first_name','last_name');
        
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
            $query->where('academic_year',  $academicYear);
        }
        
        $data = $query->get();

        $pdf = PDF::loadView('products.export-pdf', compact('data'));

        return $pdf->download('student_registration.pdf');

    }



    public function viewNurseryForm(Request $request){
        return view('products.nursery_student');
    }


    public function viewLKGForm(Request $request){
        return view('products.lkg_student');
    }


    public function viewUKGForm(Request $request){
        return view('products.ukg_student');
    }


    public function saveUKG(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'first_name'=>'required',  
            'last_name'=>'required',  
            'gender'=>'required',  
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_name='';


        $student = new Products();  

         if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student_Photos'), $file_name);
        } else {
            $file_name = null; 
         }

        //  $tab = $request->input('tab');

        //  print_R($tab); exit();

        // print_R($request->input('first_name')); exit();
         

        $student->student_image =  $file_name;  
        $student->first_name =  $request->input('first_name');  
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

        // Determine the current tab
        // $tab = $request->input('tab');

        // // Redirect back to the current view with the active tab
        // return redirect()->route('products.form', ['tab' => $tab]);
   
    }



    public function saveNursery(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'first_name'=>'required',  
            'last_name'=>'required',  
            'gender'=>'required',  
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_name='';


        $student = new Products();  

         if ($request->hasFile('student_image')) {
            $file = $request->file('student_image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('student_Photos'), $file_name);
        } else {
            $file_name = null; 
         }

        //  $tab = $request->input('tab');

        //  print_R($tab); exit();

        // print_R($request->input('first_name')); exit();
         

        $student->student_image =  $file_name;  
        $student->first_name =  $request->input('first_name');  
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

        // Determine the current tab
        // $tab = $request->input('tab');

        // // Redirect back to the current view with the active tab
        // return redirect()->route('products.form', ['tab' => $tab]);
   
    }


    

}
 
