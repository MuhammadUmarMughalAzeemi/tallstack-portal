@if ($errors->any())
<div class="bg-red-50 border border-red-100 text-red-800 p-4 rounded-xl">
    <div class="flex items-center justify-between">
        <div class="font-bold text-sm">{{ __('Validation Error') }}</div>
        <div class="text-xs text-red-700 font-medium">{{ __('Please fix the fields highlighted below.') }}</div>
    </div>

    <ul class="mt-2 list-disc list-inside text-sm space-y-1">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
