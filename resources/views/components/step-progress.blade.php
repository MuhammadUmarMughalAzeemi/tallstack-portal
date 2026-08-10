@props(['steps' => [], 'currentStep' => 1])

@php
    // Debug: Check if steps is empty
    if(empty($steps)) {
        echo '<div class="text-red-500 mb-4">Warning: Steps array is empty in step-progress component</div>';
    }
@endphp

<div class="mb-8">
    <div class="flex items-center justify-between">
        @forelse($steps as $number => $step)
            <div class="flex-1 flex items-center">
                <div class="relative">
                    <button type="button"
                            @class([
                                'w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all duration-300',
                                'bg-indigo-600 text-white ring-4 ring-indigo-200' => $currentStep === $number,
                                'bg-green-500 text-white' => ($step['completed'] ?? false) && $currentStep !== $number,
                                'bg-gray-200 text-gray-600 hover:bg-gray-300' => !($step['completed'] ?? false) && $currentStep !== $number,
                            ])
                            @if(!($step['completed'] ?? false) && $currentStep !== $number)
                                wire:click="goToStep({{ $number }})"
                        @endif
                        @disabled(($step['completed'] ?? false) === false && $currentStep !== $number)
                    >
                        @if($step['completed'] ?? false)
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            {{ $number }}
                        @endif
                    </button>
                    <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs font-medium whitespace-nowrap text-gray-600">
                        {{ $step['name'] ?? "Step $number" }}
                    </div>
                </div>

                @if(!$loop->last)
                    <div class="flex-1 h-1 mx-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-600 transition-all duration-500"
                             style="width: {{ ($step['completed'] ?? false) ? '100%' : '0%' }}">
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-red-500">No steps defined</div>
        @endforelse
    </div>
</div>
