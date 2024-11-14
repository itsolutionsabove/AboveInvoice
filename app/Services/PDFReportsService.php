<?php

namespace App\Services;

use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as httpResponse;
use Laravel\Sanctum\PersonalAccessToken;
use Modules\Settings\Entities\GeneralSettings;
use Dompdf\FrameReflower\Text;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class PDFReportsService
{

    private $user = null;

    public static function init(): PDFReportsService
    {
        return new self;
    }

    public function authenticate($apikey, $download_token): PDFReportsService
    {

        $token = PersonalAccessToken::findToken($apikey);
        if (!$token) abort(403, 'access denied');
        if ($download_token != md5(request()->ip() . date('mDy'))) abort(400, 'link expired');
        $this->user = $token->tokenable;

        return $this;
    }

    public function prepare($template, $data, $pdfFileName,  $landscape = null , $footer = null , $preview = null , $size = null): httpResponse
    {

        $html = view($template)->with($this->getMergedDate($data))->render();

        if ($preview == "true") {
            return Response::make($this->prepareContent($html, $landscape , $footer), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $pdfFileName . '"',
            ]);
        } else {
            return Response::make($this->prepareContent($html, $landscape , $footer), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $pdfFileName . '"',
            ]);
        }

    }

    private function prepareContent($html, $landscape = null  , $footer = null , $size = null): string
    {
        $pdf = Pdf::loadHTML($this->toArabic($html));

        /* if($footer)
        {
            $pdf->setOption([
                'isRemoteEnabled' => true,
                'footer-html' => view('layouts.pdf-footer')->render()
            ]);
        }
         */

        if ($landscape) {
            if(!empty($size))
            {
                $pdf->setPaper($size, 'landscape');
            }else{

                $pdf->setPaper('A4', 'landscape');
            }
        }

        $pdf->setCallbacks([
            'text' => function ( $text) {
                $pageNumber = $text->get_page_number();
                $totalPages = $text->get_page_count();

                // Custom HTML content for the page text
                $html = '<div style="text-align: center;">Page ' . $pageNumber . ' of ' . $totalPages . '</div>';

                $text->set_text($html);
            }
        ]);

        /* $canvas = $pdf->getCanvas();
        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = "Page $pageNumber of $pageCount";
            $font = $fontMetrics->getFont('monospace');
            $pageWidth = $canvas->get_width();
            $pageHeight = $canvas->get_height();
            $size = 12;
            $width = $fontMetrics->getTextWidth($text, $font, $size);
            $canvas->text($pageWidth - $width - 20, $pageHeight - 20, $text, $font, $size);
        }); */
        return $pdf->output();
    }

    private function getMergedDate($data): array
    {
        return array_merge($data, [
            'user' => $this->user,
            'settings' => $this->getGlobalSettings()
        ]);
    }

    private function getGlobalSettings(): array
    {
        $settings = new GeneralSettings();
        return [
            'name' => $settings->getSettings('lab-name'),
            'phone' => $settings->getSettings('lab-phone-number'),
            'second-phone' => $settings->getSettings('lab-second-phone-number'),
            'fax' => $settings->getSettings('lab-fax-number'),
            'email' => $settings->getSettings('lab-email'),
            'logo' => $settings->getSettings('lab-logo'),
        ];
    }

    private function toArabic($html)
    {

        $Arabic = new Arabic();
        $arabicIdentify = $Arabic->arIdentify($html);

        for ($i = count($arabicIdentify) - 1; $i >= 0; $i -= 2) {
            $utf8ar = $Arabic->utf8Glyphs(substr($html, $arabicIdentify[$i - 1], $arabicIdentify[$i] - $arabicIdentify[$i - 1]));
            $html   = substr_replace($html, $utf8ar, $arabicIdentify[$i - 1], $arabicIdentify[$i] - $arabicIdentify[$i - 1]);
        }

        return $html;
    }
}
