<?php

require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment as LabelLabelAlignment;
use Endroid\QrCode\LabelAlignment;


$text = $_POST['text'];

$qr_code = QrCode::create($text)
                ->setSize(600)
                ->setMargin(40)
                ->setForegroundColor(new Color(232, 12, 12))
                ->setBackgroundColor(new Color(255, 255, 255))
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::High);

$label = Label::create("This is a label")
              ->setTextColor(new Color(255, 0, 0))
              ->setAlignment(LabelLabelAlignment::Left);

$logo = Logo::create('qr-logo.png')
            ->setResizeToWidth(150);

$writer = new PngWriter;

$result = $writer->write($qr_code, logo: $logo, label: $label);

// Output the QR code image to the browser
header("Content-Type: " . $result->getMimeType());

echo $result->getString();

// Save the image to a file
$result->saveToFile("Qr_Code.png");