<main class="flex flex-col items-center justify-center py-1  px-1 md:px-8 lg:min-h-screen">
    <div class="grid items-center gap-12 max-w-lg lg:grid-cols-2 lg:max-w-6xl">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 !leading-tight lg:text-3xl dark:text-slate-50">
                JangkarMas Admin App
            </h2>
            <p class="text-base mt-6 text-slate-600 leading-relaxed dark:text-slate-400">Aplikasi Pengelolahan data
                JangkarMas mulai dari Order, Stock, Item, dan Customer</p>

            <div class="text-sm mt-6 text-slate-900 lg:mt-12 dark:text-slate-50">Jika belum punya akun hubungi admin akun
                <a href="#" class="text-blue-700 font-medium hover:underline ml-1 dark:text-blue-500">Hubungi
                    disini</a>
            </div>
        </div>

        <div class="max-w-md lg:ml-auto w-full">
            <h1 class="text-slate-900 text-2xl font-bold mb-10 dark:text-slate-50">
                Login
            </h1>

            <form class="space-y-6">

                <div>
                    @error('login')
                        <!-- Error -->
                        <div class="bg-red-50 text-sm p-3 rounded-md flex gap-3 border border-red-100 max-sm:items-start dark:bg-red-900/20 dark:border-red-800/40"
                            role="alert">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                <p class="text-red-900 font-medium dark:text-red-300">Error!</p>
                                <p class="text-red-900 dark:text-red-400">{{ $message }}</p>
                            </div>

                        </div>
                    @enderror
                </div>
                {{-- username --}}
                <div>
                    <label for="username"
                        class="mb-2 text-slate-900 font-medium text-sm inline-block dark:text-slate-50">Username</label>
                    <input type="text" id="username" name="username" placeholder="paong.admin.order123" required
                        class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                </div>
                {{-- password --}}
                <div>
                    <label for="password"
                        class="mb-2 text-slate-900 font-medium text-sm inline-block dark:text-slate-50">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required
                        class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                </div>
                {{-- forgot password --}}
                {{-- <div class="flex items-start flex-wrap gap-2">
               <label class="flex items-center group has-[input:checked]:text-slate-900">
                  <input id="remember" name="remember" type="checkbox" required class="sr-only" />
                  <!-- Custom box -->
                  <span class="flex h-4 w-4 shrink-0 items-center justify-center rounded outline-1 outline-slate-300 dark:outline-neutral-700
                              bg-white dark:bg-neutral-800
                              group-has-[input:checked]:bg-blue-600
                              group-has-[input:checked]:outline-blue-600
                              group-focus-within:outline-2
                              group-focus-within:outline-blue-600" aria-hidden="true">
                     <!-- Checkmark -->
                     <svg class="size-3 text-white opacity-0 group-has-[input:checked]:opacity-100" viewBox="0 0 12 10"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 5l3 3 7-7" />
                     </svg>
                  </span>
                  <span class="ml-3 text-sm text-slate-700 dark:text-slate-300">
                     Remember me
                  </span>
               </label>

               <a href="#"
                  class="ml-auto text-sm font-medium text-blue-700 dark:text-blue-500 hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                  Forgot password?
               </a>
            </div> --}}
                <button type="submit"
                    class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    Login Sekarang</button>
            </form>

            {{-- google auth --}}
            {{-- <div class="my-8 flex items-center gap-4">
            <hr class="w-full border-slate-300 dark:border-neutral-700" />
            <p class="text-sm text-slate-700 text-center dark:text-slate-300">or</p>
            <hr class="w-full border-slate-300 dark:border-neutral-700" />
         </div> --}}

            {{-- <div>
            <a href="#"
               class="w-full flex items-center justify-center gap-2.5 py-2 px-3.5 text-sm rounded-md font-semibold text-slate-900 border border-slate-300 bg-white hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 dark:text-slate-50 dark:border-neutral-700 dark:bg-neutral-800 dark:hover:bg-neutral-700">
               <svg xmlns="http://www.w3.org/2000/svg" class="size-[18px]" viewBox="0 0 512 512" aria-hidden="true">
                  <path fill="#fbbd00"
                     d="M120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308H52.823C18.568 144.703 0 198.922 0 256s18.568 111.297 52.823 155.785h86.308v-86.308C126.989 305.13 120 281.367 120 256z"
                     data-original="#fbbd00" />
                  <path fill="#0f9d58"
                     d="m256 392-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216C305.044 385.147 281.181 392 256 392z"
                     data-original="#0f9d58" />
                  <path fill="#31aa52"
                     d="m139.131 325.477-86.308 86.308a260.085 260.085 0 0 0 22.158 25.235C123.333 485.371 187.62 512 256 512V392c-49.624 0-93.117-26.72-116.869-66.523z"
                     data-original="#31aa52" />
                  <path fill="#3c79e6"
                     d="M512 256a258.24 258.24 0 0 0-4.192-46.377l-2.251-12.299H256v120h121.452a135.385 135.385 0 0 1-51.884 55.638l86.216 86.216a260.085 260.085 0 0 0 25.235-22.158C485.371 388.667 512 324.38 512 256z"
                     data-original="#3c79e6" />
                  <path fill="#cf2d48"
                     d="m352.167 159.833 10.606 10.606 84.853-84.852-10.606-10.606C388.668 26.629 324.381 0 256 0l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"
                     data-original="#cf2d48" />
                  <path fill="#eb4132"
                     d="M256 120V0C187.62 0 123.333 26.629 74.98 74.98a259.849 259.849 0 0 0-22.158 25.235l86.308 86.308C162.883 146.72 206.376 120 256 120z"
                     data-original="#eb4132" />
               </svg>
               Sign in with Google
            </a>
         </div> --}}
        </div>
    </div>
</main>
