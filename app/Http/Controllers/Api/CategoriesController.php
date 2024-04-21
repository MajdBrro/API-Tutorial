<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait as TraitsGeneralTrait;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
class CategoriesController extends Controller
{
    use GeneralTrait;

################################################################################################
    public function index(){
        // $categories=Category::get();
        $categories=Category::select('id','name_'.app()->getLocale())->get();
        return response()->json($categories);
    }
################################################################################################
public function getCategoryById(Request $request)
{

    $category = Category::find($request->id);

    if(!$category){

        return $this->returnError('001', 'هذا القسم غير موجد');

    }elseif($category){

        return $this->returnData('categroy', $category,'القسم موجود');

    }

}
################################################################################################
public function changeStatus(Request $request)
{

    /////////// طريقتي أنا   /////////////

    $category = Category::find($request->id);

    if(!$category){
        return $this->returnError('001', 'هذا القسم غير موجد');
    }elseif($category){

        $category->update([
            'active' => $category -> active == 1 ? "0" : "1",
        ]);
        $category -> save();
        return $this->returnData('categroy', $category,'تم تغيير حالة القسم');
    }
    /////////// طريقتي أنا   /////////////
/////////////////////////////////////////////////////////////
    /////////// طريقة الاستاذ /////////////
    // $category = Category::find($request->id);

    // if(!$category){
    //     return $this->returnError('001', 'هذا القسم غير موجد');
    // }elseif($category){

    //     $category->update([
    //         'active' => $request -> status,
    //     ]);
    //     $category -> save();
    //     return $this->returnData('categroy', $category,'تم تغيير حالة القسم');
    // }
    /////////// طريقة الاستاذ /////////////

    }



################################################################################################
public function cat(){
    return view('fruits');
}

################################################################################################
public function htmll(){
    return view('welcomeeee');
}
################################################################################################
}
