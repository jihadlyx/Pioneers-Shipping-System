<div id="translate{{ $shipment->ship_id }}" x-transition=""
     class="fixed modal left-0 top-0 z-999999 hidden h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5">

    <div class="fixed overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-description="Modal panel, show/hide based on modal state."
                 class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="p-4 sm:p-10 text-center overflow-y-auto">
                    <!-- Icon -->
                    <span
                        class="mb-4 inline-flex justify-center items-center w-[62px] h-[62px] rounded-full border-4 border-blue-50 bg-blue-400 text-blue-500">
                        <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.2984 0.826822L15.2868 0.811827L15.2741 0.797751C14.9173 0.401867 14.3238 0.400754 13.9657 0.794406L5.91888 9.45376L2.05667 5.2868C1.69856 4.89287 1.10487 4.89389 0.747996 5.28987C0.417335 5.65675 0.417335 6.22337 0.747996 6.59026L0.747959 6.59029L0.752701 6.59541L4.86742 11.0348C5.14445 11.3405 5.52858 11.5 5.89581 11.5C6.29242 11.5 6.65178 11.3355 6.92401 11.035L15.2162 2.11161C15.5833 1.74452 15.576 1.18615 15.2984 0.826822Z" fill="white" stroke="white"></path>
                    </svg>
                    </span>
                    <!-- End Icon -->

                    <h3 class="mb-2 text-2xl font-bold text-gray-800">
                        اختر مندوب لتسليمه الشحنه
                        " {{ $shipment->ship_name }} "
                    </h3>
                    <div class="btns-close-modale mt-6 flex flex-col justify-center gap-y-4">
                        <form action="{{ route('status.shipments.store', ['page_id' => 11]) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="p-3.5">
                                <input type="number" name="ship_id" value="{{ $shipment->ship_id }}" class="hidden" />
                                <div class="mb-4.5 w-full">

                                    <label class="mb-3 text-right block text-xl font-medium text-black dark:text-white">
                                        المندوب
                                    </label>
                                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                                        <select name="delivery_id"
                                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                                                :class="isOptionSelected && 'text-black dark:text-white'"
                                                @change.once="isOptionSelected = true" required>
                                            <option value="" disabled selected class="text-body">
                                                اختر
                                            </option>
                                            @foreach($delegates as $delegate)
                                                <option value="{{ $delegate->delivery_id }}" class="text-body"> {{ $delegate->delivery_name }} </option>
                                            @endforeach
                                        </select>
                                        <span class="absolute ltr:right-4 rtl:left-4 top-1/2 z-30 -translate-y-1/2">
                                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.8">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
                                                  fill=""></path>
                                        </g>
                                    </svg>
                                </span>
                                    </div>
                                    <div class="invalid-feedback pr-4 text-red-500 mt-1 text-sm">
                                        الرجاء اختيار مندوب للشحنة
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                    class="save-data py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-meta-5 text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all text-sm">
                                تسليم
                            </button>
                        </form>
                        <button type="button"
                                class="btn-close-2 py-2.5 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all text-sm">
                            إلغاء الأمر
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

