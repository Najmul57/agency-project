<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ExpensiveController;
use App\Http\Controllers\Admin\FacilitiesController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\NocController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProgramTypeController;
use App\Http\Controllers\Admin\ReferranceController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServicesConttroller;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SuccessCountController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UniversityAditionalController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Frontend\AboutpageController;
use App\Http\Controllers\Frontend\BlogpageController;
use App\Http\Controllers\Frontend\ContactpageController;
use App\Http\Controllers\Frontend\CountrypageController;
use App\Http\Controllers\Frontend\CoursepageController;
use App\Http\Controllers\Frontend\FeedbackPageController;
use App\Http\Controllers\Frontend\FeepageController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\GallerypageController;
use App\Http\Controllers\Frontend\ServicepageController;
use App\Http\Controllers\Frontend\UniversitypageController;
use App\Http\Controllers\LetterVerificationController;
use App\Http\Controllers\Partner\PartnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\User\PrimiumStudentController;
use App\Http\Controllers\User\StudentFeedbackController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\VisaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//payment verify pdf
Route::get('payment-verify/{id}/{token}', [FrontendController::class, 'paymentPdf'])->name('payment.pdf');

//noc verify pdf
Route::get('noc-verify/{id}/{token}.pdf', [FrontendController::class, 'nocVerifyPdf'])->name('noc.veriry.pdf');

Route::get('/clear-cache-all', function () {
    Artisan::call('cache:clear');
    return redirect()
        ->back()
        ->with('notification', [
            'message' => 'Cache Clear Success!',
            'alert-type' => 'success',
        ]);
});

// routes/web.php
Route::get('payments', [FrontendController::class, 'listPdfs'])->name('payment.list');
Route::get('payment/verify/{filename}', [FrontendController::class, 'servePdf'])->name('payment.serve');

//portner
Route::post('partner/register', [PartnerController::class, 'partnerRegister'])->name('partner.register');

Route::fallback(function () {
    return view('errors.404');
});

//admin controller
Route::group(['prefix' => 'partner', 'middleware' => ['partner', 'auth'], 'namespace' => 'Partner'], function () {
    Route::get('dashboard', [PartnerController::class, 'index'])->name('partner.dashboard');
    Route::post('/partnerlogout', [PartnerController::class, 'partnerLogout'])->name('partner.logout');
    Route::get('profile', [PartnerController::class, 'profile'])->name('partner.profile');
    Route::post('profile/store', [PartnerController::class, 'profileStore'])->name('partner.profile.store');

    //password change
    Route::get('password/change', [PartnerController::class, 'passwordchange'])->name('partner.password.change');
    Route::post('password/update', [PartnerController::class, 'passwordupdate'])->name('partner.password.update');

    Route::fallback(function () {
        return view('partner.errors.404');
    });

    //payment
    Route::get('payment', [PartnerController::class, 'partnerpaymen'])->name('partner.payment');
    Route::get('payment/student/{id}', [PartnerController::class, 'partnerpaymensingle'])->name('partner.payment.single');
    Route::get('payment/list', [PartnerController::class, 'partnerpaymenlist'])->name('partner.payment.list');

    //university
    Route::get('university-details', [PartnerController::class, 'universityDetails'])->name('partner.university.detils');
    Route::post('partner/fetch-university', [PartnerController::class, 'partnerFetchUniversity'])->name('partner.fetchUniversity');
    Route::post('partner/fetch-program', [PartnerController::class, 'partnerFetchProgram'])->name('partner.fetchProgram');
    Route::post('partner/fetch-department', [PartnerController::class, 'partnerFetchDepartment'])->name('partner.fetchDepartment');
    Route::post('partner/fetch-university-course', [PartnerController::class, 'partnerFetchUniversityCourse'])->name('partner.fetchUniversityCourse');
    Route::post('partner/fetch-content-course', [PartnerController::class, 'partnerFetchUniversityContent'])->name('partner.fetchUniversityContent');

    //ticket
    Route::group(['prefix' => 'ticket'], function () {
        Route::get('/form', [PartnerController::class, 'ticketform'])->name('partner.ticket.form');
        Route::post('/store', [PartnerController::class, 'ticketstore'])->name('partner.ticket.store');
    });

    // letter
    Route::get('offerletter', [PartnerController::class, 'offerletter'])->name('partner.offerletter');
    Route::get('anotherletter', [PartnerController::class, 'anatherletter'])->name('partner.anatherletter');
    Route::get('admissionletter', [PartnerController::class, 'admissionletter'])->name('partner.admissionletter');
    Route::get('visapermissionletter', [PartnerController::class, 'visapermissionletter'])->name('partner.visa.permission.letter');

    //upload visa copy
    Route::get('upload/visa/copy', [PartnerController::class, 'uploadvisacopy'])->name('upload.visa.copy');
    Route::post('upload/visa/copy/store', [PartnerController::class, 'uploadvisacopystore'])->name('upload.visa.copy.store');

    //referrance
    Route::get('referrance', [PartnerController::class, 'partnerReferance'])->name('partner.referance');

    Route::group(['prefix' => 'referrance'], function () {
        Route::post('/form', [PartnerController::class, 'referanceform'])->name('partner.referance.form');
        Route::get('/{id}', [PartnerController::class, 'partnerReferrance'])->name('partner.referrance');
        Route::get('receipt-download/{id}', [PartnerController::class, 'partnerReceiptDownload'])->name('partner.receipt.download');
        Route::get('admission/letter/download/{id}', [PartnerController::class, 'admissionletterdownloadpartner'])->name('partner.admissionletter.download');

        Route::get('offerletter/download/{id}', [PartnerController::class, 'partnerOfferLettterDownload'])->name('partner.offerletter.download');

        Route::get('anatherletter/download/{id}', [PartnerController::class, 'partneranatherletterDownload'])->name('partner.anatherletter.download');

        Route::get('visa/permission/letter/download/{id}', [PartnerController::class, 'partnerVisaPermissionLetterDownload'])->name('partner.visa.permission.letter.download');

        Route::get('another/letter/download/{id}', [PartnerController::class, 'partnerAnotherLetterDownload'])->name('partner.anotherletter.download');

        Route::post('report/store', [ReferranceController::class, 'reportstore'])->name('report.store');

        //upload payment receipt
        Route::post('student/payment/receipt/upload', [PartnerController::class, 'paymentreceiptuploadPartnetStudent'])->name('paymentreceipt.partnetStudent');
    });

    //travel guideline
    Route::get('travel-guideline', [PartnerController::class, 'travelGuideline'])->name('partner.travel.guideline');
    Route::get('travel-guideline/{id}', [PartnerController::class, 'singleTravel'])->name('partner.travel.single');

    //refund
    Route::get('refund-policy', [PartnerController::class, 'partnerrefund'])->name('partner.refund');

    //feedback
    Route::get('feedback', [PartnerController::class, 'feedback'])->name('partner.feedback');
    Route::post('feedback/store/{id}', [PartnerController::class, 'store'])->name('partner.store.feedback');
});

