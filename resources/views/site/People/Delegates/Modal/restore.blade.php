<div id="RestoreDelegate{{ $delegate->id_delegate }}" x-transition=""
     class="modal fixed left-0 top-0 z-999999 hidden h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5">
    <div class="w-full max-w-142.5 rounded-lg bg-white px-8 py-12 text-center dark:bg-boxdark md:px-17.5 md:py-15">
        <span class="mx-auto inline-block">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.1" width="60" height="60" rx="30" fill="#DC2626"></rect>
                <path
                    d="M30 27.2498V29.9998V27.2498ZM30 35.4999H30.0134H30ZM20.6914 41H39.3086C41.3778 41 42.6704 38.7078 41.6358 36.8749L32.3272 20.3747C31.2926 18.5418 28.7074 18.5418 27.6728 20.3747L18.3642 36.8749C17.3296 38.7078 18.6222 41 20.6914 41Z"
                    stroke="#DC2626" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
        <h3 class="mt-5.5 pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
            هل انت متأكد من استعادة هذا المندوب
        </h3>
        <div class="-mx-3 flex flex-wrap gap-y-4">
            <div class="w-full px-3 2xsm:w-1/2">
                <button
                    class="btn-modal-close block w-full rounded border border-stroke bg-gray p-3 text-center font-medium text-black transition hover:border-meta-1 hover:bg-meta-1 hover:text-white dark:border-strokedark dark:bg-meta-4 dark:text-white dark:hover:border-meta-1 dark:hover:bg-meta-1">
                    لا
                </button>
            </div>
            <div class="w-full px-3 2xsm:w-1/2">
                <form action="{{ route('delegates.restore', ['page_id' => $id_page, 'id_delegate' => $delegate->id_delegate]) }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <button type="submit"
                            class="block w-full rounded border border-meta-5 bg-meta-5 p-3 text-center font-medium text-white transition hover:bg-opacity-90">
                        نعم
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
