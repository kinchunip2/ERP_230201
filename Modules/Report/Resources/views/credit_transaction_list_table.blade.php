<table class="table Crm_table_active">
    <thead>
        <tr>
            <th scope="col">{{ __('account.Date') }}</th>
            <th scope="col">{{__('sale.Reference No')}}</th>
            <th scope="col">{{ __('account.Description') }}</th>
            <th scope="col">{{ __('account.Debit') }}</th>
            <th scope="col">{{ __('account.Credit') }}</th>
            <th scope="col" class="text-right">{{ __('account.Balance') }}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $chartAccount = Modules\Account\Entities\ChartAccount::where('contactable_type', 'Modules\Contact\Entities\ContactModel')->where('contactable_id', $supplier->id)->first();
            $currentBalance = 0 + ($supplier->opening_balance ? $supplier->opening_balance : 0);
        @endphp
        <tr>
            <td colspan="5">{{ __('account.Openning Balance') }}</td>
            <td class="text-right">{{ single_price($currentBalance) }}</td>
        </tr>
        @foreach ($chartAccount->transactions as $key => $payment)
            @if ($payment->type == "Cr")
                @php
                    $currentBalance += $payment->amount;
                @endphp
            @else
                @php
                    $currentBalance -= $payment->amount;
                @endphp
            @endif
            <tr>
                <td>{{ showDate(@$payment->voucherable->date) }}</td>
                <td><a onclick="getDetails({{ $payment->voucherable->referable->id }})">{{ @$payment->voucherable->referable->ref_no }}</a></td>
                <td>{{ @$payment->voucherable->narration }}</td>
                <td>
                    @if ($payment->type == "Dr")
                        {{ single_price($payment->amount) }}
                        <input type="hidden" name="debit[]" value="{{ $payment->amount }}">
                    @endif
                </td>
                <td>
                    @if ($payment->type == "Cr")
                        {{ single_price($payment->amount) }}
                        <input type="hidden" name="credit[]" value="{{ $payment->amount }}">
                    @endif
                </td>
                <td class="text-right">{{ single_price($currentBalance) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