//coupon add
Route::get('/coupon-get', [FrontendController::class, 'coupon_get'])->name('coupon.get');

// web.php

Route::get('get-universities/{countryId}', [FrontendController::class, 'getUniversitiesByCountry'])->name('get-universitiesStd');
Route::get('get-programtypes/{universityId}', [FrontendController::class, 'getProgramTypesByUniversity'])->name('get-programtypeStd');
Route::get('get-courses/{programTypeId}', [FrontendController::class, 'getCoursesByProgramType'])->name('get-coursesStd');
Route::get('get-university-courses/{courseId}', [FrontendController::class, 'getUniversityCoursesByCourse'])->name('get-unicoursesStd');

//frontend controler
Route::get('/', [FrontendController::class, 'index']);
Route::get('/search', [FrontendController::class, 'search'])->name('search');

// frontend  register
Route::get('/get-universitiesReg/{country}', [FrontendController::class, 'getUniversitiesReg'])->name('get-universitiesReg');
Route::get('/get-program-typeReg/{university}', [FrontendController::class, 'getProgramTypeReg'])->name('get-programtypeReg');
Route::get('/get-coursesReg/{programTypeId}', [FrontendController::class, 'getCoursesReg'])->name('get-coursesReg');
Route::get('/get-unicoursesReg/{courseId}', [FrontendController::class, 'getUniCoursesReg'])->name('get-unicoursesReg');

//contact page
Route::get('/contact', [ContactpageController::class, 'contactpage'])->name('contact.page');
Route::post('/contact/store', [ContactpageController::class, 'contactstore'])->name('contact.store');

//feedback page
Route::get('/student-feedback', [FeedbackPageController::class, 'feedbackpage'])->name('feedback.page');

//university page
Route::get('university', [UniversitypageController::class, 'universitypage'])->name('university.page');
Route::get('university/{slug}', [UniversitypageController::class, 'universitydetails'])->name('universitydetails.page');
Route::get('university/{slug}', [FrontendController::class, 'universitydetails'])->name('universitydetails.page');

//service page
Route::get('service', [ServicepageController::class, 'servicepage'])->name('service.page');
Route::get('service/{slug}', [ServicepageController::class, 'servicedetails'])->name('servicedetails.page');
Route::get('service/{slug}', [FrontendController::class, 'servicedetails'])->name('servicedetails.page');

// course wise university
Route::get('course-university/{slug}', [FrontendController::class, 'couseUniversity'])->name('course.university');

//country page
Route::get('country', [CountrypageController::class, 'countrypage'])->name('country.page');
Route::get('country/{slug}', [CountrypageController::class, 'countrydetails'])->name('countrydetails.page');
Route::get('country/{slug}', [FrontendController::class, 'countrydetails'])->name('countrydetails.page');

Route::get('pay-fees', [FeepageController::class, 'payfees'])->name('payfees.page');
Route::post('pay-fees/store', [FeepageController::class, 'store'])->name('payfees.store');
Route::get('about', [AboutpageController::class, 'about'])->name('about.page');

//blog page
Route::get('blog', [BlogpageController::class, 'blog'])->name('blog.page');
Route::get('blog/{slug}', [BlogpageController::class, 'blogdetails'])->name('blogdetails.page');
Route::get('blog/{slug}', [FrontendController::class, 'blogdetails'])->name('blogdetails.page');

Route::get('gallery', [GallerypageController::class, 'gallery'])->name('gallery.page');

//course page
Route::get('course', [CoursepageController::class, 'course'])->name('course.page');

