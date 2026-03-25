@extends('layouts.simple')

@section('title', __('Delivery') . ' #' . $export->id)

@section('content')
<h1 class="page-title"><a href="{{ route('exports.index') }}" class="link">←</a> {{ __('Delivery Order') }} #{{ $export->id }}</h1>

<div class="card">
    <p><strong>{{ __('Department') }}:</strong> {{ $export->department?->name ?? '—' }}</p>
    <p><strong>{{ __('Received by') }}:</strong> {{ $export->receivedBy?->name ?? '—' }}</p>
    <p><strong>{{ __('Status') }}:</strong> {{ $export->status === \App\Models\Export::STATUS_PENDING ? __('Pending') : __('Delivered') }}</p>
    @if ($export->date_approve)
        <p><strong>{{ __('Delivered on') }}:</strong> {{ $export->date_approve}}</p>
    @endif
    @if ($export->approvedBy)
        <p><strong>{{ __('Approved by') }}:</strong> {{ $export->approvedBy->name }}</p>
    @endif

    <h3 style="margin:1rem 0 0.5rem;">{{ __('Items') }}</h3>
    <table>
        <thead>
            <tr><th>{{ __('Item') }}</th><th>{{ __('Category') }}</th><th>{{ __('Quantity') }}</th></tr>
        </thead>
        <tbody>
            @foreach ($export->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->catogory?->name ?? '—' }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:1.5rem;">
        @if ($export->status === \App\Models\Export::STATUS_PENDING)
            <form action="{{ route('exports.deliver', $export) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('Confirm delivery and deduct from warehouse?') }}');">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('Confirm delivery') }}</button>
            </form>
        @endif
        <a href="{{ route('exports.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
    </div>
</div>
@endsection
