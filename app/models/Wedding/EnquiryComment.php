<?php

namespace Wedding;

use Wedding\Base\EnquiryComment as BaseEnquiryComment;

/**
 * Skeleton subclass for representing a row from the 'enquiry_comment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class EnquiryComment extends BaseEnquiryComment
{
    public static function getHistory($enqId)
    {
        $collection = \Wedding\EnquiryCommentQuery::create()->orderByCreatedAt('DESC')->findByEnquiryId($enqId);
        return $collection;
    }

    public static function add($enquiry, $str, $staffId = '')
    {
        if(!empty($staffId)) {
            // Check if we have a staff id and if so; set it
        }

        $comment = new \Wedding\EnquiryComment();
        $comment->setStaffId($staffId);
        $comment->setComment($str);
        $comment->setCreatedAt(time());
        $comment->setEnquiry($enquiry);
        if($comment->save()) {
            return true;
        }

        return false;
    }
}
