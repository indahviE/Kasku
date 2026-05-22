
        <script src="https://cdn.tailwindcss.com"></script>

<!-- PAYMENT FORM -->
<div class="max-w-6xl mx-auto px-4 py-6 md:py-10">

    <div class="bg-[#f7f7f7] rounded-[2rem] md:rounded-[2.5rem] p-5 md:p-10">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <!-- LEFT CONTENT -->
            <div>

                <p class="uppercase tracking-[0.2em] text-xs text-gray-400 font-semibold">
                    PAYMENT FORM
                </p>

                <h1 class="text-3xl md:text-5xl font-bold leading-tight mt-4 text-gray-900">
                    Bayar Kas <br>
                    Dengan Mudah
                </h1>

                <p class="text-gray-500 mt-5 leading-relaxed text-sm md:text-base max-w-md">
                    Silahkan scan QRIS berikut untuk melakukan pembayaran kas.
                    Setelah transfer berhasil, upload bukti pembayaran pada form.
                </p>

                <!-- INFO -->
                <div class="mt-8 md:mt-10 space-y-5">

                    <!-- NOMINAL -->
                    <div class="flex items-center gap-4">

        
<div class="w-12 h-12 rounded-2xl bg-white border border-gray-200 flex items-center justify-center">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-5 h-5 text-black"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.7"
              d="M12 8c-1.657 0-3 1.12-3 2.5S10.343 13 12 13s3 1.12 3 2.5S13.657 18 12 18m0-10V6m0 12v-2m8-4a8 8 0 11-16 0 8 8 0 0116 0z"/>

    </svg>

</div>

                        <div>
                            <p class="text-sm text-gray-400">
                                Kas Bulanan
                            </p>

                            <h3 class="font-semibold text-lg">
                                Rp 3000 / Minggu
                            </h3>
                        </div>

                    </div>


                    <!-- VERIFIED -->
                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-2xl bg-white border border-gray-200 flex items-center justify-center flex-shrink-0">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-black"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M9 12l2 2 4-4m5-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>

                        </div>

                        <div>
                            <p class="text-sm text-gray-400">
                                Status
                            </p>

                            <h3 class="font-semibold text-lg">
                                Pembayaran Aman
                            </h3>
                        </div>

                    </div>

                </div>

            </div>


            <!-- FORM -->
            <div class="bg-white rounded-[2rem] p-5 md:p-8 border border-gray-100">

                <form action="" method="POST" enctype="multipart/form-data">

                    @csrf

                    <!-- QRIS -->
                    <div class="mb-6">

                        <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4 md:p-6 text-center">

                            <img
                                src="{{ asset('images/QRIS FATHAN.png') }}"
                                alt="QRIS"
                                class="w-44 md:w-56 mx-auto object-contain"
                            >

                            <p class="text-sm text-gray-500 mt-4">
                                Scan QRIS untuk melakukan pembayaran
                            </p>

                        </div>

                    </div>


                    <!-- JUMLAH -->
                    <div class="mb-5">

                        <label class="text-sm text-gray-500 mb-2 block">
                            Jumlah Bayar
                        </label>

                        <input
                            type="number"
                            name="jml_bayar"
                            placeholder="Masukan jumlah pembayaran"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-black"
                        >

                    </div>


                    <!-- BUKTI -->
                    <div class="mb-6">

                        <label class="text-sm text-gray-500 mb-2 block">
                            Upload Bukti Pembayaran
                        </label>

                        <input
                            type="file"
                            name="bukti_bayar"
                            accept="image/*"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm"
                        >

                    </div>


                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-black text-white py-4 font-semibold hover:scale-[1.01] transition text-sm md:text-base">

                        Bayar Sekarang

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>