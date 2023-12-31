<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\Brand;
use App\User;
use Auth;
use App\ProductsImport;
use App\ProductsExport;
use PDF;
use Excel;
use Illuminate\Support\Str;
use MPDF;

class ProductBulkUploadController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == 'seller') {
            return view('frontend.seller.product_bulk_upload.index');
        } elseif (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('bulk_upload.index');
        }
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function pdf_download_category()
    {
        $categories = Category::where('published', true)->get();
        // $pdf = PDF::setOptions([
        //                 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
        //                 'logOutputFile' => storage_path('logs/log.htm'),
        //                 'tempDir' => storage_path('logs/')
        //             ])->loadView('downloads.category', compact('categories'));
        $pdf = MPDF::loadView('downloads.category', compact('categories'));
        return $pdf->download('category.pdf');
    }

    public function pdf_download_sub_category()
    {
        $sub_categories = Subcategory::all();
        // $pdf = PDF::setOptions([
        //                 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
        //                 'logOutputFile' => storage_path('logs/log.htm'),
        //                 'tempDir' => storage_path('logs/')
        //             ])->loadView('downloads.sub_category', compact('sub_categories'));
        $pdf = MPDF::loadView('downloads.sub_category', compact('sub_categories'));
        return $pdf->download('sub_category.pdf');
    }

    public function pdf_download_sub_sub_category()
    {
        $sub_sub_categories = SubSubCategory::all();
        // $pdf = PDF::setOptions([
        //                 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
        //                 'logOutputFile' => storage_path('logs/log.htm'),
        //                 'tempDir' => storage_path('logs/')
        //             ])->loadView('downloads.sub_sub_category', compact('sub_sub_categories'));
        $pdf = MPDF::loadView('downloads.sub_sub_category', compact('sub_sub_categories'));
        return $pdf->download('sub_sub_category.pdf');
    }

    public function pdf_download_brand()
    {
        $brands = Brand::all();
        // $pdf = PDF::setOptions([
        //                 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
        //                 'logOutputFile' => storage_path('logs/log.htm'),
        //                 'tempDir' => storage_path('logs/')
        //             ])->loadView('downloads.brand', compact('brands'));
        $pdf = MPDF::loadView('downloads.brand', compact('brands'));
        return $pdf->download('brands.pdf');
    }

    public function pdf_download_seller()
    {
        $users = User::where('user_type', 'seller')->get();
        // $pdf = PDF::setOptions([
        //                 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
        //                 'logOutputFile' => storage_path('logs/log.htm'),
        //                 'tempDir' => storage_path('logs/')
        //             ])->loadView('downloads.user', compact('users'));
        $pdf = MPDF::loadView('downloads.user', compact('users'));
        return $pdf->download('user.pdf');
    }

    public function bulk_upload(Request $request)
    {
        if ($request->hasFile('bulk_file')) {
            Excel::import(new ProductsImport, request()->file('bulk_file'));
        }
        $products = Product::where('xls_categories', '!=', null)->get();
        foreach ($products as $key => $product) {
            $product->subsubcategoryMany()->sync(explode(',', $product->xls_categories));
            $product->xls_categories = null;
            $product->save();
        }
        flash(translate('Products exported successfully'))->success();
        return back();
    }
}
