@extends('layouts.simple')

@section('title', __('New Delivery Order'))

@section('content')
<h1 class="page-title"><a href="{{ route('exports.index') }}" class="link">←</a> {{ __('New Delivery Order') }}</h1>

<div class="card">
    <p style="margin-bottom:1rem;">{{ __('Assign items to department/employee. Confirm delivery to deduct stock from warehouse.') }}</p>
    <form action="{{ route('exports.store') }}" method="POST">
        @csrf
        <div class="form-group" style="max-width:300px;">
            <label for="department_id">{{ __('Department') }}</label>
            <select id="department_id" name="department_id" required>
                <option value="">{{ __('Select') }}</option>
                @foreach ($departments as $d)
                    <option value="{{ $d->id }}" {{ old('department_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
            @error('department_id') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group" style="max-width:300px;">
            <label for="reseved_by_id">{{ __('Received by (Employee)') }}</label>
            <select id="reseved_by_id" name="reseved_by_id" required>
                <option value="">{{ __('Select') }}</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" {{ old('reseved_by_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
            @error('reseved_by_id') <div class="error">{{ $message }}</div> @enderror
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
        <button type="submit" class="btn btn-primary">{{ __('Create order') }}</button>
        <a href="{{ route('exports.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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
