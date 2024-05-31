<div id="DeleteCustomer{{ $customer->customer_id }}" x-transition=""
    class="modal fixed left-0 top-0 z-999999 hidden h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5">
    <div  class="w-full max-w-142.5 rounded-lg bg-white px-8 py-12 text-center dark:bg-boxdark md:px-17.5 md:py-15">
        <span class="mx-auto inline-block">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
        </span>
        <h3 class="mt-5.5 pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
          هل انت متأكد من حذف هذا الزبون
        </h3>
        <p class="mb-10 font-medium">
          اذا قمت بحذف هذا الزبون فسيتم نقله الى سلة المحذوفات
        </p>
        <div class="-mx-3 flex flex-wrap gap-y-4">
          <div class="w-full px-3 2xsm:w-1/2">
            <button class="btn-modal-close block w-full rounded border border-stroke bg-gray p-3 text-center font-medium text-black transition hover:border-meta-1 hover:bg-meta-1 hover:text-white dark:border-strokedark dark:bg-meta-4 dark:text-white dark:hover:border-meta-1 dark:hover:bg-meta-1">
              لا
            </button>
          </div>
          <div class="w-full px-3 2xsm:w-1/2">
              <form action="{{ route('customers.destroy', ['page_id' => $id_page, 'customer_id' => $customer->customer_id]) }}" method="POST">
                  @csrf
                  @method("DELETE")
                  <button type="submit"
                          class="block w-full rounded border border-meta-1 bg-meta-1 p-3 text-center font-medium text-white transition hover:bg-opacity-90">
                      نعم
                  </button>
              </form>
          </div>
        </div>
      </div>
</div>