// page
Route::get('page/{page_slug}', [FrontendController::class, 'page'])->name('view.page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

//admin controller
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'namespace' => 'Admin'], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::fallback(function () {
        return view('admin.errors.404');
    });

    // expensive
    Route::group(['prefix' => 'cashbook'], function () {
        Route::get('/', [ExpensiveController::class, 'index'])->name('admin.expensive');
        Route::get('/create', [ExpensiveController::class, 'create'])->name('create.expensive');
        Route::get('/show', [ExpensiveController::class, 'show'])->name('show.expensive');
        Route::post('/store', [ExpensiveController::class, 'store'])->name('store.expensive');
        Route::get('/edit/{id}', [ExpensiveController::class, 'edit'])->name('edit.expensive');
        Route::post('/update/{id}', [ExpensiveController::class, 'update'])->name('update.expensive');
        Route::get('/destroy/{id}', [ExpensiveController::class, 'destroy'])->name('destroy.expensive');
    });

    //programTypeInsert conroller
    Route::group(['prefix' => 'program-type-insert'], function () {
        Route::get('/', [UniversityAditionalController::class, 'index'])->name('programTypeInser.index');
        Route::get('/create', [UniversityAditionalController::class, 'create'])->name('programTypeInser.create');
        Route::post('/store', [UniversityAditionalController::class, 'store'])->name('programTypeInser.store');
        Route::get('/edit/{id}', [UniversityAditionalController::class, 'edit'])->name('programTypeInser.edit');
        Route::post('/update/{id}', [UniversityAditionalController::class, 'update'])->name('programTypeInser.update');
        Route::get('/destroy/{id}', [UniversityAditionalController::class, 'destroy'])->name('programTypeInser.destroy');
    });

    //department list conroller
    Route::group(['prefix' => 'departmentlist'], function () {
        Route::get('/', [UniversityAditionalController::class, 'list'])->name('departmentlist.index');
        Route::get('/create', [UniversityAditionalController::class, 'add'])->name('departmentlist.create');
        Route::post('/store', [UniversityAditionalController::class, 'departmentstore'])->name('departmentlist.store');
        Route::get('/edit/{id}', [UniversityAditionalController::class, 'departmentedit'])->name('departmentlist.edit');
        Route::post('/update/{id}', [UniversityAditionalController::class, 'departmentupdate'])->name('departmentlist.update');
        Route::get('/delete/{id}', [UniversityAditionalController::class, 'delete'])->name('departmentlist.delete');
    });

    //course list conroller
    Route::group(['prefix' => 'courselist'], function () {
        Route::get('/', [UniversityAditionalController::class, 'courselist'])->name('courselist.index');
        Route::get('/create', [UniversityAditionalController::class, 'courseadd'])->name('courselist.create');
        Route::post('/store', [UniversityAditionalController::class, 'coursestore'])->name('courselist.store');
        Route::get('/edit/{id}', [UniversityAditionalController::class, 'courseedit'])->name('courselist.edit');
        Route::post('/update/{id}', [UniversityAditionalController::class, 'courseupdate'])->name('courselist.update');
        Route::get('/delete/{id}', [UniversityAditionalController::class, 'coursedelete'])->name('courselist.delete');
    });

    //coupon
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('admin.coupon');
        Route::get('/create', [CouponController::class, 'create'])->name('create.coupon');
        Route::post('/store', [CouponController::class, 'store'])->name('store.coupon');
        Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('edit.coupon');
        Route::post('/update/{id}', [CouponController::class, 'update'])->name('update.coupon');
        Route::get('/destroy/{id}', [CouponController::class, 'destroy'])->name('destroy.coupon');

        Route::get('/active/{id}', [CouponController::class, 'active'])->name('coupon.active');
        Route::get('/inactive/{id}', [CouponController::class, 'inactive'])->name('coupon.inactive');
    });

    //student update
    Route::get('student-list', [StudentController::class, 'studentlistadmin'])->name('student.list.admin');
    Route::get('add-student', [StudentController::class, 'addstudentadmin'])->name('student.add.admin');

    Route::get('/student/status/{id}', [StudentController::class, 'toggleStatus'])->name('student.toggle');

    Route::get('delete-student/{id}', [StudentController::class, 'deletestudentadmin'])->name('student.delete.admin');


    Route::post('store-student-admin', [StudentController::class, 'storestudentadmin'])->name('store.student.admin');

    Route::get('free-student', [StudentController::class, 'freestudentlistadmin'])->name('free.student.list.admin');
    Route::get('free-student-active/{id}', [StudentController::class, 'freestudentactiveadmin'])->name('free.student.active.admin');

    Route::get('student-list-admin/{id}', [StudentController::class, 'singlestudentadmin'])->name('single.student.admin');
    Route::post('student-update/admin/{id}', [StudentController::class, 'studentupdateadmin'])->name('student.update.admin');

    //welcome video
    Route::get('welcome-video', [AdminController::class, 'welcomeVideo'])->name('welcome.video');
    Route::post('welcome-video/update/{id}', [AdminController::class, 'welcomeVideoUpdate'])->name('welcome.video.update');

    //refund
    Route::get('refund', [RefundController::class, 'refund'])->name('admin.refund');
    Route::post('refund-update/{id}', [RefundController::class, 'refundupdate'])->name('admin.refund.update');

    //notice
    Route::get('notice', [NoticeController::class, 'notice'])->name('admin.notice');
    Route::post('notice/update/{id}', [NoticeController::class, 'noticeupdate'])->name('admin.notice.update');

    //student help
    Route::get('student/help', [AdminController::class, 'studenthelp'])->name('student.help');
    Route::post('student/help/update/{id}', [AdminController::class, 'studenthelpcreateupdate'])->name('student.help.create.update');

    //letter guideline
    Route::get('letter/guideline', [AdminController::class, 'letterGuideline'])->name('letter.guideline');
    Route::post('letter/guideline/update/{id}', [AdminController::class, 'letterGuidelineUpdate'])->name('letter.guideline.update');

    // offer letter
    Route::get('offerletter', [LetterController::class, 'adminofferletter'])->name('admin.offer.letter');
    Route::post('offer/letter/store', [LetterController::class, 'adminofferletterstore'])->name('admin.offer.letter.store');
    Route::get('offer/letter/download/{id}', [LetterController::class, 'offerletterdownloadadmin'])->name('admin.offerletter.download');
    Route::get('offer/letter/delete/{id}', [LetterController::class, 'offerletterdeleteadmin'])->name('admin.offerletter.delete');

    // admission letter
    Route::get('admissionletter', [LetterController::class, 'adminadmissionletter'])->name('admin.admission.letter');
    Route::post('admission/letter/store', [LetterController::class, 'adminadmissionletterstore'])->name('admin.admission.letter.store');
    Route::get('admission/letter/download/{id}', [LetterController::class, 'admissionletterdownloadadmin'])->name('admin.admissionletter.download');
    Route::get('admission/letter/delete/{id}', [LetterController::class, 'admissionletterdeleteadmin'])->name('admin.admissionletter.delete');

    // admission invoice update
    Route::get('admissioninvoice', [LetterController::class, 'adminadmissioninvoice'])->name('admin.admission.invoice');
    Route::post('admission/invoice/store', [LetterController::class, 'adminadmissioninvoicestore'])->name('admin.admission.invoice.store');
    Route::get('admission/invoice/download/{id}', [LetterController::class, 'admissioninvoicedownloadadmin'])->name('admin.admissioninvoice.download');
    Route::get('admission/invoice/delete/{id}', [LetterController::class, 'admissioninvoicedeleteadmin'])->name('admin.admissioninvoice.delete');

    // admission letter generate
    Route::get('admission/letter/generate', [LetterController::class, 'adminadmissionlettergenerate'])->name('admin.admission.letter.generate');

    Route::post('admission/letter/generate/store', [LetterController::class, 'adminadmissionlettergeneratestore'])->name('admin.admission.letter.generate.store');

    Route::get('admission/letter/generate/delete/{id}', [LetterController::class, 'adminadmissionlettergeneratedelete'])->name('admin.admission.letter.generate.delete');

    // visa letter
    Route::get('/visaletter', [LetterController::class, 'adminvisaletter'])->name('admin.visa.letter');
    Route::post('/visa/letter/store', [LetterController::class, 'adminvisaletterstore'])->name('admin.visa.letter.store');
    Route::get('/visa/letter/download/{id}', [LetterController::class, 'visaletterdownloadadmin'])->name('admin.visaletter.download');
    Route::get('/visa/letter/delete/{id}', [LetterController::class, 'visaletterdeleteadmin'])->name('admin.visaletter.delete');

    // another letter
    Route::get('anotherletter', [LetterController::class, 'adminanotherletter'])->name('admin.another.letter');
    Route::post('another/letter/store', [LetterController::class, 'adminanotherletterstore'])->name('admin.another.letter.store');
    Route::get('another/letter/download/{id}', [LetterController::class, 'anotherletterdownloadadmin'])->name('admin.anotherletter.download');
    Route::get('another/letter/delete/{id}', [LetterController::class, 'anotherletterdeleteadmin'])->name('admin.anotherletter.delete');

    //payment guideline
    Route::get('payment/guideline', [AdminController::class, 'paymentGuideline'])->name('payment.guideline');
    Route::post('payment/guideline/update/{id}', [AdminController::class, 'paymentGuidelineUpdate'])->name('payment.guideline.update');
    Route::get('payfees/list', [AdminController::class, 'payfeeslist'])->name('admin.payfees.list');

    Route::get('/invoiceactive/{id}', [AdminController::class, 'invoiceactive'])->name('admin.invoice.active');
    Route::get('/invoiceinactive/{id}', [AdminController::class, 'invoiceinactive'])->name('admin.invoice.inactive');

    Route::get('payfees/list/{id}/download', [AdminController::class, 'payfeesdownload'])->name('admin.payfees.download');
    Route::get('payfees/list/{id}/destroy', [AdminController::class, 'payfeesdestroy'])->name('admin.payfees.destroy');

    Route::get('payment-receipt', [PaymentController::class, 'adminpaymentreceipt'])->name('admin.payment.receipt');

    Route::get('/toggle/{id}', [PaymentController::class, 'toggleStatus'])->name('admin.payment.toggle');

    Route::get('payment-receipt-download/{id}', [PaymentController::class, 'receiptdownload'])->name('admin.paymentreceipt.download');
    Route::get('payment-receipt-delete/{id}', [PaymentController::class, 'receiptdelete'])->name('admin.paymentreceipt.delete');

    //noc guideline
    Route::get('noc/guideline', [AdminController::class, 'nocGuideline'])->name('noc.guideline');
    Route::post('noc/guideline/update/{id}', [AdminController::class, 'nocGuidelineUpdate'])->name('noc.guideline.update');

    //upload pdf for spefic student
    Route::prefix('noc')->group(function () {
        Route::get('/pdf', [NocController::class, 'nocpdf'])->name('noc.pdf');
        Route::post('/pdf/store', [NocController::class, 'nocpdfstore'])->name('noc.pdf.store');
        Route::get('/pdf/destroy/{id}', [NocController::class, 'nocpdfdestroy'])->name('noc.pdf.destroy');
    });

    //noc list
    Route::get('noc-list', [NocController::class, 'nocList'])->name('noc.list');
    Route::get('noc-form-list', [NocController::class, 'nocFormList'])->name('noc.form.list');
    Route::get('noc-form-single/{id}', [NocController::class, 'nocFormsingle'])->name('noc.form.single');
    Route::get('noc-form-single-download/pdf/{id}', [NocController::class, 'downloadPDF'])->name('noc.form.single.pdf');

    Route::get('/nocactive/{id}', [NocController::class, 'nocactive'])->name('admin.noc.active');
    Route::get('/nocinactive/{id}', [NocController::class, 'nocinactive'])->name('admin.noc.inactive');

    Route::get('download-nocfile/{filename}', [NocController::class, 'downloadNocFile'])->name('download.nocfile');
    Route::get('upload-noc-all-student', [NocController::class, 'uploadNocAllStudent'])->name('upload.noc.all.student');
    Route::post('upload-noc-all-student-upload', [NocController::class, 'uploadNocAllStudentUpload'])->name('upload.noc.all.student.upload');
    Route::get('noc-destroy/{id}', [NocController::class, 'nocDestroyStudent'])->name('noc.destroy.student.destroy');

    //visa guideline
    Route::get('visa/guideline', [AdminController::class, 'visaGuideline'])->name('visa.guideline');
    Route::get('visa/application/copy', [AdminController::class, 'visaapplication'])->name('visa.application');
    Route::post('visa/guideline/update/{id}', [AdminController::class, 'visaGuidelineUpdate'])->name('visa.guideline.update');
    Route::get('admin/visa/upload', [VisaController::class, 'adminVisaUpload'])->name('admin.visa.upload');
    Route::post('admin/visa/store', [VisaController::class, 'adminVisaStore'])->name('admin.visa.store');
    Route::get('admin/student/visa/download/{id}', [VisaController::class, 'studentvisadownload'])->name('admin.student.visa.download');
    Route::get('admin/student/visa/destroy/{id}', [VisaController::class, 'studentvisadestroy'])->name('admin.student.visa.destroy');

    Route::get('visa-apply-list', [VisaController::class, 'visaapplylist'])->name('visa.apply.list');
    Route::get('visa-apply-single/{id}', [VisaController::class, 'visaapplysingle'])->name('visa.apply.single');
    Route::get('visa-reject-single/{id}', [VisaController::class, 'visarejectsingle'])->name('visa.reject.single');
    Route::get('visa-application-download/{id}', [VisaController::class, 'visaapplicationdownload'])->name('visa.application.download');
    Route::get('visa-application-delete/{id}', [VisaController::class, 'visaapplicationdelete'])->name('visa.application.delete');

    Route::get('visa/copy/list', [VisaController::class, 'visacopylist'])->name('visa.copy.list');
    Route::get('visa-copy-download/{id}', [VisaController::class, 'visacopydownload'])->name('visa.copy.download');
    Route::get('visa-copy-delete/{id}', [VisaController::class, 'visacopydelete'])->name('visa.copy.delete');

    //ticketing guideline
    Route::get('ticketing/guideline', [AdminController::class, 'ticketingGuideline'])->name('ticketing.guideline');
    Route::post('ticketing/guideline/update/{id}', [AdminController::class, 'ticketingGuidelineUpdate'])->name('ticketing.guideline.update');

    Route::group(['prefix' => 'ticket'], function () {
        Route::get('', [TicketController::class, 'adminticket'])->name('admin.ticket');
        Route::post('/store', [TicketController::class, 'adminticketstore'])->name('admin.ticket.store');
        Route::get('/student/download/{id}', [TicketController::class, 'studentticketdownload'])->name('admin.student.ticket.download');
        Route::get('/student/destroy/{id}', [TicketController::class, 'studentticketdestroy'])->name('admin.student.ticket.destroy');

        Route::get('/request/list', [TicketController::class, 'ticketRequestList'])->name('ticket.request.list');
        Route::get('/request/single/{id}', [TicketController::class, 'ticketRequestsingle'])->name('ticket.request.single');
        Route::get('/request/single/destroy/{id}', [TicketController::class, 'ticketRequestdestroy'])->name('ticket.request.destroy');
    });

    // travel guideline
    Route::group(['prefix' => 'travel'], function () {
        Route::get('/guideline', [AdminController::class, 'travelGuideline'])->name('travel.guideline');
        Route::post('/guideline', [AdminController::class, 'travelGuidelineStore'])->name('travel.store');
        Route::get('/guideline/show/{id}', [AdminController::class, 'travelGuidelineShow'])->name('travel.show');
        Route::get('/guideline/destroy/{id}', [AdminController::class, 'travelGuidelineDestroy'])->name('travel.destroy');

        Route::get('/active/{id}', [AdminController::class, 'active'])->name('travel.active');
        Route::get('/inactive/{id}', [AdminController::class, 'inactive'])->name('travel.inactive');
    });

    // ticket status
    Route::get('ticket/status', [AdminController::class, 'ticketstatus'])->name('ticket.status.admin');
    Route::post('ticket/status/store', [AdminController::class, 'ticketstatusstore'])->name('ticket.status.store');
    Route::get('ticket/status/destroy/{id}', [AdminController::class, 'ticketstatusdestroy'])->name('ticket.status.destroy');

    //referance guideline
    Route::get('referance/guideline', [AdminController::class, 'referanceGuideline'])->name('referance.guideline');
    Route::post('referance/guideline/update/{id}', [AdminController::class, 'referanceGuidelineUpdate'])->name('referance.guideline.update');

    Route::get('/paymentreceipt/upload', [ReferranceController::class, 'adminpaymentreceiptUpload'])->name('admin.paymentreceipt.upload');
    Route::post('/paymentreceipt/store', [ReferranceController::class, 'adminpaymentreceiptStore'])->name('admin.paymentreceipt.store');

    //letter verification guideline
    Route::get('letterverificaion/guideline', [AdminController::class, 'verificationGuideline'])->name('letterverificaion.guideline');
    Route::post('letterverificaion/guideline/update/{id}', [AdminController::class, 'verificationGuidelineUpdate'])->name('letterverificaion.guideline.update');
    Route::get('document/verification', [LetterVerificationController::class, 'documentverification'])->name('document.verification');
    Route::get('document/destroy/{id}', [LetterVerificationController::class, 'documentverificationdestroy'])->name('document.verification.destroy');

    Route::get('verify/report/upload', [LetterVerificationController::class, 'reportupload'])->name('report.upload');
    Route::post('admin/report/store', [LetterVerificationController::class, 'adminreportstore'])->name('admin.report.store');
    Route::get('student/report/download/{id}', [LetterVerificationController::class, 'studentreportdownload'])->name('admin.student.report.download');
    Route::get('student/report/destroy/{id}', [LetterVerificationController::class, 'studentreportdestroy'])->name('admin.student.report.destroy');

    Route::get('offer-letter/{id}/{university_id}', [StudentController::class, 'offerletter'])->name('offer.letter');
    Route::get('visa-letter/{id}/{university_id}', [StudentController::class, 'visaletter'])->name('visa.letter');

    Route::get('pickup-letter/{id}/{university_id}', [StudentController::class, 'pickupletter'])->name('pickup.letter');
    Route::get('admission-letter/{id}/{university_id}', [StudentController::class, 'admissionletter'])->name('admission.letter');

    // primium
    Route::group(['prefix' => 'primium'], function () {
        //primium country
        Route::get('/country-list', [PrimiumStudentController::class, 'list'])->name('primium.country.list');
        Route::get('/country-create', [PrimiumStudentController::class, 'create'])->name('primium.country.create');
        Route::post('/country-store', [PrimiumStudentController::class, 'store'])->name('primium.country.store');
        Route::get('/country-edit/{id}', [PrimiumStudentController::class, 'edit'])->name('primium.country.edit');
        Route::post('/country-update/{id}', [PrimiumStudentController::class, 'update'])->name('primium.country.update');
        Route::get('/country-destroy/{id}', [PrimiumStudentController::class, 'destroy'])->name('primium.country.destroy');
        Route::get('/active/{id}', [PrimiumStudentController::class, 'active'])->name('primium.country.active');
        Route::get('/inactive/{id}', [PrimiumStudentController::class, 'inactive'])->name('primium.country.inactive');

        //primium university
        Route::get('/university-list', [PrimiumStudentController::class, 'universitylist'])->name('primium.university.list');
        Route::get('/university-create', [PrimiumStudentController::class, 'universitycreate'])->name('primium.university.create');
        Route::post('/university-store', [PrimiumStudentController::class, 'universitystore'])->name('primium.university.store');
        Route::get('/university-edit/{id}', [PrimiumStudentController::class, 'universityedit'])->name('primium.university.edit');
        Route::post('/university-update/{id}', [PrimiumStudentController::class, 'universityupdate'])->name('primium.university.update');
        Route::get('/university-destroy/{id}', [PrimiumStudentController::class, 'universitydestroy'])->name('primium.university.destroy');
        Route::get('/university/active/{id}', [PrimiumStudentController::class, 'universityactive'])->name('primium.university.active');
        Route::get('/university/inactive/{id}', [PrimiumStudentController::class, 'universityinactive'])->name('primium.university.inactive');

        //primium course
        Route::group(['prefix' => 'department'], function () {
            Route::get('/list', [PrimiumStudentController::class, 'courselist'])->name('primium.course.list');
            Route::get('/create', [PrimiumStudentController::class, 'coursecreate'])->name('primium.course.create');
            Route::post('/store', [PrimiumStudentController::class, 'coursestore'])->name('primium.course.store');
            Route::get('/edit/{id}', [PrimiumStudentController::class, 'courseedit'])->name('primium.course.edit');
            Route::post('/course-update/{id}', [PrimiumStudentController::class, 'courseupdate'])->name('primium.course.update');
            Route::get('/destroy/{id}', [PrimiumStudentController::class, 'coursedestroy'])->name('primium.course.destroy');
            Route::get('/active/{id}', [PrimiumStudentController::class, 'courseactive'])->name('primium.course.active');
            Route::get('/inactive/{id}', [PrimiumStudentController::class, 'courseinactive'])->name('primium.course.inactive');

            Route::get('/get-universities', [PrimiumStudentController::class, 'getUniversities'])->name('get-universities');
            Route::get('/get-program-types', [PrimiumStudentController::class, 'getProgramTypes'])->name('get-program-types');
        });

        //primium university course
        Route::group(['prefix' => 'university'], function () {
            Route::get('/course-list', [PrimiumStudentController::class, 'unicourselist'])->name('primium.unicourse.list');
            Route::get('/course-create', [PrimiumStudentController::class, 'unicoursecreate'])->name('primium.unicourse.create');
            Route::post('/course-store', [PrimiumStudentController::class, 'unicoursestore'])->name('primium.unicourse.store');
            Route::get('/course-edit/{id}', [PrimiumStudentController::class, 'unicourseedit'])->name('primium.unicourse.edit');
            Route::post('/course-update/{id}', [PrimiumStudentController::class, 'unicourseupdate'])->name('primium.unicourse.update');
            Route::get('/course-destroy/{id}', [PrimiumStudentController::class, 'unicoursedestroy'])->name('primium.unicourse.destroy');
            Route::get('/course/active/{id}', [PrimiumStudentController::class, 'unicoursective'])->name('primium.unicourse.active');
            Route::get('/course/inactive/{id}', [PrimiumStudentController::class, 'unicourseinactive'])->name('primium.unicourse.inactive');
            Route::get('/course/show/{id}', [PrimiumStudentController::class, 'unicourseshow'])->name('primium.unicourse.show');

            Route::get('get-universities-najmul', [PrimiumStudentController::class, 'getUniversitiesNajmul'])->name('getUniversitiesNajmul');
            Route::get('get-program-types-najmul', [PrimiumStudentController::class, 'getProgramTypesNajmul'])->name('getProgramTypesNajmul');
            Route::get('get-courses-najmul', [PrimiumStudentController::class, 'getCoursesNajmul'])->name('getCoursesNajmul');
        });

        Route::group(['prefix' => 'university-content'], function () {
            //content
            Route::get('', [PrimiumStudentController::class, 'content'])->name('primium.content.list');
            Route::get('/create', [PrimiumStudentController::class, 'contentcreate'])->name('primium.content.create');
            Route::post('/store', [PrimiumStudentController::class, 'contentstore'])->name('primium.content.store');
            Route::get('/edit/{id}', [PrimiumStudentController::class, 'contentedit'])->name('primium.content.edit');
            Route::get('/show/{id}', [PrimiumStudentController::class, 'contentshow'])->name('primium.content.show');
            Route::post('/update/{id}', [PrimiumStudentController::class, 'contentupdate'])->name('primium.content.update');
            Route::get('/destroy/{id}', [PrimiumStudentController::class, 'contentdestroy'])->name('primium.content.destroy');
            Route::get('/active/{id}', [PrimiumStudentController::class, 'contentactive'])->name('primium.content.active');
            Route::get('/inactive/{id}', [PrimiumStudentController::class, 'contentnactive'])->name('primium.content.inactive');

            Route::get('get-universities-uni-content', [PrimiumStudentController::class, 'getUniversitiesUniContent'])->name('getUniversitiesUniContent');
            Route::get('get-program-types-uni-content', [PrimiumStudentController::class, 'getProgramTypesUniContent'])->name('getProgramTypesUniContent');
            Route::get('get-courses-uni-content', [PrimiumStudentController::class, 'getCoursesUniContent'])->name('getCoursesUniContent');
            Route::get('get-university-courses-uni-content', [PrimiumStudentController::class, 'getUniversityCoursesUniContent'])->name('getUniversityCoursesUniContent');
        });
    });

    //program type
    Route::group(['prefix' => 'program-type'], function () {
        Route::get('', [ProgramTypeController::class, 'programType'])->name('program.type');
        Route::get('create', [ProgramTypeController::class, 'create'])->name('program.type.create');
        Route::post('store', [ProgramTypeController::class, 'store'])->name('program.type.store');
        Route::get('edit/{id}', [ProgramTypeController::class, 'edit'])->name('program.type.edit');
        Route::post('update/{id}', [ProgramTypeController::class, 'update'])->name('program.type.update');
        Route::get('delete/{id}', [ProgramTypeController::class, 'delete'])->name('program.type.delete');

        Route::get('/get-universities', [ProgramTypeController::class, 'getUniversities'])->name('get-universities');
    });

    Route::get('fetch-courses', [StudentController::class, 'fetchCourses'])->name('fetch.courses');

    Route::get('active/{id}', [StudentController::class, 'active'])->name('feedback.active');
    Route::get('inactive/{id}', [StudentController::class, 'inactive'])->name('feedback.inactive');

    //feedback
    Route::get('feedback', [StudentController::class, 'feedback'])->name('feedback');
    Route::get('destroy/{id}', [StudentController::class, 'destroy'])->name('feedback.destroy');

    //admin profile
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('profile/store', [AdminController::class, 'store'])->name('admin.profile.store');

    //password change
    Route::get('password/change', [AdminController::class, 'passwordchange'])->name('password.change');
    Route::post('password/update', [AdminController::class, 'passwordupdate'])->name('password.update');

    //admin logout
    Route::get('/adminlogout', [AdminController::class, 'adminLogout'])->name('admin.logout');

    //team
    Route::group(['prefix' => 'team'], function () {
        Route::get('/', [TeamController::class, 'index'])->name('admiin.team');
        Route::get('/create', [TeamController::class, 'create'])->name('admin.team.create');
        Route::post('/store', [TeamController::class, 'store'])->name('admin.team.store');
        Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('admin.team.edit');
        Route::post('/update/{id}', [TeamController::class, 'update'])->name('admin.team.update');
        Route::get('/destroy/{id}', [TeamController::class, 'destroy'])->name('admin.team.destroy');
    });

    //contact message
    Route::get('/contact/message', [AdminController::class, 'contactmessage'])->name('contact.message');
    Route::get('/contact/message/delete/{id}', [AdminController::class, 'contactmessagedelete'])->name('contact.message.delete');

    //setting
    Route::group(['prefix' => 'setting'], function () {
        //seo
        Route::group(['prefix' => 'seo'], function () {
            Route::get('/', [SettingController::class, 'seo'])->name('seo.setting');
            Route::post('/update/{id}', [SettingController::class, 'seoSetting'])->name('seo.setting.update');
        });
        //about
        Route::group(['prefix' => 'about'], function () {
            Route::get('/', [SettingController::class, 'about'])->name('about.setting');
            Route::post('/update/{id}', [SettingController::class, 'aboutSetting'])->name('about.setting.update');
        });
        //smtp
        Route::group(['prefix' => 'smtp'], function () {
            Route::get('/', [SettingController::class, 'smtp'])->name('smtp.setting');
            Route::post('/update/{id}', [SettingController::class, 'smtpSetting'])->name('smtp.setting.update');
        });
        //page create
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', [PageController::class, 'page'])->name('page.index');
            Route::get('/create', [PageController::class, 'create'])->name('page.create');
            Route::post('/store', [PageController::class, 'store'])->name('page.store');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
            Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
            Route::get('/destroy/{id}', [PageController::class, 'destroy'])->name('page.destroy');
        });
        //page create
        Route::group(['prefix' => 'setting'], function () {
            Route::get('/', [SettingController::class, 'setting'])->name('website.setting');
            Route::post('/update/{id}', [SettingController::class, 'updatesetting'])->name('page.setting.update');
        });
    });

    // permission
    Route::get('all/permission', [RoleController::class, 'allPermission'])->name('all.permission');
    Route::get('add/permission', [RoleController::class, 'addPermission'])->name('add.permission');
    Route::post('store/permission', [RoleController::class, 'storePermission'])->name('store.permission');
    Route::get('edit/permission/{id}', [RoleController::class, 'editPermission'])->name('edit.permission');
    Route::post('update/permission/{id}', [RoleController::class, 'updatePermission'])->name('update.permission');
    Route::get('destroy/permission/{id}', [RoleController::class, 'destroyPermission'])->name('destroy.permission');
    Route::get('destroy/permission/{id}', [RoleController::class, 'destroyPermission'])->name('destroy.permission');

    // roles
    Route::get('all/roles', [RoleController::class, 'allRoles'])->name('all.roles');
    Route::get('add/roles', [RoleController::class, 'addRoles'])->name('add.roles');
    Route::post('store/roles', [RoleController::class, 'storeRoles'])->name('store.roles');
    Route::get('edit/roles/{id}', [RoleController::class, 'editRoles'])->name('edit.roles');
    Route::post('update/roles/{id}', [RoleController::class, 'updateRoles'])->name('update.roles');
    Route::get('destroy/roles/{id}', [RoleController::class, 'destroyRoles'])->name('destroy.roles');

    //role permission
    Route::get('add/role/permission', [RoleController::class, 'addRolesPermission'])->name('add.roles.permission');
    Route::post('/role/permission/store', [RoleController::class, 'storeRolesPermission'])->name('roles.permission.store');
    Route::get('/all/role/permission/', [RoleController::class, 'allRolesPermission'])->name('all.roles.permission');
    Route::get('/edit/role/permission/{id}', [RoleController::class, 'editRolesPermission'])->name('edit.roles.permission');
    Route::post('roles/permission/update/{id}', [RoleController::class, 'updateRolesPermission'])->name('roles.permission.update');
    Route::get('/delete/role/permission/{id}', [RoleController::class, 'deleteRolesPermission'])->name('delete.roles.permission');

    //partner
    Route::get('partners/', [AdminController::class, 'partner'])->name('admin.partner');
    Route::get('delete-partner/{id}', [PartnerController::class, 'deletepartneradmin'])->name('partner.delete.admin');

    Route::get('/partner/status/{id}', [PartnerController::class, 'toggleStatus'])->name('partner.toggle');

    //admin manage
    Route::get('/all', [AdminController::class, 'allAdmin'])->name('all.admin');
    Route::get('/add', [AdminController::class, 'addAdmin'])->name('add.admin');
    Route::post('/store', [AdminController::class, 'storeAdmin'])->name('store.admin');
    Route::get('/edit/{id}', [AdminController::class, 'editAdmin'])->name('edit.admin');
    Route::post('/update/{id}', [AdminController::class, 'updateAdmin'])->name('update.admin');
    Route::get('delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    //slider controller
    Route::group(['prefix' => 'slider'], function () {
        Route::get('/', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('update/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::get('/destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

        Route::get('active/{id}', [SliderController::class, 'active'])->name('slider.active');
        Route::get('inactive/{id}', [SliderController::class, 'inactive'])->name('slider.inactive');
    });
    //success count controller
    Route::group(['prefix' => 'success-count'], function () {
        Route::get('/', [SuccessCountController::class, 'index'])->name('success.index');
        Route::get('/create', [SuccessCountController::class, 'create'])->name('success.create');
        Route::post('/store', [SuccessCountController::class, 'store'])->name('success.store');
        Route::get('/edit/{id}', [SuccessCountController::class, 'edit'])->name('success.edit');
        Route::post('update/{id}', [SuccessCountController::class, 'update'])->name('success.update');
        Route::get('/destroy/{id}', [SuccessCountController::class, 'destroy'])->name('success.destroy');

        Route::get('active/{id}', [SuccessCountController::class, 'active'])->name('success.active');
        Route::get('inactive/{id}', [SuccessCountController::class, 'inactive'])->name('success.inactive');
    });
    //service controller
    Route::group(['prefix' => 'services'], function () {
        Route::get('/', [ServicesConttroller::class, 'index'])->name('service.index');
        Route::get('/create', [ServicesConttroller::class, 'create'])->name('service.create');
        Route::post('/store', [ServicesConttroller::class, 'store'])->name('service.store');
        Route::get('/edit/{id}', [ServicesConttroller::class, 'edit'])->name('service.edit');
        Route::post('update/{id}', [ServicesConttroller::class, 'update'])->name('service.update');
        Route::get('/destroy/{id}', [ServicesConttroller::class, 'destroy'])->name('service.destroy');

        Route::get('active/{id}', [ServicesConttroller::class, 'active'])->name('service.active');
        Route::get('inactive/{id}', [ServicesConttroller::class, 'inactive'])->name('service.inactive');
    });

    //Blog controller
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::post('update/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::get('/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

        Route::get('active/{id}', [BlogController::class, 'active'])->name('blog.active');
        Route::get('inactive/{id}', [BlogController::class, 'inactive'])->name('blog.inactive');
    });
    //gallery controller
    Route::group(['prefix' => 'gallery'], function () {
        Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/store', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::post('update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::get('/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

        Route::get('active/{id}', [GalleryController::class, 'active'])->name('gallery.active');
        Route::get('inactive/{id}', [GalleryController::class, 'inactive'])->name('gallery.inactive');
    });
    //facilites controller
    Route::group(['prefix' => 'facilities'], function () {
        Route::get('/', [FacilitiesController::class, 'index'])->name('facilities.index');
        Route::get('/create', [FacilitiesController::class, 'create'])->name('facilities.create');
        Route::post('/store', [FacilitiesController::class, 'store'])->name('facilities.store');
        Route::get('/edit/{id}', [FacilitiesController::class, 'edit'])->name('facilities.edit');
        Route::post('update/{id}', [FacilitiesController::class, 'update'])->name('facilities.update');
        Route::get('/destroy/{id}', [FacilitiesController::class, 'destroy'])->name('facilities.destroy');

        Route::get('active/{id}', [FacilitiesController::class, 'active'])->name('facilities.active');
        Route::get('inactive/{id}', [FacilitiesController::class, 'inactive'])->name('facilities.inactive');
    });
});

//user controller
Route::group(['prefix' => 'student', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');

    //primium subscribe
    Route::post('primium-subscribe', [UserController::class, 'primiumsubscribe'])->name('user.primium.subscribe');

    Route::fallback(function () {
        return view('user.errors.404');
    });

    //primium student
    Route::get('primium-university-details', [PrimiumStudentController::class, 'primiumUniversityDetails'])->name('primium.university.detils');

    //update details for student
    Route::get('/get-user-universities/{country}', [UserController::class, 'getUserUniversities'])->name('get-user-universities');
    Route::get('/get-user-courses/{course}', [UserController::class, 'getUserCourses'])->name('get-user-courses');
    Route::get('/get-user-unicourses/{unicourses}', [UserController::class, 'getUserUniCourses'])->name('get-user-unicourses');

    //refund
    Route::get('refund-policy', [RefundController::class, 'userrefund'])->name('user.refund');

    // update details
    Route::get('update/details', [UserController::class, 'updateDetails'])->name('update.details');
    Route::post('update/details/update', [UserController::class, 'updateDetailsUpdate'])->name('update.details.update');

    //payment
    Route::get('payment-page', [PaymentController::class, 'paymentPage'])->name('payment.page');
    Route::get('/payments/{id}/download', [PaymentController::class, 'downloadPayment'])->name('payments.download');
    Route::post('recept-upload', [PaymentController::class, 'receiptupload'])->name('receipt.upload');

    Route::post('recept/upload/referance', [ReferranceController::class, 'receiptUploadReferance'])->name('receipt.upload.referance');

    //noc
    Route::get('noc-form-single-download/pdf/{id}', [NocController::class, 'downloadPDFStudent'])->name('noc.form.single.pdf.student');

    //letter
    Route::get('letter-page', [LetterController::class, 'letterPAge'])->name('letter.page');
    Route::get('offerletter/download/{id}', [LetterController::class, 'offerlettterdownloaduser'])->name('student.offerletter.download');
    Route::get('admissionletter/download/{id}', [LetterController::class, 'admissionlettterdownloaduser'])->name('student.admissionletter.download');
    Route::get('anotherletter/download/{id}', [LetterController::class, 'anotherletterdownloaduser'])->name('student.anotherletter.download');
    Route::get('visaletter/download/{id}', [LetterController::class, 'visalettterdownloaduser'])->name('student.visaletter.download');
    // visalettterdownloaduser

    //noc
    Route::get('noc-page', [NocController::class, 'nocPage'])->name('noc.page');
    Route::post('noc-form-submit', [NocController::class, 'nocFormSubmit'])->name('noc.form.submit');
    Route::post('noc-upload', [NocController::class, 'nocupload'])->name('noc.upload');
    Route::get('student-noc-download', [NocController::class, 'usernocdownload'])->name('student.noc.download');
    Route::get('noc-download', [NocController::class, 'nocdownload'])->name('noc.download');

    Route::get('/get-noc-universities/{country}', [NocController::class, 'getNocUniversities'])->name('get-noc-universities');
    Route::get('/get-noc-courses/{course}', [NocController::class, 'getNocCourses'])->name('get-noc-courses');
    Route::get('/get-noc-unicourses/{unicourses}', [NocController::class, 'getNocUniCourses'])->name('get-noc-unicourses');

    //visa
    Route::get('visa-page', [VisaController::class, 'visaPage'])->name('visa.page');
    Route::post('visa-store', [VisaController::class, 'visastore'])->name('visa.store');
    Route::post('visa-file-upload', [VisaController::class, 'visafileupload'])->name('visa.file.upload');
    Route::post('visa-application-upload', [VisaController::class, 'visaapplicationupload'])->name('visa.application.upload');
    Route::get('/student/visa/download/{id}', [VisaController::class, 'studentvisadownloaduser'])->name('student.visa.download.user');

    //ticket
    Route::get('ticket-page', [TicketController::class, 'ticketPage'])->name('ticket.page');
    Route::post('ticket-form-submit', [TicketController::class, 'ticketformsubmit'])->name('ticket.form.submit');
    Route::get('ticket-status', [TicketController::class, 'ticketstatus'])->name('ticket.status');
    Route::get('travel-page', [TicketController::class, 'travelPage'])->name('travel.page');
    Route::get('admin/ticket/download/{id}', [TicketController::class, 'ticketdownload'])->name('admin.ticket.download');

    //referrance
    Route::group(['prefix' => 'referrance'], function () {
        Route::get('/page', [ReferranceController::class, 'referrancePage'])->name('referrance.page');
        Route::post('/form', [ReferranceController::class, 'referanceform'])->name('referance.form');
        Route::get('/single/{id}', [ReferranceController::class, 'referrancesingle'])->name('referrance.single');

        Route::post('report/store', [ReferranceController::class, 'reportstore'])->name('report.store');
        Route::get('receipt-download/{id}', [ReferranceController::class, 'receiptDownload'])->name('receipt.download');
    });

    //letter verification
    Route::get('letter-verification-page', [LetterVerificationController::class, 'letterverificationPage'])->name('letterverification.page');
    Route::post('letter-verification-store', [LetterVerificationController::class, 'letterverificationstore'])->name('letter.verificatin.store');
    Route::get('/report/download/{id}', [LetterVerificationController::class, 'reportdownload'])->name('user.report.download');

    // web.php
    Route::post('/fetchUniCourseDetails', [PrimiumStudentController::class, 'fetchUniCourseDetails'])->name('fetchUniCourseDetails');

    Route::post('primium/fetch-university', [PrimiumStudentController::class, 'fetchUniversity'])->name('fetchUniversity');

    Route::post('primium/fetch-program', [ProgramTypeController::class, 'fetchProgram'])->name('fetchProgram');

    Route::post('primium/fetch-department', [PrimiumStudentController::class, 'fetchDepartment'])->name('fetchDepartment');

    Route::post('primium/fetch-university-course', [PrimiumStudentController::class, 'fetchUniversityCourse'])->name('fetchUniversityCourse');

    Route::post('primium/fetch-content-course', [PrimiumStudentController::class, 'fetchUniversityContent'])->name('fetchUniversityContent');

    //primium student payment store
    Route::post('primium/student', [PrimiumStudentController::class, 'primiumStudent'])->name('primium.student');

    //password change
    Route::get('password/change', [UserController::class, 'passwordchange'])->name('user.password.change');
    Route::post('password/update', [UserController::class, 'passwordupdate'])->name('user.password.update');

    //profile
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('profile/store', [UserController::class, 'profileStore'])->name('user.profile.store');

    //feedback
    Route::get('feedback', [StudentFeedbackController::class, 'feedback'])->name('student.feedback');
    Route::post('feedback/store/{id}', [StudentFeedbackController::class, 'store'])->name('store.feedback');

    //information
    Route::get('information', [UserController::class, 'student_information'])->name('student.information');

    //travel
    Route::get('travel', [UserController::class, 'travel'])->name('user.travel');

    //ticket
    Route::get('ticket', [UserController::class, 'ticket'])->name('user.ticket');
});
