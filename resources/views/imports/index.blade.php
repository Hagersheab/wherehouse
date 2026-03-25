@extends('layouts.simple')

@section('title', __('Import Invoices'))

@section('content')
<h1 class="page-title">{{ __('Import Invoices') }} <a href="{{ route('imports.create') }}" class="btn btn-primary">{{ __('New') }}</a></h1>

<div class="card">
    @if ($imports->isEmpty())
        <p>{{ __('No import invoices yet.') }}</p>
        <a href="{{ route('imports.create') }}" class="link">{{ __('Create first') }}</a>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Approved by') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($imports as $import)
                <tr>
                    <td>{{ $import->id }}</td>
                    <td>{{ $import->date ? $import->date : '—' }}</td>
                    <td>{{ $import->status === \App\Models\Import::STATUS_PENDING ? __('Pending') : __('Confirmed') }}</td>
                    <td>{{ $import->approvedBy?->name ?? '—' }}</td>
                    <td><a href="{{ route('imports.show', $import) }}" class="link">{{ __('View') }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
