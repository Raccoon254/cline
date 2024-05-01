<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn ring btn-primary font-semibold text-xs text-white uppercase tracking-widest min-w-[100px] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
