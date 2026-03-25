@extends('layouts.simple')

@section('title', __('Warehouse'))

@section('content')
<h1 class="page-title">{{ __('Warehouse Stock') }}</h1>

<div class="card">
    <p style="margin-bottom:1rem;">{{ __('Stock is added when you confirm an import, and reduced when you deliver an export.') }}</p>
    @if ($stock->isEmpty())
        <p>{{ __('No stock yet. Confirm an import to add stock.') }}</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>{{ __('Item') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Quantity') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stock as $row)
                    {{-- Each $row->items is a collection. Let's loop through them. --}}
                    @foreach ($row->items as $item)
                        <tr>
                            <td>{{ $item->name ?? '—' }}</td>
                            <td>{{ $item->catogory?->name ?? '—' }}</td>
                            <td>{{ $row->quantity }}</td>
                        </tr>
                    @endforeach
                @endforeach

            </tbody>
        </table>
    @endif
</div>
@endsection
