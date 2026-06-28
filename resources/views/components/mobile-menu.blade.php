<div
    x-show="open"
    x-transition
    @click.outside="open = false"
    class="md:hidden border-t border-white/10 bg-slate-900"
>

    <div class="space-y-2 p-5">

        <a href="#features"
           class="block rounded-xl px-4 py-3 hover:bg-slate-800">
            Features
        </a>

        <a href="#how-it-works"
           class="block rounded-xl px-4 py-3 hover:bg-slate-800">
            How It Works
        </a>

        <a href="#pricing"
           class="block rounded-xl px-4 py-3 hover:bg-slate-800">
            Pricing
        </a>

        <a href="#contact"
           class="block rounded-xl px-4 py-3 hover:bg-slate-800">
            Contact
        </a>

        <hr class="border-white/10">

        @auth

            <a href="{{ route('dashboard') }}"
               class="block rounded-xl bg-white px-4 py-3 text-center font-semibold text-slate-900">
                Dashboard
            </a>

        @else

            <a href="{{ route('login') }}"
               class="block rounded-xl border border-white/10 px-4 py-3 text-center">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="block rounded-xl bg-emerald-500 px-4 py-3 text-center font-semibold">
                Get Started
            </a>

        @endauth

    </div>

</div>