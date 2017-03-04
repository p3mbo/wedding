<?php

class ViewingController extends CoreController
{
    public function bookAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getPostParams();

        if(!isset($params['view'])) {
            \Wedding\Messages::addError('Invalid params encountered');
            $this->redirectReferer();
        }

        $viewData = $params['view'];


        try {
            $result = \Wedding\Viewing::add($viewData);
        } catch(Exception $e) {
            \Wedding\Messages::addError($e->getMessage());
            $this->redirectReferer();
        }

        $response = [
            'result' => $result ? 'OK' : 'ERROR'
        ];

        echo json_encode($response);


        $this->setNoRender();
        $this->disableLayout();
    }
}