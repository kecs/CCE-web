<?php

class DataSource_createMeasurementAction extends sfAction{
    /**
    * @param sfWebRequest $request 
    */
    public function execute($request){
        $this->forward404Unless($dataSource = $this->getRoute()->getObject()); /* @var $dataSource DataSource */
        $channel = $dataSource->channel;

        $typeReflectionClass = new ReflectionClass($channel);
        if ($typeReflectionClass->isSubclassOf('Measurement')){
            $data = $this->requestToMeasurementData($request);
            $measurement = $channel::create($dataSource, $data);
            $measurement->save();
            return $this->renderText('OK');
        }else{
            throw new UnknownChannelException($channel);
        }
    }

    protected function requestToMeasurementData(sfWebRequest $request){
        switch ($request->getFormat($request->getContentType())){
            case 'decoded':
                return $request->getParameterHolder()->getAll();

            case 'xml':
                return new SimpleXMLElement($request->getContent());

            default:
                throw new Exception("Unknown request format {$request->getRequestFormat()} (content-type: {$request->getContentType()})");
        }
    }
}
