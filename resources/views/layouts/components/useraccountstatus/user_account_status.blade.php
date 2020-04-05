@if(!empty($accountStatus['account_status']))
    @if($accountStatus['account_status'] == "PENDING" || $accountStatus['account_status'] == "Pending")
        @php $buttonClass   =   "btn btn-warning btn-sm waves-effect waves-light"; @endphp
    @elseif($accountStatus['account_status'] == "ACCEPT" || $accountStatus['account_status'] == "Accept")
        @php $buttonClass   =   "btn btn-success btn-sm waves-effect waves-light"; @endphp
    @elseif($accountStatus['account_status'] == "REJECT" || $accountStatus['account_status'] == "Reject")
        @php $buttonClass   =   "btn btn-pink btn-sm waves-effect waves-light"; @endphp
    @elseif($accountStatus['account_status'] == "DELETE" || $accountStatus['account_status'] == "Delete")
        @php $buttonClass   =   "btn btn-danger btn-sm waves-effect waves-light"; @endphp
    @endif
    <button type="button" class="{{$buttonClass}}">{{$accountStatus['account_status']}}</button>
@else

    <button type="button" class="btn btn-warning btn-sm waves-effect waves-light">{{'PENDING'}}</button>

@endif
