<?php
//
//use Phpro\SoapClient\CodeGenerator\Assembler;
//use Phpro\SoapClient\CodeGenerator\Rules;
//use Phpro\SoapClient\CodeGenerator\Config\Config;
//use Phpro\SoapClient\Soap\Driver\ExtSoap\ExtSoapOptions;
//use Phpro\SoapClient\Soap\Driver\ExtSoap\ExtSoapEngineFactory;
//
//return Config::create()
//    ->setEngine(ExtSoapEngineFactory::fromOptions(
//        ExtSoapOptions::defaults('http://192.168.10.1:8088/mockUMMServicePortBinding?WSDL', [])
//            ->disableWsdlCache()
//    ))
//    ->setTypeDestination('app/Models/MobileMoney/Mtn/Util/Type')
//    ->setTypeNamespace('App\Models\MobileMoney\Mtn\Util\Type')
//    ->setClientDestination('app/Models/MobileMoney/Mtn/Util')
//    ->setClientName('RequestPaymentClient')
//    ->setClientNamespace('App\Models\MobileMoney\Mtn\Util')
//    ->setClassMapDestination('app/Models/MobileMoney/Mtn/Util')
//    ->setClassMapName('RequestPaymentClassmap')
//    ->setClassMapNamespace('App\Models\MobileMoney\Mtn\Util')
//    ->addRule(new Rules\AssembleRule(new Assembler\GetterAssembler(new Assembler\GetterAssemblerOptions())))
//    ->addRule(new Rules\AssembleRule(new Assembler\ImmutableSetterAssembler()))
//    ->addRule(
//        new Rules\TypenameMatchesRule(
//            new Rules\MultiRule([
//                new Rules\AssembleRule(new Assembler\RequestAssembler()),
//                new Rules\AssembleRule(new Assembler\ConstructorAssembler(new Assembler\ConstructorAssemblerOptions())),
//            ]),
//            '/processRequest/i'
//        )
//    )
//    ->addRule(
//        new Rules\TypenameMatchesRule(
//            new Rules\MultiRule([
//                new Rules\AssembleRule(new Assembler\ResultAssembler()),
//            ]),
//            '/processRequestResponse/i'
//        )
//    )
//;
