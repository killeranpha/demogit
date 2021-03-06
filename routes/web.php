<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/manhinhthemmoi', function () {
    // lấy toàn bộ dữ liệu trong một table
    $userArr = DB::table("users")->get();

    // Lấy dòng đầu tiên của dữ liệu
    $user = DB::table("users")->first();

    // Lấy có where
    $userArr = DB::table("users")
        ->where("email", "=", "nguyen3297@gmail.com")
        ->where("id", "=", 1)
        ->get();
    // phần điều kiện <,>,<>,=,like,@@

    // Lấy một dữ liệu theo cột (thường dùng khi cần lấy cấu hình, check quyền)
    $name = DB::table("users")
        ->where("email", "=", "nguyen3297@gmail.com")
        ->where("id", "=", 1)
        ->value("name");

    // Lấy dữ liệu theo id
    $user = DB::table("users")
        ->find(1);

    // Lấy một mảng theo cột
    $userIdArr = DB::table("users")
        ->pluck("id");

    // Lấy một mảng theo cột có key & value, để đổ vào combobox
    $userIdNameArr = DB::table("users")
        ->pluck("name", "id"); // value, key

    //dd($userIdNameArr);

    //$userIdNameArr[1] => in tên

    // bổ sung 2 cột chucdanhid, phongbanid cho bảng user.
    // Viết màn hình cập nhật user (phân vào chức danh và phòng ban)
    
    // Đếm số lượng record
    $countUser = DB::table("users")->where("id",1)->count();
    
    // Group by và các hàm tính toán
    $max = DB::table("migrations")->sum("batch");
    $max = DB::table("migrations")->avg("batch");
    $max = DB::table("migrations")->max("batch");

    // Kiểm tra tồn tại
    $exists = DB::table("migrations")->where("batch",4)->exists();
    $exists = DB::table("migrations")->where("batch",4)->doesntExist();

    echo $exists?"tồn tại":"không tồn tại";exit;

    return view("manhinhthemmoi", ["aa" => "bbb"]);
})->name("manhinhthemmoi");

// Tạo bảng đơn hàng gồm (id,tên hàng, số lượng, 
// đơn giá, thành tiền, ngày bán)
// viết chức năng in danh sách theo ngày
// viết chức năng in ra số tiền bán trong ngày, 
// số đơn hàng bán trong ngày

Route::get('/user/list', function () {
    $phongban = DB::table("phongban")->pluck("ten", "id");
    $chucdanh = DB::table("chucdanh")->pluck("ten", "id");
    $user = DB::table("users")->get();
    return view("listuser",
        compact([
            "phongban"
            , "chucdanh"
            , "user",
        ])
    );
})->name("user.list");

Route::get('/user/edit/{id}', function ($id) {
    $phongban = DB::table("phongban")->pluck("ten", "id");
    $chucdanh = DB::table("chucdanh")->pluck("ten", "id");
    $user = DB::table("users")->find($id);
    return view("edituser",
        [
            "phongban" => $phongban
            , "chucdanh" => $chucdanh
            , "user" => $user,
        ]
    );
})->name("user.edit");

Route::post('/user/save', function ($request) {

})->name("user.save");

Route::get('/khongcoquyen', function () {
    echo "Không có quyền";
})->name("khongcoquyen");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Bổ sung entity nhomnguoidung, nguoidung_nhom,nhom_chucnang
// Một người dùng thuộc nhiều nhóm
// Một nhóm có nhiều chức năng
// Kiểm tra quyền: gồm quyền ở bảng nguoidungchucnang và nhom_chucnang
