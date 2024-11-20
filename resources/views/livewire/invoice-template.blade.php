
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
</head>
<style>
    @font-face {
        font-family: Cairo;
        src: url("{{ public_path('fonts/Cairo-VariableFont_slnt.ttf') }}");
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        /*font-family: DejaVu Sans, sans-serif;*/
        font-family: Cairo, sans-serif !important;
    }

    .container {
        padding: 150px 30px 10px ;
        /*min-height: 500px;*/
    }
    body {
        /*font-family: 'DejaVu Sans', sans-serif;*/
        font-size: 12px;
        font-family: Cairo, sans-serif !important;
    }

    th{
        font-family: Cairo , sans-serif !important;
    }
    .overlay{
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    /* Here */
    table {
        width: 100%;
        text-align: start !important;
        border-collapse: collapse;
    }
    table th {
        font-size: 13px;
        font-weight: bold;
        text-align: start;
    }
    /*table td {*/
    /*    vertical-align: baseline;*/
    /*}*/
    table th .middle {
        padding: 5px 20px !important;
        background-color: #e7e7e7;
        font-size: 13px;
        font-weight: 700;
        border-radius: 10px;
        border: 2px solid black;
        transform: translateX(-100px);
    }
    /* Here */
    .bg-img {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: -10;
    }
    .table-auto {
        width: calc((100% / 5));
    }
    .table-lg {
        width: calc((100% / 4) * 2);
    }
    .table_section table thead {
        background-color: #e7e7e7;
    }
    .table_section table th {
        font-weight: 700;
        padding: 0 10px;
        border: 2px solid black;
    }
    .table_section table td {
        padding: 0 10px;
        border: 2px solid black;
    }
    .pre_footer .signs h3 {
        position: relative;
        font-size: 13px;
    }
    .pre_footer .signs h3::before {
        position: absolute;
        content: "";
        left: 0;
        /*bottom: 3px;*/
        width: 100%;
        /*height: 2px;*/
        background-color: black;
    }
    th , h3 , td{
        font-family: Cairo , sans-serif !important;
        font-weight: 400 !important;
        padding-top: 0 !important;
        margin-top: 0 !important;
    }


</style>
<body>
<div class="overlay">
{{--    <img style="width: 100% ; height: 100%; display: block" src="{{public_path('invoice.png')}}" alt="" class="bg-img" />--}}
    <img style="width: 100% ; height: 100%; display: block" src="{{public_path('hover.jpeg')}}" alt="" class="bg-img" />
</div>

    <img style="height: 100px; width: 100%" src="{{public_path('nav.jpeg')}}" alt="" />


<div class="container" style="padding-top:10px">
    <table>
        <tbody>
        <tr>
            <th>
               <div style="text-align: left"> {{$settingData['address']}}</div>
            </th>
            <th colspan="2">
                <div style="text-align: right">فرع {{$branch}}</div>
            </th>
        </tr>
        <tr>
            <th
                style="text-align: start; padding-top: 0; width: calc(100% / 3)"
            >
                <div style="text-align: left">
                    <div>الرقم الضريبي</div>
                    <div>{{$settingData['tax_number']}}</div>
                </div>
            </th>
            <th style="text-align: center; padding-top: 0; width: calc(100% / 3)">
                <div class="middle">
                <table style="transform: translateY(-5px)">
                    <thead>
                    <tr>
                        <th>فاتورة ضريبية Tax Invoice</th>
                    </tr>
                    </thead>
                </table>
                </div>
            </th>
            <th style="padding-top: 0; width: calc(100% / 3)">
                <div style="text-align: right">
                    <div> رقم الفاتورة  : {{$invoice_number}}</div>
                    <div> تاريخ الفاتورة : {{$invoice_date}}</div>
                </div>
            </th>
        </tr>
        </tbody>
    </table>
    <table style="margin-top: 10px; border: 2px solid black">
        <tbody>
        <tr>
            @if($show_qr)
            <th
                style="
                line-height: 0.5;
                padding-left: 10px;
                padding-top: 10px !important;
                padding-bottom: 10px !important;
                text-align: left;
              "
            >
                <div>
                    <div>IBAN: SA22 1500 0426 1425 5598 0007</div>
                    <div>بنك البلاد, فرع النسيم الشرقي, شارع حسان بن ثابت</div>
                    <div>
                        <img style="width: 100px; height: 100px" src="{{public_path('qr.png')}}" alt="" />
                    </div>
                </div>
            </th>
            @else
                <th
                    style="
                line-height: 0.5;
                padding-left: 10px;
                text-align: left;
              "
                >
                    <div>
                        <div>IBAN: SA22 1500 0426 1425 5598 0007</div>
                        <div>بنك البلاد, فرع النسيم الشرقي, شارع حسان بن ثابت</div>
                    </div>
                </th>
            @endif

            <td style="font-size: 13px; padding-right: 10px; padding-top: 0;text-align: right;line-height: 0.8">
                <div>

                    <div style="text-align: end">
                        <span style="display: inline-block">{{$client_name}}</span>
                        <span style="display: inline-block">:</span>
                        <span style="width: 130px; display: inline-block">العميل</span>
                    </div>
                    <div style="text-align: right">
                        <span style="display: inline-block">{{$client_address}}</span>
                        <span style="display: inline-block">:</span>
                        <span style="width: 130px; display: inline-block">عنوان العميل</span>
                    </div>
                    <div style="text-align: end">
                        <span style="display: inline-block">{{$client_tax_number}}</span>
                        <span style="display: inline-block">:</span>
                        <span style="width: 130px; display: inline-block">رقم ضريبي العميل</span>
                    </div>
                    <div style="text-align: end">
                        <span style="display: inline-block">{{$client_phone}}</span>
                        <span style="display: inline-block">:</span>
                        <span style="width: 130px; display: inline-block">الهاتف</span>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <section class="table_section">
        <table style="margin-top: 4px">
            <thead>
            <tr>
                <th style="padding: 10px; text-align: right">الاجمالي</th>
                <th style="padding: 10px; text-align: right">الضريبة</th>
                <th style="padding: 10px; text-align: right">السعر</th>
                <th style="padding: 10px; text-align: right">الصنف</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <?php
                    $tax_percentage_item = $item['price'] * 0.15;
                    $total_price_after_tax_item = $item['price'] + $tax_percentage_item;
                    ?>
                <tr>
                    <td style="text-align: right">
                        <span>{{$settingData['currency']}}</span>
                        <span style="font-weight: bold">{{$total_price_after_tax_item}}</span>

                    </td>
                    <td style="text-align: right">
                        <span>{{$settingData['currency']}}</span>
                        <span style="font-weight: bold">{{$tax_percentage_item}}</span>

                    </td>
                    <td style="text-align: right">
                        <span>{{$settingData['currency']}}</span>
                        <span style="font-weight: bold">{{$item['price']}}</span>
                    </td>
                    <td style="text-align: right ; font-size: 13px">
                        {{$item['name']}}
                    </td>
                </tr>
            @endforeach
{{--            <tr>--}}
{{--                <td style="text-align: right">--}}
{{--                    <span>ريال سعودي</span>--}}
{{--                    <span style="font-weight: bold">2875</span>--}}

{{--                </td>--}}
{{--                <td style="text-align: right">--}}
{{--                    <span>ريال سعودي</span>--}}
{{--                    <span style="font-weight: bold">375</span>--}}

{{--                </td>--}}
{{--                <td style="text-align: right">--}}
{{--                    <span>ريال سعودي</span>--}}
{{--                    <span style="font-weight: bold">2500</span>--}}
{{--                </td>--}}
{{--                <td style="text-align: right ; font-size: 13px">--}}
{{--                    تصاميم حملة عمان--}}
{{--                </td>--}}
{{--            </tr>--}}
            </tbody>
            <tfoot>
            <tr>
                <td colspan="1" style="padding: 0">
                    <table style="text-align: left; width: 100%;">
                        <tr style="border-top: 2px solid black">
                            <th>{{$settingData['currency']}}</th>
                            <th>{{$total_price}}</th>
                            <th>السعر</th>
                        </tr>
                        <tr>
                            <th>{{$settingData['currency']}}</th>
                            <th>{{$tax_percentage}}</th>
                            <th>قيمة الضريبة</th>
                        </tr>

                        <tr>
                            <th>{{$settingData['currency']}}</th>
                            <th>{{$total_price_after_tax}}</th>
                            <th>السعرالإجمالى</th>
                        </tr>
                    </table>
                </td>
                <td colspan="3">
                    <h3 style="width: 100%; font-size: 13px; text-align: right;">
                        {{$total_amount}}
                    </h3>
                </td>
            </tr>
            </tfoot>
        </table>
    </section>
    <section class="pre_footer">
        <h3 style="text-align: center; margin-top: 20px;font-size: 13px;">
            هذا المستند صادر من النظام ولا يحتاج الي توقيع او اختام
        </h3>
        <table style="margin-top: 10px" class="signs">
            <tbody>
            <tr>
                <th style="width: calc(100% / 3)">
                    <h3 style="display: inline-block">جهز بواسطة</h3>
                </th>
                <th style="text-align: center; width: calc(100% / 3)">
                    <h3 style="display: inline-block">استلم بواسطة</h3>
                </th>
                <th style="text-align: end; width: calc(100% / 3)">
                    <h3 style="display: inline-block">اعتمد بواسطة</h3>
                </th>
            </tr>
            </tbody>
        </table>
    </section>
</div>

<img style="width: 100% ; height: 100px ; position: fixed; left: 0;bottom: 0" src="{{public_path('footer.jpeg')}}" alt="" />

</body>
</html>
