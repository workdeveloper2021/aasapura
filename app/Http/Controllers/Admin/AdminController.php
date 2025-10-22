<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Enquiries;
use App\Models\District;
use App\Models\VendorEnquiry;
use App\Models\Sitesetting;
use App\Models\ProductElement;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use DataTables;


class AdminController extends Controller
{


    public function categories(){
        $categories = Category::where('parent_category',0)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    public function advancedsetting(){
        $data = Sitesetting::where('id',4)->first();
        $offer = Sitesetting::where('id',5)->first();
        return view('admin.advanced_setting',compact('data','offer'));
    }

    public function viewsubcategories($id){
        $row = Category::where('id',$id)->first();

        $categories = Category::where('parent_category',$id)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories.viewsubcategories',compact('categories','row'));
    }

    public function addcategory(Request $request){
        if ($request->method() == "POST") {

            $validated = $request->validate([
                'parent_category' => 'required',
                'category_name' => 'required',
                'image' => ['required','image','mimes:jpeg,png,jpg,webp'],
            ]);

            $category = new Category;
            $category->name = $request->category_name;
            $category->parent_category = $request->parent_category;
            $category->image = uploadImage($request->image,$category);
            $category->save();
            return redirect()->route('categories')->with('success','Category Created Successfully');

        }else{
            return view('admin.categories.add');
        }
    }
    public function editcategory(Request $request, $id){
        $row = Category::find($id);
        if ($request->method() == "POST") {
            $validated = $request->validate([
                'parent_category' => 'required',
                'category_name' => 'required',
                'image' => ['image','mimes:jpeg,png,jpg,webp', 'max:2048'],
            ]);

            $row->name = $request->category_name;
            $row->parent_category = $request->parent_category;
            if ($request->image) {
            $row->image = updateImage($request->image,$row);

        }
            $row->save();
            return redirect()->route('categories')->with('success','Category Updated Successfully');
        }
        return view('admin.categories.edit',compact('row'));
    }


    // --users management

    public function viewusers(){
        $users = User::where('role','user')->orderBy('id','desc')->paginate(20);
        return view('admin.users.index',compact('users'));
    }

    public function viewproviders(){
        $users = User::where('role','provider')->orderBy('id','desc')->paginate(20);
        return view('admin.users.viewproviders',compact('users'));
    }

    public function viewvendors(){
        $users = User::where('role','vendor')->orderBy('id','desc')->paginate(20);
        return view('admin.users.viewvendors',compact('users'));
    }

    public function auditors(){
        $users = User::where('role','auditor')->orderBy('id','desc')->paginate(20);
        return view('admin.users.auditors',compact('users'));
    }

    public function user_full_view($userid){
        $row = User::find($userid);
        if (isset($row)) {
            return view('admin.users.user_full_view',compact('row'));
        }
        else{
            abort(404);
        }
    }

    public function changeactivestatus($id){
        $user = User::find($id);
        if ($user->is_active == "Y") {
            $user->is_active = "N";
        }else{
            $user->is_active = "Y";
        }
        $user->save();
        return redirect()->back()->with('success','Changed Successfully');
    }

    // enquries
    public function enquries(){
        $enquires = Enquiries::orderBy('id', 'DESC')->paginate(10);
        return view('admin.enquries.index',compact('enquires'));
    }
    public function getenquiry(Request $request){

        $find = Enquiries::find($request->data_key);
        $html = '  <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Name :</p>
                        <p class="mb-0">'.$find->name.'</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Email :</p>
                        <p class="mb-0">'.$find->email.'</p>
                    </div>


                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Phone :</p>
                        <p class="mb-0">'.$find->phone.'</p>
                    </div>


                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Subject :</p>
                        <p class="mb-0">'.$find->subject.'</p>
                    </div>


                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Messgae :</p>
                        <p class="mb-0">'.$find->message.'</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Time :</p>
                        <p class="mb-0">'.$find->created_at.'</p>
                    </div>
                </div>';
                return $html;
    }


    // --c

    public function websetting(Request $request){
        $setting  = Sitesetting::find(1);
        if ($request->method() == "POST") {


            $validated = $request->validate([
                'phone' => 'required|digits:10',
                'email' => 'required|email',
                'address' => 'required',
                'site_title' => 'required',
                'meta_keyword' => 'required',
                'meta_description' => 'required',
                'image' => ['image','mimes:jpeg,png,jpg,webp'],
                'favicon' => ['image','mimes:jpeg,png,jpg,webp'],
            ]);

            $info_1 = [
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ];

            $info_2 = [
                'site_title' => $request->site_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
            ];

            if ($request->image) {
                $setting->image = updateImage($request->image,$setting);
            }

            if ($request->favicon) {
                $setting->favicon = updateImagefavicon($request->favicon,$setting);
            }

            $setting->info_first = json_encode($info_1);
            $setting->info_second = json_encode($info_2);
            $setting->save();
            return redirect()->back()->with('success','Updated Successfully');
        }
        return view('admin/admin/setting',compact('setting'));
    }

        public function updateservicetime(Request $request){
            $validated = $request->validate([
                'time' => 'required|numeric',
            ]);

            $find = Sitesetting::find(4);
            $find->service_time = $request->time;
            $find->save();
            return redirect()->back()->with('success','Successfully Updated');
        }


        public function update_offer(Request $request){
            $validated = $request->validate([
                'offer_7' => 'required|numeric',
                'offer_15' => 'required|numeric',
                'offer_30' => 'required|numeric',
            ]);

            $data = [
                'offer_7' => $request->offer_7,
                'offer_15' => $request->offer_15,
                'offer_30' => $request->offer_30,
            ];


            $find = Sitesetting::findorfail(5);
            $find->info_first = json_encode($data);
            $find->save();
            return redirect()->back()->with('success','Successfully Updated');
        }


    // -district-

    public function viewdistricts($id){
        $state_id = $id;
        $data = District::where('state_id',$id)->paginate(10);
        return view('admin/state/district/index',compact('state_id','data'));
    }

    public function districtscreate(Request $request,$id){
        if ($request->method() == "POST") {

            $validated = $request->validate([
                'name' => 'required',
            ]);
            $district = new District;
            $district->state_id = $id;
            $district->name = $request->name;
            $district->save();
            return redirect('/admin/view-districts/'.$id)->with('success','Created Successfully');
        }else{
            return view('admin/state/district/create');
        }
    }

    public function districtedit(Request $request,$id){
        $row = District::find($id);
        if ($request->method() == "POST") {

            $validated = $request->validate([
                'name' => 'required',
            ]);
            $row->name = $request->name;
            $row->save();
            return redirect('/admin/view-districts/'.$request->state_id)->with('success','Updated Successfully');
        }else{
            return view('admin/state/district/edit',compact('row'));
        }
    }

    // common fields

    public function changestatus($table, $id)
    {
        $dd = DB::table($table)->where('id', $id)->first();
        if ($dd->status == "Y") {
            $new_update = "N";
        } else {
            $new_update = "Y";
        }
        $nn = DB::table($table)->where('id', $id)->update(['status' => $new_update]);
        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function changeblock($table, $id)
    {
        $dd = DB::table($table)->where('id', $id)->first();
        if ($dd->is_block == "Y") {
            $new_update = "N";
        } else {
            $new_update = "Y";
        }
        $nn = DB::table($table)->where('id', $id)->update(['is_block' => $new_update]);
        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function deleterow($table, $id, $image)
    {
        if ($image == "no_image") {} else {
            $image_path = public_path("uploads/" . $image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $table = DB::table($table)->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Successfully Deleted');
    }



    // orders

    public function orders(){
        $results = Booking::
            join('products', 'products.id', '=', 'booking.product_id')
            ->join('users', 'users.id', '=', 'booking.user_id')
            ->select('products.title as product_name','users.name as user_name','booking.*')->orderBy('id','desc')->paginate(20);
            // echo "<pre>";
            // print_r($results);
            // die;
        return view('admin/orders/index',compact('results'));
    }

    public function ordersdata(Request $request){
        $query = Booking::join('products', 'products.id', '=', 'booking.product_id')
        ->join('users', 'users.id', '=', 'booking.user_id')
        ->select([
            'booking.id',
            'products.title as product_name',
            'users.name as user_name',
            'booking.seller_id',
            'booking.check_in',
            'booking.check_out',
            'booking.created_at'
        ]);

    if ($request->from_date && $request->to_date) {
        $query->whereBetween('booking.created_at', [
            $request->from_date . ' 00:00:00',
            $request->to_date . ' 23:59:59'
        ]);
    }

    return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('user_link', function ($row) {
            return '<a href="/admin/view-vendor-providers/' . $row->user_id . '">' . $row->user_name . '</a>';
        })
        ->addColumn('seller_link', function ($row) {
            return '<a href="/admin/view-vendor-providers/' . $row->seller_id . '">' . view_seller($row->seller_id) . '</a>';
        })
        ->addColumn('order_time', function ($row) {
            return \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i A');
        })
        ->addColumn('action', function ($row) {
            return '<a href="/admin/order-view/' . $row->id . '" class="btn btn-sm btn-success">View</a>';
        })
        ->rawColumns(['user_link', 'seller_link', 'action'])
        ->make(true);
    }

public function orderview($id){
    $row = Booking::find($id);
    if(isset($row)){
     return view('admin/orders/orderview',compact('row'));
    }else{
        return redirect()->back();
    }
}

public function exportOrders($format)
{
    switch ($format) {
        case 'excel':
            return Excel::download(new OrdersExport, 'orders.xlsx');
        
        case 'csv':
            return Excel::download(new OrdersExport, 'orders.csv', \Maatwebsite\Excel\Excel::CSV);
        
        case 'pdf':
            // For PDF, we'll use a different approach with DomPDF
            $results = DB::table('booking')
                ->join('products', 'products.id', '=', 'booking.product_id')
                ->join('users', 'users.id', '=', 'booking.user_id')
                ->select('products.title as product_name', 'users.name as user_name', 'booking.*')
                ->orderBy('booking.id', 'desc')
                ->get();
            
            $pdf = PDF::loadView('admin.orders.pdf_export', compact('results'));
            return $pdf->download('orders.pdf');
            
        default:
            return redirect()->back()->with('error', 'Invalid export format');
    }
}

public function bulkenquries() {
           $enquiries = VendorEnquiry::latest()->paginate(20);
        return view('admin.bulkenquries', compact('enquiries'));
}

public function products_elements() {
    return view('admin.products.elements.elements');
}

public function product_element_list(Request $request) {
    $type = $request->type;
    $elements = ProductElement::where('element_type', $type)->paginate(10);

    $elements->appends(['type' => $type]);

    return view('admin.products.elements.product_element_list', compact('elements', 'type'));
}
public function product_element_create(Request $request) {
    if ($request->isMethod('post')) {
        $validated = $request->validate([
            'element_name' => 'required|string|max:255',
            'element_type' => 'required|string|max:255',
            'options' => 'nullable|string',
        ]);

      ProductElement::create([
        'element_name' => $request->element_name,
        'element_type' => $request->element_type,
        'options' => $request->element_color ?? null,
        ]);

        return redirect('/admin/product-element-list?type=' . $request->element_type)->with('success', 'Product element created successfully.');
    }

    return view('admin.products.elements.create_product_element');
}


public function product_element_edit(Request $request, $id) {
    $element = ProductElement::find($id);
    if (!$element) {
        return redirect()->back()->with('error', 'Product element not found.');
    }

    if ($request->isMethod('post')) {
        $validated = $request->validate([
            'element_name' => 'required|string|max:255',
            'element_type' => 'required|string|max:255',
            'options' => 'nullable|string',
        ]);

      $element->update([
        'element_name' => $request->element_name,
        'element_type' => $request->element_type,
        'options' => $request->element_color ?? null,
        ]);

        return redirect('/admin/product-element-list?type=' . $request->element_type)->with('success', 'Product element Updated successfully.');
    }

    return view('admin.products.elements.edit_product_element', compact('element'));
}

}