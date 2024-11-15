{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--  <head>--}}
{{--    <meta charset="UTF-8" />--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0" />--}}
{{--    <title>Document</title>--}}
{{--  </head>--}}
{{--  <body dir="rtl">--}}
{{--    <style>--}}
{{--      /*@font-face {*/--}}
{{--      /*  font-family: Cairo;*/--}}
{{--      /*  src: url(Cairo-VariableFont_slnt.ttf);*/--}}
{{--      /*}*/--}}
{{--      /** {*/--}}
{{--      /*  margin: 0;*/--}}
{{--      /*  padding: 0;*/--}}
{{--      /*  box-sizing: border-box;*/--}}
{{--      /*  font-family: Cairo;*/--}}
{{--      /*}*/--}}
{{--      /*body {*/--}}
{{--      /*  position: relative;*/--}}
{{--      /*}*/--}}

{{--      * {--}}
{{--          font-family: DejaVu Sans, sans-serif;--}}
{{--      }--}}

{{--      body * {--}}
{{--          font-family: DejaVu Sans, sans-serif;--}}
{{--      }--}}
{{--      .bg-img {--}}
{{--        position: absolute;--}}
{{--        left: 0;--}}
{{--        top: 0;--}}
{{--        width: 100%;--}}
{{--        height: 100%;--}}
{{--        z-index: -10;--}}
{{--      }--}}
{{--      .container {--}}
{{--        padding: 150px 50px 400px;--}}
{{--      }--}}
{{--      .w-100 {--}}
{{--        width: 100%;--}}
{{--      }--}}
{{--      .pre_table .upper {--}}
{{--        display: flex;--}}
{{--        justify-content: space-between;--}}
{{--        align-items: center;--}}
{{--      }--}}
{{--      .pre_table {--}}
{{--        margin-top: 20px;--}}
{{--      }--}}
{{--      .pre_table .lower {--}}
{{--        display: flex;--}}
{{--        justify-content: space-between;--}}
{{--        align-items: center;--}}
{{--        margin-top: 40px;--}}
{{--      }--}}
{{--      .pre_table .lower > .right {--}}
{{--        display: flex;--}}
{{--        align-items: center;--}}
{{--        gap: 20px;--}}
{{--      }--}}
{{--      h3 {--}}
{{--        font-size: 15px;--}}
{{--      }--}}
{{--      .pre_table .lower .middle {--}}
{{--        padding: 10px 50px;--}}
{{--        background-color: #e7e7e7;--}}
{{--        font-size: 15px;--}}
{{--        font-weight: 700;--}}
{{--        border-radius: 10px;--}}
{{--        border: 2px solid black;--}}
{{--      }--}}
{{--      .pre_table .lower .bottom {--}}
{{--        text-align: center;--}}
{{--      }--}}
{{--      .barcode_section {--}}
{{--        margin-top: 20px;--}}
{{--        display: flex;--}}
{{--        justify-content: space-between;--}}
{{--        border: 2px solid black;--}}
{{--        padding: 10px;--}}
{{--      }--}}
{{--      .barcode_section > .right {--}}
{{--        display: flex;--}}
{{--        align-items: center;--}}
{{--        gap: 20px;--}}
{{--      }--}}
{{--      .barcode_section > .left {--}}
{{--        line-height: 1.2;--}}
{{--      }--}}
{{--      .barcode_section p {--}}
{{--        font-size: 10px;--}}
{{--        margin-bottom: 15px;--}}
{{--      }--}}
{{--      .table_section table {--}}
{{--        width: 100%;--}}
{{--        margin: 4px 0 0;--}}
{{--        padding: 0;--}}
{{--        border-collapse: collapse;--}}
{{--      }--}}
{{--      .table_section table * {--}}
{{--        text-align: start;--}}
{{--        font-size: 15px;--}}
{{--        line-height: 1.2;--}}
{{--      }--}}
{{--      .table-auto {--}}
{{--        width: calc((100% / 5));--}}
{{--      }--}}
{{--      .table-lg {--}}
{{--        width: calc((100% / 4) * 2);--}}
{{--      }--}}
{{--      .table_section table thead {--}}
{{--        background-color: #e7e7e7;--}}
{{--      }--}}
{{--      .table_section table th {--}}
{{--        font-weight: 700;--}}
{{--        padding: 20px 10px;--}}
{{--        border: 2px solid black;--}}
{{--      }--}}
{{--      .table_section table td {--}}
{{--        padding: 20px 10px;--}}
{{--        border: 2px solid black;--}}
{{--      }--}}
{{--      .table_section table tfoot td {--}}
{{--        padding: 0;--}}
{{--      }--}}
{{--      .table_section table .totals {--}}
{{--        display: flex;--}}
{{--        padding: 20px 10px;--}}
{{--        gap: 50px;--}}
{{--      }--}}
{{--      .table_section table h3 {--}}
{{--        width: 150px;--}}
{{--      }--}}
{{--      .table_section table .subtotal {--}}
{{--        display: flex;--}}
{{--        gap: 50px;--}}
{{--        border-top: 2px solid black;--}}
{{--        margin-top: 10px;--}}
{{--        padding: 20px 10px;--}}
{{--      }--}}

{{--      .pre_footer .signs {--}}
{{--        display: flex;--}}
{{--        justify-content: space-between;--}}
{{--        align-items: center;--}}
{{--        margin-top: 60px;--}}
{{--      }--}}
{{--      .pre_footer .signs h3 {--}}
{{--        position: relative;--}}
{{--      }--}}
{{--      .pre_footer .signs h3::before {--}}
{{--        position: absolute;--}}
{{--        content: "";--}}
{{--        left: 0;--}}
{{--        bottom: 3px;--}}
{{--        width: 100%;--}}
{{--        height: 2px;--}}
{{--        background-color: black;--}}
{{--      }--}}
{{--      footer .contain {--}}
{{--        position: absolute;--}}
{{--        bottom: 20px;--}}
{{--        right: 40px;--}}
{{--        display: flex;--}}
{{--        align-items: center;--}}
{{--        justify-content: center;--}}
{{--        gap: 20px;--}}
{{--      }--}}
{{--    </style>--}}
{{--    <div class="container">--}}
{{--      <section class="pre_table">--}}
{{--        <div class="upper">--}}
{{--          <h3>فرع السعودية</h3>--}}
{{--          <h3>شارع الملك عبدالله-الرياض- مكتب رقم 160</h3>--}}
{{--        </div>--}}
{{--        <div class="lower">--}}
{{--          <div class="right">--}}
{{--            <div class="right">--}}
{{--              <h3>رقم الفاتورة</h3>--}}
{{--              <h3>تاريخ الفاتورة</h3>--}}
{{--            </div>--}}
{{--            <div class="left">--}}
{{--              <h3>00001</h3>--}}
{{--              <h3>10-8-2024</h3>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="middle">فاتورة ضريبية Tax Invoice</div>--}}
{{--          <div class="bottom">--}}
{{--            <h3>الرقم الضريبي</h3>--}}
{{--            <h3>312231989500003</h3>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </section>--}}
{{--      <section class="barcode_section">--}}
{{--        <div class="right">--}}
{{--          <div class="right">--}}
{{--            <p>الوصف</p>--}}
{{--            <p>العميل</p>--}}
{{--            <p>عنوان العميل</p>--}}
{{--            <p>رقم ضريبي للعميل</p>--}}
{{--          </div>--}}
{{--          <div class="left">--}}
{{--            <p>:</p>--}}
{{--            <p>:</p>--}}
{{--            <p>:</p>--}}
{{--            <p>:</p>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="left">--}}
{{--          <h3 dir="ltr">IBAN: SA22 1500 0426 1425 5598 0007</h3>--}}
{{--          <h3>بنك البلاد, فرع النسيم الشرقي, شارع حسان بن ثابت</h3>--}}
{{--        </div>--}}
{{--      </section>--}}
{{--      <section class="table_section">--}}
{{--        <table>--}}
{{--          <thead>--}}
{{--            <tr>--}}
{{--              <th class="table-lg">الصنف</th>--}}
{{--              <th class="table-auto">السعر</th>--}}
{{--              <th class="table-auto">الضريبة</th>--}}
{{--              <th class="table-auto">الاجمالي</th>--}}
{{--            </tr>--}}
{{--          </thead>--}}
{{--          <tbody>--}}
{{--            <tr>--}}
{{--              <td>تصاميم حملة عمان</td>--}}
{{--              <td>--}}
{{--                <div>2500</div>--}}
{{--                <div>ريال سعودي</div>--}}
{{--              </td>--}}
{{--              <td>--}}
{{--                <div>375</div>--}}
{{--                <div>ريال سعودي</div>--}}
{{--              </td>--}}
{{--              <td>--}}
{{--                <div>2875</div>--}}
{{--                <div>ريال سعودي</div>--}}
{{--              </td>--}}
{{--            </tr>--}}
{{--          </tbody>--}}
{{--          <tfoot>--}}
{{--            <tr>--}}
{{--              <td--}}
{{--                colspan="3"--}}
{{--                style="--}}
{{--                  vertical-align: bottom;--}}
{{--                  padding-bottom: 20px;--}}
{{--                  padding-right: 10px;--}}
{{--                "--}}
{{--              >--}}
{{--                <h3 style="width: 100%">--}}
{{--                  الفان وثمانمائة وخمسة وسبعون ريالا لاغير--}}
{{--                </h3>--}}
{{--              </td>--}}
{{--              <td colspan="2">--}}
{{--                <div class="totals">--}}
{{--                  <div class="right">--}}
{{--                    <h3>السعر</h3>--}}
{{--                    <h3>قيمة الضريبة</h3>--}}
{{--                  </div>--}}
{{--                  <div class="middle">--}}
{{--                    <h3>2500</h3>--}}
{{--                    <h3>375</h3>--}}
{{--                  </div>--}}
{{--                  <div class="left">--}}
{{--                    <h3>ر.س</h3>--}}
{{--                    <h3>ر.س</h3>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="subtotal">--}}
{{--                  <div class="right">--}}
{{--                    <h3>الصافي</h3>--}}
{{--                  </div>--}}
{{--                  <div class="middle">--}}
{{--                    <h3>2875</h3>--}}
{{--                  </div>--}}
{{--                  <div class="left">--}}
{{--                    <h3>ر.س</h3>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </td>--}}
{{--            </tr>--}}
{{--          </tfoot>--}}
{{--        </table>--}}
{{--      </section>--}}
{{--      <section class="pre_footer">--}}
{{--        <h3 style="text-align: center; margin-top: 20px">--}}
{{--          هذا المستند صادر من النظام ولا يحتاج الي توقيع او اختام--}}
{{--        </h3>--}}
{{--        <div class="signs">--}}
{{--          <h3>جهز بواسطة</h3>--}}
{{--          <h3>استلم بواسطة</h3>--}}
{{--          <h3>اعتمد بواسطة</h3>--}}
{{--        </div>--}}
{{--      </section>--}}
{{--    </div>--}}
{{--    <img src="./invoice.png" alt="" class="bg-img">--}}
{{--  </body>--}}
{{--</html>--}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>
<style>
    @font-face {
        font-family: DejaVu Sans, sans-serif;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: DejaVu Sans, sans-serif;
    }
    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 12px;
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
        font-size: 15px;
        font-weight: bold;
        text-align: start;
    }
    table td {
        vertical-align: baseline;
    }
    table th .middle {
        padding: 10px 50px !important;
        background-color: #e7e7e7;
        font-size: 15px;
        font-weight: 700;
        border-radius: 10px;
        border: 2px solid black;
        text-align: center;
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
        padding: 20px 10px;
        border: 2px solid black;
    }
    .table_section table td {
        padding: 20px 10px;
        border: 2px solid black;
    }
    .pre_footer .signs h3 {
        position: relative;
        font-size: 15px;
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
</style>
<body dir="rtl">
<div class="overlay">
    <img style="width: 100% ; height: 100%; display: block" src="{{public_path('invoice.png')}}" alt="" class="bg-img" />
</div>
<div class="container">
    <table>
        <tbody>
        <tr>
            <th colspan="2">فرع السعودية</th>
            <th style="text-align: end">
                شارع الملك عبدالله-الرياض- مكتب رقم 160
            </th>
        </tr>
        <tr>
            <th style="width: calc(100% / 3); padding-top: 30px">
                <div>رقم الفاتورة &nbsp; 00001</div>
                <div>تاريخ الفاتورة &nbsp; 2024-8-10</div>
            </th>
            <th style="width: calc(100% / 3); padding-top: 30px">
                <div class="middle">فاتورة ضريبية Tax Invoice</div>
            </th>
            <th
                style="text-align: end; width: calc(100% / 3); padding-top: 30px"
            >
                <div>الرقم الضريبي</div>
                <div>312231989500003</div>
            </th>
        </tr>
        </tbody>
    </table>
    <table>
        <tbody>
        <tr>
            <td style="font-size: 10px; padding-right: 10px; padding-top: 10px">
                <span style="width: 170px; display: inline-block">الوصف</span>
                <span style="display: inline-block">:</span>
            </td>
            <th
                style="
                text-align: end;
                line-height: 1.2;
                padding-left: 10px;
                padding-top: 10px;
              "
            >
                <div>IBAN: SA22 1500 0426 1425 5598 0007</div>
                <div>بنك البلاد, فرع النسيم الشرقي, شارع حسان بن ثابت</div>
            </th>
        </tr>
        <tr>
            <td
                style="font-size: 10px; padding-bottom: 10px; padding-right: 10px"
            >
                <span style="width: 170px; display: inline-block">العميل</span>
                <span style="display: inline-block">:</span>
            </td>
        </tr>
        <tr>
            <td
                style="font-size: 10px; padding-bottom: 10px; padding-right: 10px"
            >
              <span style="width: 170px; display: inline-block"
              >عنوان العميل</span
              >
                <span style="display: inline-block">:</span>
            </td>
        </tr>
        <tr>
            <td
                style="font-size: 10px; padding-bottom: 10px; padding-right: 10px"
            >
              <span style="width: 170px; display: inline-block"
              >رقم ضريبي للعميل</span
              >
                <span style="display: inline-block">:</span>
            </td>
        </tr>
        </tbody>
    </table>
    <section class="table_section">
        <table style="margin-top: 4px">
            <thead>
            <tr>
                <th style="padding: 10px; width: 30%">الصنف</th>
                <th style="padding: 10px">السعر</th>
                <th style="padding: 10px">الضريبة</th>
                <th style="padding: 10px; width: 35%">الاجمالي</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td >
                    تصاميم حملة عمان
                </td>
                <td >
                    <div>2500</div>
                    <div>ريال سعودي</div>
                </td>
                <td >
                    <div>375</div>
                    <div>ريال سعودي</div>
                </td>
                <td >
                    <div>2875</div>
                    <div>ريال سعودي</div>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td
                    colspan="3"
                >
                    <h3 style="width: 100%; font-size: 15px">
                        الفان وثمانمائة وخمسة وسبعون ريالا لاغير
                    </h3>
                </td>
                <td colspan="2" style="padding: 0">
                    <table style="line-height: 1.2">
                        <tr>
                            <th

                            >
                                السعر
                            </th>
                            <th


                            >
                                2500
                            </th>
                            <th

                            >
                                ر.س
                            </th>
                        </tr>
                        <tr>
                            <th

                            >
                                قيمة الضريبة
                            </th>
                            <th

                            >
                                375
                            </th>
                            <th

                            >
                                ر.س
                            </th>
                        </tr>
                        <tr style="border-top: 2px solid black">
                            <th

                            >
                                الصافي
                            </th>
                            <th

                            >
                                2875
                            </th>
                            <th

                            >
                                ر.س
                            </th>
                        </tr>
                    </table>
                </td>
            </tr>
            </tfoot>
        </table>
    </section>
    <section class="pre_footer">
        <h3 style="text-align: center; margin-top: 20px;font-size: 15px;">
            هذا المستند صادر من النظام ولا يحتاج الي توقيع او اختام
        </h3>
        <table style="margin-top: 50px" class="signs">
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

</body>
</html>
