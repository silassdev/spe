@props(['type' => 'global', 'text' => 'Loading Digital Node...'])

@if($type === 'global')
    <div id="global-loader" class="overlapping-dots-overlay">
        <!-- Reusable Connected Tiny Squares Mesh Background for the loader overlay -->
        <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden opacity-10">
            <div class="w-full h-full bg-tech-squares-dark"></div>
        </div>
        
        <div class="relative z-10 flex flex-col items-center gap-4">
            <div class="overlapping-dots-container">
                <div class="dot dot-1"></div>
                <div class="dot dot-2"></div>
            </div>
            @if($text)
                <span class="font-mono-tech text-[10px] font-bold uppercase tracking-widest text-emerald-400/90 animate-pulse">// {{ $text }}</span>
            @endif
        </div>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'overlapping-dots-tiny-container']) }}>
        <div class="dot dot-1"></div>
        <div class="dot dot-2"></div>
    </div>
@endif
