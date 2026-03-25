@extends('layouts.simple')

@section('title', __('Import') . ' #' . $import->id)

@section('content')
<h1 class="page-title"><a href="{{ route('imports.index') }}" class="link">←</a> {{ __('Import Invoice') }} #{{ $import->id }}</h1>

<div class="card">
    <p><strong>{{ __('Date') }}:</strong> {{ $import->date ? $import->date : '—' }}</p>
    <p><strong>{{ __('Status') }}:</strong> {{ $import->status === \App\Models\Import::STATUS_PENDING ? __('Pending') : __('Confirmed') }}</p>
    @if ($import->approvedBy)
        <p><strong>{{ __('Approved by') }}:</strong> {{ $import->approvedBy->name }}</p>
    @endif

    <h3 style="margin:1rem 0 0.5rem;">{{ __('Items') }}</h3>
    <table>
        <thead>
            <tr><th>{{ __('Item') }}</th><th>{{ __('Category') }}</th><th>{{ __('Quantity') }}</th></tr>
        </thead>
        <tbody>
            @foreach ($import->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->catogory?->name ?? '—' }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:1.5rem;">
        @if ($import->status === \App\Models\Import::STATUS_PENDING)
            <form action="{{ route('imports.confirm', $import) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('Confirm and add stock to warehouse?') }}');">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('Confirm (add to warehouse)') }}</button>
            </form>
        @endif
        <a href="{{ route('imports.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
    </div>
</div>
@endsection
