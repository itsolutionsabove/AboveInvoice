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
{{--        font-size: 25px;--}}
{{--      }--}}
{{--      .pre_table .lower .middle {--}}
{{--        padding: 10px 50px;--}}
{{--        background-color: #e7e7e7;--}}
{{--        font-size: 25px;--}}
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
{{--        font-size: 20px;--}}
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
{{--        font-size: 25px;--}}
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
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>فاتورة ضريبية</title>
    <style>
        * {
          font-family: DejaVu Sans, sans-serif;
      }

      body * {
          font-family: DejaVu Sans, sans-serif;
          direction: rtl;
          text-align: right;
      }
        .container {
            padding: 20px;
            margin: 0 auto;
            width: 80%;
            border: 1px solid #000;
        }
        h1, h3, p {
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #000;
            text-align: center;
            font-size: 18px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>فاتورة ضريبية</h1>
    <h3>رقم الفاتورة: {{ $invoice_number }}</h3>
    <h3>تاريخ الفاتورة: {{ $invoice_date }}</h3>

    <p>اسم العميل: {{ $client_name }}</p>
    <p>عنوان العميل: {{ $client_address }}</p>
    <p>رقم ضريبي للعميل: {{ $client_tax_number }}</p>

    <table>
        <thead>
        <tr>
            <th>الوصف</th>
            <th>السعر</th>
            <th>الضريبة</th>
            <th>الإجمالي</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>تصاميم حملة عمان</td>
            <td>2500 ريال سعودي</td>
            <td>375 ريال سعودي</td>
            <td>2875 ريال سعودي</td>
        </tr>
        <!-- Add more rows as needed -->
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3">الإجمالي النهائي</td>
            <td>2875 ريال سعودي</td>
        </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>هذا المستند صادر من النظام ولا يحتاج الي توقيع او اختام</p>
    </div>
</div>
</body>
</html>
