<div class="{{ $parentClass ?? 'mb-3 row' }}">
    <label for="{{ $name }}"
        class="{{ $labelClass ?? 'col col-form-label' }}">{{ $lable }}</label>
    <div class="{{ $inputClass ?? 'col' }}">
        <div class="mb-3">
            <input class="form-control form-control-sm" name="{{ $name }}"  type="file" {{ $option ?? ''}} accept="{{ $accept ?? ""}}">
        </div>
    </div>
</div>
