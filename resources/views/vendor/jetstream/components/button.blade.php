<button {{ $attributes->merge(['type' => 'submit', 'class' => 'opacity-75 hover:opacity-100 items-center px-4 py-2  border-transparent rounded-md font-semibold text-lg uppercase tracking-widest  active:bg-gray-900 active:text-white focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ']) }}>
    {{ $slot }}
</button>
