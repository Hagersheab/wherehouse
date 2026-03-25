@extends('layouts.simple')

@section('title', __('Delivery Orders'))

@section('content')
<h1 class="page-title">{{ __('Delivery Orders') }} <a href="{{ route('exports.create') }}" class="btn btn-primary">{{ __('New') }}</a></h1>

<div class="card">
    @if ($exports->isEmpty())
        <p>{{ __('No delivery orders yet.') }}</p>
        <a href="{{ route('exports.create') }}" class="link">{{ __('Create first') }}</a>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Department') }}</th>
                    <th>{{ __('Received by') }}</th>
                    <th>{{ __('Approved by') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exports as $export)
                <tr>
                    <td>{{ $export->id }}</td>
                    <td>{{ $export->department?->name ?? '—' }}</td>
                    <td>{{ $export->reseved_by?->name ?? '—' }}</td>
                    <td>{{ $export->approved_by?->name ?? '—' }}</td>
                    <td>{{ $export->status === \App\Models\Export::STATUS_PENDING ? __('Pending') : __('Delivered') }}</td>
                    <td><a href="{{ route('exports.show', $export) }}" class="link">{{ __('View') }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
