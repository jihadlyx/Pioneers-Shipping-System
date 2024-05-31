<div class="{{ Session::has('message') ? 'flex' : 'hidden' }} min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover" id="modal-id">
    <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
        <!--content-->
        <div class="">
            <!--body-->
            <div class="text-center p-5 flex-auto justify-center ">
                @if(Session::has('message') && Session::get('message')["type"] === 'success')
                    <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
                        <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                        </path>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                @endif
                <h2 class="text-2xl font-bold py-4 ">{{ Session::has('message') ? Session::get('message')["title"] : '' }}</h2>
                    <p class="text-lg text-gray-500 px-8">
                        {{ Session::has('message') ? Session::get('message')["text"] : ''}}
                    </p>
            </div>
            <!--footer-->
            <div class="p-3  mt-2 text-center space-x-4 md:block">
                <button id="btn-close-modal" class=" mb-2 md:mb-0 {{ Session::has('message') ? Session::get('message')["type"] === 'success' ? 'bg-meta-3 border-meta-3' : 'bg-red-500 border border-red-500' : ''}}  px-5 py-2 text-md shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg ">
                    حسنا
                </button>
            </div>
        </div>
    </div>
</div>
