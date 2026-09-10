<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laravel | Sign in</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                background: #111111;
            }
        </style>
    </head>
    <body class="min-h-screen bg-[#0b0b0c] text-white antialiased">
        <div class="flex min-h-screen items-center justify-center px-4 py-10">
            <div class="w-full max-w-[620px] rounded-[18px] bg-[#2d2d2f] p-7 shadow-[0_12px_30px_rgba(0,0,0,0.5)]">
                <div class="mx-auto max-w-[430px]">
                    <div class="text-center">
                        <h1 class="text-[2.8rem] font-bold leading-none text-white">Laravel</h1>
                        <h2 class="mt-2 text-[2.8rem] font-bold leading-none text-white">Sign in</h2>
                    </div>

                    <form method="POST" action="{{ route('login.entrar') }}" class="mt-8 space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="block text-[1.08rem] font-medium text-white">Email address<span class="text-[#f5a100]">*</span></label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="mt-2 h-[54px] w-full rounded-xl border-[2px] border-[#f5a100] bg-[#1c1c1e] px-4 text-lg text-white outline-none placeholder:text-zinc-400"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-[1.08rem] font-medium text-white">Password<span class="text-[#f5a100]">*</span></label>
                            <div class="relative mt-2">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    class="h-[54px] w-full rounded-xl border-[2px] border-[#f5a100] bg-[#1c1c1e] px-4 pr-12 text-lg text-white outline-none placeholder:text-zinc-400"
                                >
                                <button type="button" aria-label="Mostrar contraseña" class="absolute inset-y-0 right-0 flex items-center justify-center pr-3">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-full border border-[#f5a100] bg-[#2a2a2d] text-[0.85rem] font-semibold text-[#f5a100]">◉</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex items-center gap-3 text-[1.08rem] text-zinc-200">
                            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-zinc-500 bg-[#1c1c1e] text-[#f5a100]" />
                            <span>Remember me</span>
                        </label>

                        <button type="submit" class="mt-1 h-[52px] w-full rounded-xl bg-[#f56d00] px-4 text-lg font-semibold text-[#1c1c1e] shadow-[0_2px_0_rgba(0,0,0,0.3)] transition hover:bg-[#f77b1a]">
                            Sign in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
