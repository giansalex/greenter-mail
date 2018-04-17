<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 20/02/2018
 * Time: 05:57 PM
 */

namespace Tests\Greenter\Mail;

//require __DIR__ . '/Util.php';
use Tests\Greenter\Mail\Util;

use Greenter\Ws\Services\SunatEndpoints;

use Greenter\Model\Sale\Document;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;

use Greenter\Report\HtmlReport;
use Greenter\Report\PdfReport;
use Greenter\Model\DocumentInterface;
use Greenter\Notify\Notification;
use Greenter\Notify\Attachment;
use Greenter\Mail\MailNotificator;
use Greenter\Mail\MailServer;
use Greenter\Mail\MailEmail;
use Greenter\Mail\Config\ConfigGmail;

class MailNotificatorTest extends \PHPUnit_Framework_TestCase{

    public function testNotification(){

        $response = array('success' => true, 'error' => false, 'code' => 0, 'message' => '');

    	$config = [
    		'SMTPDebug' => 2,
    		'isSMTP' => true,
    		'Host' => 'smtp.gmail.com',
    		'SMTPAuth' => true,
            'Username' => 'fake@gmail.com',
            'Password' => 'pass',
    		'SMTPSecure' => 'tls',
    		'Port' => 587
    	];
        
        $util = Util::getInstance();
        $see = $util->getSee(SunatEndpoints::FE_BETA);
        $result = $see->send($this->getInvoice($util));

        if ($result->isSuccess()){
        	$mailServer = new MailServer($config, MailServer::DEBUG);
            $mailServer->setSender(new MailEmail('fake@gmail.com', 'CORREO PRUEBA 1'));
            $mailServer->setReceipt(new MailEmail('Appee1975@dayrep.com', 'CORREO PRUEBA 2')); //fakemailgenerator.com

            $notification = new Notification();
            $notification->setDocument($invoice);
            $xml = new Attachment();
            $xml->setName($invoice->getName() . '.xml');
            $xml->setContent($see->getFactory()->getLastXml());
            $xml->setType('application/xml');
            $pdf = new Attachment();
            $pdf->setName($invoice->getName() . '.pdf');
            $contentPdf = $util->getPdf($invoice);
            $pdf->setContent($contentPdf);
            $pdf->setType('application/pdf');
            $notification->setFiles([$xml, $pdf]);

            $logo = file_get_contents(__DIR__ . '/../resources/logo.png');
            $options = [
                'system' => [
                    'logo' => $logo
                ],
                'user' => [
                    'url_consulta' => 'http://',
                    'telefono' => '000-0000',
                    'horario_atencion' => 'Lunes a Viernes de 9:00am a 1:00pm y de 2:00pm a 6:00pm, S&aacute;bados de 9:00am a 1:00pm'
                ]
            ];
            $mailNotificator = new MailNotificator($mailServer);
            $response = $mailNotificator->notify($notification, $options);
        } else {
            $response['error'] = true;
            $response['message'] = $result->getError();
        }
        var_dump($response);

    }

    private function getinvoice($util){
        $invoice = new Invoice();
        $invoice
            ->setFecVencimiento(new \DateTime())
            ->setTipoDoc('01')
            ->setSerie('F001')
            ->setCorrelativo('123')
            ->setFechaEmision(new \DateTime())
            ->setTipoMoneda('PEN')
            ->setGuias([
                (new Document())
                ->setTipoDoc('09')
                ->setNroDoc('001-213')
            ])
            ->setClient($util->getClient())
            ->setMtoOperGravadas(200)
            ->setMtoOperExoneradas(0)
            ->setMtoOperInafectas(0)
            ->setMtoIGV(36)
            ->setMtoImpVenta(2236.43)
            ->setCompany($util->getCompany());

        $item1 = new SaleDetail();
        $item1->setCodProducto('C023')
            ->setUnidad('NIU')
            ->setCantidad(2)
            ->setDescripcion('PROD 1')
            ->setDescuento(1)
            ->setIgv(18)
            ->setTipAfeIgv('10')
            ->setMtoValorVenta(100)
            ->setMtoValorUnitario(50)
            ->setMtoPrecioUnitario(56);

        $item2 = new SaleDetail();
        $item2->setCodProducto('C02')
            ->setCodProdSunat('P21')
            ->setUnidad('NIU')
            ->setCantidad(2)
            ->setDescripcion('PROD 1')
            ->setIgv(18)
            ->setTipAfeIgv('10')
            ->setMtoValorVenta(100)
            ->setMtoValorUnitario(50)
            ->setMtoPrecioUnitario(56);

        $legend = new Legend();
        $legend->setCode('1000')
            ->setValue('SON CIEN CON 00/100 SOLES');

        $invoice->setDetails([$item1, $item2])
            ->setLegends([$legend]);

        return $invoice;
    }
}