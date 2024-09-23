<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Payfees;
use PDF;
use App\Mail\PaymentInvoice;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;
use App\Mail\PaymentNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FeepageController extends Controller
{
    public function payfees()
    {
        return view('frontend.payfees.index');
    } // end method

    public function store(Request $request)
    {
        $data = new Payfees();
        $data->user_id = auth()->user()->id;
        $data->name = $request->name;
        $data->status = 0;

        $data->receipt_id = $this->generateReceiptId($request->number);
        $data->registation_id = $request->registation_id;
        $data->university_name = $request->university_name ?? '';
        $data->email = $request->email;
        $data->number = $request->number;

        if (isset($request->grand_total) && $request->grand_total != 0) {
            $data->grand_total = $request->grand_total;
        } else {
            $data->display_amount = $request->display_amount;
        }

        $data->display_type = $request->display_type;
        $data->payment_method_item = $request->payment_method_item;
        $data->txt_number = $request->txt_number;
        $data->bank_name = $request->bank_name;

        if ($request->hasFile('bank_txt_upload')) {
            $bankTxtFile = $request->file('bank_txt_upload');
            $bankTxtFileName = uniqid() . '_' . $bankTxtFile->getClientOriginalName();
            $bankTxtFile->move(public_path('upload/payment/bank_txt_upload'), $bankTxtFileName);
            $data->bank_txt_upload = $bankTxtFileName;
        }

        if ($request->hasFile('signature')) {
            $signatureFile = $request->file('signature');
            $signatureFileName = uniqid() . '_' . $signatureFile->getClientOriginalName();
            $signatureFile->move(public_path('upload/payment/signature'), $signatureFileName);

            Image::make(public_path('upload/payment/signature') . '/' . $signatureFileName)
                ->resize(200, 80)
                ->save('upload/payment/signature/' . $signatureFileName);

            $data->signature = $signatureFileName;
        }

        $data->save();

        $payment = Payfees::findOrFail($data->id);
        $grand_total = is_null($payment->display_amount) || $payment->display_amount === '' ? $payment->grand_total : $payment->display_amount;
        $payment->grand_total = $grand_total;

        $pdf = PDF::loadView('user.payments.receipt', compact('payment'));

        $pdfPath = 'public/upload/paymentinvoice/payment_receipt_' . $payment->receipt_id . '.pdf';
        Storage::put($pdfPath, $pdf->output());

            return redirect()->back()->with('success', 'Payment receipt generated successfully!',compact('payment'));

    }

    private function generateReceiptId($number)
    {
        $currentDate = \Carbon\Carbon::now()->format('Ymd');
        $lastThreeDigits = substr($number, -3);
        return 'siac' . $currentDate . $lastThreeDigits.'.pdf';
    }
}
