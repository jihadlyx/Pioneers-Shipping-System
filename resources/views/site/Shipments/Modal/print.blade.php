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
</head>
<body>
<div class = "invoice-wrapper" id = "print-area">
    <div class = "invoice">
        <div class = "invoice-container">
            <div class = "invoice-head">
                <div class = "invoice-head-top">
                    <div class = "invoice-head-top-left text-start">
                        <img src = "{{ asset('assets\images\logo\logo.svg') }}" />
                    </div>
                    <div class = "invoice-head-top-right text-end">
                        <h3>فاتورة </h3>
                    </div>
                </div>
                <div class = "hr"></div>
                <div class = "invoice-head-middle">
                    <div class = "invoice-head-middle-left text-start">
                        <p><span class = "text-bold">التاريخ</span>: 05/12/2020</p>
                    </div>
                    <div class = "invoice-head-middle-right text-end">
                        <!-- <p><spanf class = "text-bold">Invoice No:</span>16789</p> -->
                    </div>
                </div>
                <div class = "hr"></div>
                <div class = "invoice-head-bottom">
                    <div class = "invoice-head-bottom-left">
{{--                        <img src="{{ $shipment->generateQrCode() }}" alt="QR Code">--}}
                        {{ $shipment->generateQrCode() }}
                    </div>
                    <div class = "invoice-head-bottom-right">
                        <ul class = "text-end">
                            <li class = "text-bold">إيصال</li>
                            <li> <span class = "text-bold"> الفرع</span> {{ $shipment->customer->branch->title }} </li>
                            <li> <span class = "text-bold"> المستخدم</span> {{ Auth()->user()->getName() }} </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class = "overflow-view">
                <div class = "invoice-body">
                    <table dir="rtl">
                        <thead>
                        <tr>
                            <td class = "text-bold">رقم الشحنة</td>
                            <td class = "text-bold">اسم الشحنة</td>
                            <td class = "text-bold">الزبون</td>
                            <td class = "text-bold">اسم المستلم</td>
                            <td class = "text-bold">رقم هاتف المستلم</td>
                            <td class = "text-bold">عنوان التوصيل</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> {{ $shipment->id_ship }} </td>
                            <td> {{ $shipment->name_ship }} </td>
                            <td> {{ $shipment->customer->name_customer }} </td>
                            <td> {{ $shipment->recipient_name }} </td>
                            <td> 0{{ $shipment->phone_number }} </td>
                            <td> {{ $shipment->city->title }} </td>
                        </tr>
                        </tbody>
                    </table>
                    <div dir="rtl" class = "invoice-body-bottom">
                        <div class = "invoice-body-info-item border-bottom">
                            <div class = "info-item-td text-end text-bold">سعر الشحنة :</div>
                            <div class = "info-item-td text-end"> {{ $shipment->ship_value }} </div>
                        </div>
                        <div class = "invoice-body-info-item border-bottom">
                            <div class = "info-item-td text-end text-bold">سعر التوصيل :</div>
                            <div class = "info-item-td text-end"> {{ $shipment->getPrice() }} </div>
                        </div>
                        <div class = "invoice-body-info-item">
                            <div class = "info-item-td text-end text-bold">الإجمالي :</div>
                            <div class = "info-item-td text-end"> {{ $shipment->ship_value + $shipment->getPrice() }} </div>
                        </div>
                    </div>
                </div>
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
