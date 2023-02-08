<?php

namespace Modules\Account\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Traits\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\ChartAccount;
use Illuminate\Contracts\Support\Renderable;
use Modules\Account\Entities\TimePeriodAccount;
use Modules\Account\Repositories\VoucherRepositoryInterface;
use Modules\Account\Repositories\ChartAccountRepositoryInterface;

class VoucherController extends Controller
{
    use Notification;

    protected $voucherRepository;

    public function __construct(VoucherRepositoryInterface $voucherRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->voucherRepository = $voucherRepository;
    }

    public function approval_index()
    {
        $payments = $this->voucherRepository->voucher_list_all();
        return view('account::voucher_approvals.index', [
            "payments" => $payments
        ]);
    }

    public function index()
    {
        $payments = $this->voucherRepository->voucher_payment_all();
        return view('account::voucher_payments.index', [
            "payments" => $payments
        ]);
    }

    public function create(ChartAccountRepositoryInterface $chartAccountsRepository)
    {
        $account_categories = $this->voucherRepository->category();
        $chartAccounts = $chartAccountsRepository->getPaymentAccountList();
        return view('account::voucher_payments.create', [
            "account_categories" => $account_categories,
            "chartAccounts" => $chartAccounts
        ]);
    }

    public function store(Request $request)
    {
        if ($request->date != null && (Carbon::parse($request->date)->format('Y-m-d') < TimePeriodAccount::where('is_closed', 0)->latest()->first()->start_date)) {
            Toastr::error(__('common.Payment Date should be in this accounting period'));
            return back();
        }
        $validate_rules = [
            "date" => "required",
            "voucher_type" => "required",
            "narration" => "nullable",
            "cheque_no" => "nullable",
            "cheque_date" => "nullable",
            "bank_name" => "nullable",
            "bank_branch" => "nullable",
            "debit_account_id" => "nullable",
            "debit_account_amount" => "nullable",
            "debit_account_narration" => "nullable"

        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        DB::beginTransaction();
        try {
            $debit_account_amount = 0;
            foreach ($request->debit_account_amount as $key => $amount) {
                $debit_account_amount += $amount;
            }
            $voucher = $this->voucherRepository->create([
                'voucher_type' => $request->voucher_type == 1 ? 'CV' : 'BV' ,
                'amount'=> $debit_account_amount,
                'date'=> Carbon::parse($request->date)->format('Y-m-d'),
                'payment_type' => 'voucher_payment',
                'credit_account_id'=> $request->credit_account_id,
                'credit_account_amount'=> $debit_account_amount,
                'credit_account_narration'=> $request->narration,

                'debit_account_id'=> $request->debit_account_id,
                'debit_account_amount'=> $request->debit_account_amount,
                'debit_account_narration'=> $request->debit_account_narration,

                'narration' => $request->narration,
                'cheque_no' => $request->cheque_no,
                'cheque_date' => Carbon::parse($request->cheque_date)->format('Y-m-d'),
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'is_approve' => (app('business_settings')->where('type', 'voucher_payment_approval')->first()->status == 1) ? 1 : 0,
            ]);
            
            $users=User::whereIn('role_id',[1,2])->where('id','!=',auth()->user()->id)
                        ->where('is_active','1')
                        ->get(['id','role_id']);
            $created_by = Auth::user()->name;
            $content = __('notification.A Voucher has been created by') . $created_by .'';
            $subject= __('notification.Voucher Create Reminder');
            $number = app('general_setting')->phone;
            $message = 'A Voucher has been created by ' . $created_by .'';

            $this->sendNotification($voucher,app('general_setting')->email, $subject, $content,$number,$message,$users);

            DB::commit();
            \LogActivity::successLog('Voucher Payment has been Added.');
            Toastr::success(__('account.Payment has been added Successfully'));
            return redirect()->route('vouchers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Voucher Payment creation');
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function show($id)
    {
        $payment = $this->voucherRepository->find($id);
        return view('account::voucher_approvals.view', [
            "payment" => $payment
        ]);
    }

    public function edit($id)
    {
        $payment = $this->voucherRepository->find($id);
        $account_categories = $this->voucherRepository->category();
        $chartAccounts = $this->voucherRepository->LiabilityAccount();
        $payment_accounts = ChartAccount::PaymentAccounts()->get();
        return view('account::voucher_payments.edit', [
            "payment" => $payment,
            "account_categories" => $account_categories,
            "chartAccounts" => $chartAccounts,
            "payment_accounts" => $payment_accounts
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
              "date" => "nullable",
              "voucher_type" => "required",
              "narration" => "nullable",
              "cheque_no" => "nullable",
              "cheque_date" => "nullable",
              "bank_name" => "nullable",
              "bank_branch" => "nullable",
              "debit_account_id" => "nullable",
              "debit_account_amount" => "nullable",
              "debit_account_narration" => "nullable"

        ]);

        DB::beginTransaction();
        try {
            $debit_account_amount = 0;
            foreach ($request->debit_account_amount as $key => $amount) {
                $debit_account_amount += $amount;
            }
            $voucher = $this->voucherRepository->update([
                'voucher_type' => $request->voucher_type == 1 ? 'CV' : 'BV' ,
                'amount'=> $debit_account_amount,
                'date'=> Carbon::parse($request->date)->format('Y-m-d'),

                'credit_account_id'=> $request->credit_account_id,
                'credit_account_amount'=> $debit_account_amount,
                'credit_account_narration'=> $request->narration,

                'debit_account_id'=> $request->debit_account_id,
                'debit_account_amount'=> $request->debit_account_amount,
                'debit_account_narration'=> $request->debit_account_narration,

                'narration' => $request->narration,
                'cheque_no' => $request->cheque_no,
                'cheque_date' => Carbon::parse($request->cheque_date)->format('Y-m-d'),
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'is_approve' => (app('business_settings')->where('type', 'voucher_payment_approval')->first()->status == 1) ? 1 : 0,
            ], $id);
            
            $users=User::whereIn('role_id',[1,2])->where('id','!=',auth()->user()->id)
                        ->where('is_active','1')
                        ->get(['id','role_id']);
            $created_by = Auth::user()->name;
            $content =  __('notification.A Voucher has been Update by') . $created_by .'';
            $number = app('general_setting')->phone;
            $subject=  __('notification.Voucher Update Reminder');
            $message =  __('notification.A Voucher has been Update by') . $created_by .'';
            $this->sendNotification($voucher,app('general_setting')->email,$subject , $content,$number,$message,$users);

            DB::commit();
            \LogActivity::successLog('Voucher Payment has been updated.');
            Toastr::success(__('account.Payment has been updated Successfully'));
            return redirect()->route('vouchers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Voucher Payment update');
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $voucher = $this->voucherRepository->find($id);
            $this->voucherRepository->delete($id);

            $users=User::whereIn('role_id',[1,2])->where('id','!=',auth()->user()->id)
                        ->where('is_active','1')
                        ->get(['id','role_id']);

            $created_by = Auth::user()->name;
            $content = __('notification.A Voucher has been Delete by') . $created_by .'';
            $number = app('general_setting')->phone;
            $message = __('notification.A Voucher has been Delete by') . $created_by .'';
            $subject=  __('notification.Voucher Delete Reminder');
            $this->sendNotification($voucher,app('general_setting')->email,$subject, $content,$number,$message,$users);

            \LogActivity::successLog('A Voucher has been destroyed.');
            Toastr::success(__('setup.Voucher has been deleted Successfully'));
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Voucher Destroy');
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function get_Accounts(Request $request)
    {
        if ($request->id == 1) {
            $account = $this->voucherRepository->CashPaymentAccount();
        }
        else {
            $account = $this->voucherRepository->BankPaymentAccount();
        }
        if ($request->transfer == 1) {
            return view('account::transfers.accounts', [
                "account_list" => $account
            ]);
        }
        else {
            return view('account::voucher_payments.accounts', [
                "account_list" => $account
            ]);
        }
    }

    public function approval_status(Request $request)
    {
        try {
            $voucher = $this->voucherRepository->status_approval($request->except("_token"));
            $users=User::whereIn('role_id',[1,2])->where('id','!=',auth()->user()->id)
                        ->where('is_active','1')
                        ->get(['id','role_id']);
            $created_by = Auth::user()->name;
            $content = __('notification.A Voucher has been Approve by') . $created_by .'';
            $number = app('general_setting')->phone;
            $message = __('notification.A Voucher has been Approve by') . $created_by .'';
            $subject = __('notification.Voucher Approve Reminder');
            $this->sendNotification($voucher,app('general_setting')->email,$subject, $content,$number,$message,$users);

            \LogActivity::successLog('Voucher status has been updated');
            return 1;
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return back();
        }

    }

    public function get_voucher_details(Request $request)
    {
        try {
            $voucher = $this->voucherRepository->get_voucher_details($request->except("_token"));
            return view('account::voucher_approvals.voucher_details', [
                "voucher" => $voucher
            ]);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function get_voucher_details_form_statetment(Request $request)
    {
        try {
            $voucher = $this->voucherRepository->get_voucher_details($request->except("_token"));
            return view('account::voucher_approvals.voucher_details_statement', [
                "voucher" => $voucher
            ]);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return back();
        }
    }


    public function allApproval()
    {
        DB::beginTransaction();
        try {
            $this->voucherRepository->allApproved();
            DB::commit();
            \LogActivity::successLog('All Voucher status has been Approved');
            Toastr::success(trans('account.Vouchers has been Approved Successfully'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }
}
