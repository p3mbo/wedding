<?php

class CommentController extends CoreController
{

    public function addAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getPostParams();

        if(!isset($params['comment'])) {
            \Wedding\Messages::addError('Invalid params encountered');
            $this->redirectReferer();
        }

        $commentData = $params['comment'];


        $staffId = '';
        $enquiry = \Wedding\EnquiryQuery::create()->findOneByEntityId($commentData['enq_id']);
        if(!$enquiry) {

            \Wedding\Messages::addError('Could not locate enquiry to comment on');
            $this->redirectReferer();
        }


        try {
            $result = \Wedding\EnquiryComment::add($enquiry, $commentData['comment'], $staffId);
        } catch(Exception $e) {
            \Wedding\Messages::addError($e->getMessage());
            $this->redirectReferer();
        }





        $this->setNoRender();
        $this->disableLayout();
        $this->redirectReferer();
    }
}