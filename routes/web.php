<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{  DoctorController, PatientController, BedController, BedgroupController, 
    ClinicalchartController, DepartmentController,SubdepartmentController, UnitinfoController, 
    InvestigationController, LabreportchartController, LabreportController, BarcodeprintController, 
    InvoiceController, InvoicelistController, DiagnosticreportController, DataController, AutocompleteController,
    DiagnosticreportviewController, DuecollectionController, InvoicereturnController, OccupationController, 
    FloorController, Bedgroup, MedicinegenericController, MedicinegroupController, MedicineunitController, 
    MedicinecompanyinfoController, MedicineinformationController, CustomertypeController, VendortypeController, 
    CustomerController, VendorController, UserController, CustomerinformationController, RoleController, 
    PermissionController, AssignedRoleController, RolePermissionsController, MedicinePurchaseOrderController,
    MedicinePurchaseController };

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('main');
})->name('dashboard');

Route::resource('doctors',                          DoctorController::Class);
Route::resource('patients',                         PatientController::Class);
Route::resource('beds',                             BedController::Class);
Route::resource('departments',                      DepartmentController::Class);
Route::resource('clinicalcharts',                   ClinicalchartController::Class);
Route::resource('subdepartments',                   SubdepartmentController::Class);
Route::resource('unitinfos',                        UnitinfoController::Class);
Route::resource('investigations',                   InvestigationController::Class);
Route::resource('labreportcharts',                  LabreportchartController::Class);
Route::resource('labreports',                       LabreportController::Class);
Route::resource('invoicelists',                     InvoicelistController::Class);
Route::resource('invoices',                         InvoiceController::Class);
Route::resource('barcodeprints',                    BarcodeprintController::Class);
Route::resource('diagnosticreports',                DiagnosticreportController::Class);
Route::resource('diagnosticreportviews',            DiagnosticreportviewController::Class);
Route::resource('datas',                            DataController::Class);
Route::resource('duecollections',                   DuecollectionController::Class);
Route::resource('invoicereturns',                   InvoicereturnController::Class);
Route::resource('occupations',                      OccupationController::Class);
Route::resource('floors',                           FloorController::Class);
Route::resource('bedgroups',                        BedgroupController::Class);
Route::resource('medicinegenerics',                 MedicinegenericController::Class);
Route::resource('medicinegroups',                   MedicinegroupController::Class);
Route::resource('medicineunits',                    MedicineunitController::Class);
Route::resource('medicinecompanyinfos',             MedicinecompanyinfoController::Class);
Route::resource('medicineinformations',             MedicineinformationController::Class);
Route::resource('customertypes',                    CustomertypeController::Class);
Route::resource('vendortypes',                      VendortypeController::Class);
Route::resource('customers',                        CustomerController::Class);
Route::resource('vendors',                          VendorController::Class);
Route::resource('users',                            UserController::Class);
Route::resource('roles',                            RoleController::Class);
Route::resource('permissions',                      PermissionController::Class);
Route::resource('medicinepurchaseorders',           MedicinePurchaseOrderController::Class);
Route::resource('medicinepurchases',                MedicinePurchaseController::Class);

Route::post('investigtionnew',                      [AutocompleteController::Class, 'investigtionnew']);
Route::post('isempty',                              [AutocompleteController::Class, 'isempty']);
Route::post('doctord',                              [AutocompleteController::Class, 'doctord']);
Route::post('investigationdata',                    [AutocompleteController::Class, 'investigationdata']);
Route::post('patient',                              [AutocompleteController::Class, 'patient']);
Route::post('investigtion',                         [AutocompleteController::Class, 'investigtion']);
Route::post('subdeplist',                           [DataController::Class, 'subdeplist']);
Route::post('invoicelistswithdate',                 [InvoicelistController::Class, 'invoicelistswithdate']);
Route::post('add_user_role',                        [AssignedRoleController::Class, 'add_user_role']);
Route::post('submit_role_permission',               [RolePermissionsController::CLass, 'submit_role_permission']);

Route::get('shownoid',                              [UserController::Class, 'shownoid']);
Route::get('permission/{id}/user_role',             [AssignedRoleController::Class, 'submit_user_role']);
Route::get('role_permission',                       [RolePermissionsController::Class, 'role_permission_display']);
Route::get('user_role_display',                     [AssignedRoleController::Class, 'user_role_display']);





