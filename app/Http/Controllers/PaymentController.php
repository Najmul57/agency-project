<?php

namespace App\Http\Controllers;

use App\Models\PaymentGuideline;
use App\Models\PaymentReceipt;
use App\Models\Payfees;
use PDF;
use App\Models\StudenHelp;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function paymentPage()
    {
        $help = StudenHelp::first();
        $paymentGuideline = PaymentGuideline::first();
        return view('user.payment.page', compact('help', 'paymentGuideline'));
    } // end method

    public function receiptupload(Request $request)
    {
        $request->validate([
            'receipt' => 'required|file|max:2048',
        ]);

        $data = new PaymentReceipt();

        $data->user_id = Auth::user()->id;

        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/payment/paymentreceipt'), $filename);
            $data->receipt = $filename;
        }
        $data->save();

        $notification = [
            'message' => 'Receipt uploaded successfully.',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function downloadPayment($id)
    {
        $payment = Payfees::findOrFail($id);
        $grand_total = is_null($payment->display_amount) || $payment->display_amount === '' ? $payment->grand_total : $payment->display_amount;
        $payment->grand_total = $grand_total;

        $pdf = PDF::loadView('user.payments.receipt', compact('payment'));

        return $pdf->download('payment_receipt_' . $payment->receipt_id);
    }

    public function adminpaymentreceipt()
    {
        $data = PaymentReceipt::latest()->get();
        return view('admin.payment.receipt', compact('data'));
    } // end method

    public function toggleStatus($id)
    {
        $paymentReceipt = PaymentReceipt::find($id);
        $paymentReceipt->status = $paymentReceipt->status == 1 ? 0 : 1;
        $paymentReceipt->save();

        $notification = [
            'message' => $paymentReceipt->status == 1 ? 'Payment Approved Success!' : 'Payment Inapproved Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function receiptdownload($id)
    {
        $data = PaymentReceipt::find($id);

        if ($data && $data->receipt) {
            $filePath = public_path('upload/payment/paymentreceipt/' . $data->receipt);
            if (file_exists($filePath)) {
                return response()->download($filePath, $data->receipt);
            } else {
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'Receipt file not found',
                        'alert-type' => 'error',
                    ]);
            }
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Invalid receipt ID',
                    'alert-type' => 'error',
                ]);
        }
    }

    public function receiptdelete()
    {
        $data = PaymentReceipt::find(request()->id);

        $filePath = public_path('upload/payment/paymentreceipt/' . $data->receipt);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $data->delete();

        return redirect()
            ->route('admin.payment.receipt')
            ->with(['message' => 'Payment Receipt deleted successfully', 'alert-type' => 'success']);
    }

    public function download($id)
    {
        $payment = Payfees::findOrFail($id);
        $pdf = PDF::loadView('admin.payment.receipt', compact('payment'));
        return $pdf->download('payment_receipt_' . $payment->receipt_id . '.pdf');
    }
}
