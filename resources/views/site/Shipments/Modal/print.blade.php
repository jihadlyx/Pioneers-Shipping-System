<!DOCTYPE html>
<html dir="">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @vite('resources/css/app.css')
</head>
<body>
<div class = "invoice-wrapper" id = "print-area">
    <div class = "invoice">
        <div class = "invoice-container">
            <div class = "invoice-head">
                <div class = "invoice-head-top">
                    <div class = "invoice-head-top-left text-black-2 text-start">
{{--                        <img src = "{{ asset('assets\images\logo\logo.svg') }}" />--}}
                        <span>
                            @foreach($branches as $index => $branch )
                                @if(($branches->count()-1) == $index)
                                    {{ $branch->title }}
                                @else
                                    {{ $branch->title }} -
                                @endif

                            @endforeach
                        </span>

                    </div>
                    <div class = "invoice-head-top-right text-black-2 text-title-md text-end">
                        شركة كويك ديلفري
                        <p></p>
                        {{ $shipment->customer->branch->title }}
                    </div>
                </div>
                <div class = "invoice-head-middle flex justify-between items-end">
                    <div class = "invoice-head-middle-left text-start">
                        <p><span class = "text-bold">التاريخ</span>: {{ date('Y-m-d') }}</p>
                    </div>
                    <div class = "invoice-head-middle-right text-end">
                        <!-- <p><spanf class = "text-bold">Invoice No:</span>16789</p> -->
                        {{ $shipment->generateQrCode() }}
                    </div>
                </div>
                <div class = "hr"></div>
                <div class = "invoice-head-bottom text-title-md flex justify-center text-black-2">
                        فاتورة ( {{ $shipment->id_ship }} )
                </div>
            </div>
            <div class = "border-2 rounded py-4 px-6">
                <div class="invoice-details text-lg" dir="rtl">
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">اسم الزبون: </span> {{ $shipment->customer->name_customer }}</p>
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">رقم الشحنة: </span> {{ $shipment->id_ship }}</p>
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">اسم المستلم: </span> {{ $shipment->recipient_name }}</p>
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">هاتف المستلم: </span> 0{{ $shipment->phone_number }}</p>
                    <p class="flex gap-4 mb-2 {{ $shipment->phone_number2 == null ? 'hidden' : '' }}"><span class="text-black-2 font-bold text-xl">هاتف المستلم الاحتياطي: </span> 0{{ $shipment->phone_number2 }}</p>
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">اسم المدينة او المنطقة: </span> {{ $shipment->city->title }}</p>
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">عنوان التوصيل: </span> {{ $shipment->address }}</p>
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">سعر الشحنة: </span> {{ $shipment->ship_value }}</p>
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">سعر التوصيل: </span> {{ $shipment->getPrice() }}</p>
                    <p class="flex gap-4 mb-2"><span class="text-black-2 font-bold text-xl">الإجمالي: </span> {{ $shipment->getPrice() + $shipment->ship_value    }}</p>
                </div>
            </div>
            <div class="mt-3 text-center text-black-2">
                هاتف الفرع
                0{{ $shipment->customer->branch->phone_number }}
                {{ $shipment->customer->branch->phone_number2 == null ? '' : 0 . $shipment->customer->branch->phone_number2 }}
            </div>
        </div>
    </div>
</div>

<!-- تحميل مكتبة jsPDF -->
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.4.0/dist/jspdf.umd.min.js"></script>

<script>
    // استدعاء الدالة createPDF عند تحميل الصفحة
    window.onload = function () {
        window.print();
        window.addEventListener('afterprint', function() {
            window.close()
        });
    };


    // دالة لإنشاء وتنزيل ملف PDF
    function createPDF() {
        // إنشاء ملف jsPDF جديد
        const doc = new jsPDF();
        // إضافة الصفحة الحالية إلى الملف PDF
        doc.html(document.body, {
            callback: function(doc) {
                // تنزيل الملف PDF باسم 'example.pdf'
                doc.save('example.pdf');
            }
        });
    }
</script>


</body>
</html>
