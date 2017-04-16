<?php

class QuoteController extends CoreController
{
    public function indexAction()
    {
        $collection = \Wedding\QuoteQuery::create()->joinWithEnquiry()->find();
        $this->view->collection = $collection;
    }

    public function addAction()
    {
        $itemGroups = \Wedding\QuoteItemGroupQuery::create()->find();

        $enquiry = $this->_getEnquiry();

        $this->view->itemGroups = $itemGroups;
        $this->view->enquiry = $enquiry;
        $this->view->title('Add Quote');
        $this->view->js('/js/quote.js');
    }

    public function editPostAction()
    {
        $staffId = null;

        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getPostParams();

        if(!isset($params['quote'])) {
            \Wedding\Messages::addError('Invalid params encountered');
            $this->redirectReferer();
        }

        $quoteData = $params['quote'];

        try {
            // IF editing and not wanting to create a new quote
            // load the existing quote psased in via param
            // else
            $quote = new \Wedding\Quote();
            // end if


            if (isset($quoteData['day'])) {
                $quote->setDay(implode(',', $quoteData['day']));
            }

            if (isset($quoteData['month'])) {
                $quote->setMonth(implode(',', $quoteData['month']));
            }

            if (isset($quoteData['year'])) {
                $quote->setYear($quoteData['year']);
            }

            if (isset($quoteData['exc'])) {
                $quote->setExclusive(implode(',', $quoteData['exc']));
            }

            $quote->setCeremonyTypeId($quoteData['ceremony']);
            $quote->setSpecificDate($quoteData['date']);
            $quote->setDayGuests($quoteData['dayg']);
            $quote->setEveGuests($quoteData['eveg']);
            $quote->setEnquiryId($quoteData['enquiry_id']);
            $quote->setCreatedAt(time());
            $quote->save();


            $enquiry = $quote->getEnquiry();

            if (!empty($quoteData['notes'])) {
                $commentResult = \Wedding\EnquiryComment::add($enquiry, $quoteData['notes'], $staffId);
            }


            if (isset($quoteData['item_group'])) {
                $itemGroups = $quoteData['item_group'];

                foreach ($itemGroups as $itemGroupId => $itemGroupArr) {
                    foreach ($itemGroupArr as $itemGroup) {
                        echo '<pre>';
                        print_r($itemGroup);


                        if ($itemGroup['item'] != 0 && $itemGroup['item'] != 'Please select...') {
                            $quoteItem = new \Wedding\QuoteItem();
                            $quoteItem->setQuoteItemGroupItemId($itemGroupId);
                            $quoteItem->setQty(isset($itemGroup['qty']) ? $itemGroup['qty'] : 1);
                            $quoteItem->setNotes(isset($itemGroup['notes']) ? $itemGroup['notes'] : '');

                            // @todo: Implement if
                            // if we have permission to change the price
                            $quoteItem->setPrice(isset($itemGroup['price']) && $itemGroup['price'] > 0 ? $itemGroup['price'] : '0');
                            // end if
                            $quoteItem->save();
                        }
                    }
                }
            }


            exit;


        } catch(Propel\Runtime\Exception\PropelException $pe) {
            echo $pe->getMessage();
            die('arse');
        } catch(Exception $e) {

            die('farse');

            \Wedding\Messages::addError($e->getMessage());
            $this->redirectReferer();
        }


        \Wedding\Messages::addSuccess('Quote generated');
        $url = \Wedding::getUrl('quote/add', ['enquiry_id' => $enquiry->getEntityId(), 'quote_id' => $quote->getEntityId()]);
        header('Location: '. $url);
        exit;


    }

    private function _getEnquiry()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        $params = $request->getGetParams();
        if(!isset($params['enquiry_id'])) {
            throw new Exception('Invalid Enquiry Id');
        }

        $enquiry = \Wedding\EnquiryQuery::create()->findOneByEntityId($params['enquiry_id']);
        if(!$enquiry) {
            throw new Exception('Could not locate enquiry to create linked quote.');
        }

        return $enquiry;

    }

}