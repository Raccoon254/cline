<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn ring ring-white btn-secondary font-semibold text-xs min-w-[100px] text-white uppercase tracking-widest focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
