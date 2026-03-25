@extends('layouts.simple')

@section('title', __('New Import Invoice'))

@section('content')
<h1 class="page-title"><a href="{{ route('imports.index') }}" class="link">←</a> {{ __('New Import Invoice') }}</h1>

<div class="card">
    <p style="margin-bottom:1rem;">{{ __('Add items and quantities. After saving, confirm the invoice to add stock to warehouse.') }}</p>
    <form action="{{ route('imports.store') }}" method="POST" id="import-form">
        @csrf
        <div class="form-group">
            <label for="date">{{ __('Date') }}</label>
            <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required style="max-width:200px;">
            @error('date') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Items') }}</label> <button type="button" onclick="addRow()" class="link">{{ __('+ Add row') }}</button>
            <div id="items-container" style="margin-top:0.5rem;">
                <div style="display:flex;gap:1rem;align-items:flex-end;margin-bottom:0.5rem;">
                    <div style="flex:1;">
                        <select name="items[0][item_id]" required>
                            <option value="">{{ __('Select') }}</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->catogory?->name }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="width:80px;">
                        <input type="number" name="items[0][quantity]" min="1" value="1" required placeholder="Qty">
                    </div>
                    <button type="button" onclick="removeRow(this)" style="background:none;border:none;color:#dc2626;cursor:pointer;">×</button>
                </div>
            </div>
            @error('items') <div class="error">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Create invoice') }}</button>
        <a href="{{ route('imports.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
</div>

<script>
let rowIndex = 1;
const selectText = @json(__('Select'));
const items = @json($items->map(fn($i) => ['id' => $i->id, 'name' => $i->name, 'cat' => $i->catogory?->name])->values());
function addRow() {
    const container = document.getElementById('items-container');
    const div = document.createElement('div');
    div.style.cssText = 'display:flex;gap:1rem;align-items:flex-end;margin-bottom:0.5rem;';
    let opts = '<option value="">'+selectText+'</option>';
    items.forEach(i => { opts += '<option value="'+i.id+'">'+i.name+' ('+(i.cat||'')+')</option>'; });
    div.innerHTML = '<div style="flex:1;"><select name="items['+rowIndex+'][item_id]">'+opts+'</select></div><div style="width:80px;"><input type="number" name="items['+rowIndex+'][quantity]" min="1" value="1" placeholder="Qty"></div><button type="button" onclick="removeRow(this)" style="background:none;border:none;color:#dc2626;cursor:pointer;">×</button>';
    container.appendChild(div);
    rowIndex++;
}
function removeRow(btn) {
    if (document.getElementById('items-container').children.length <= 1) return;
    btn.parentElement.remove();
}
</script>
@endsection
