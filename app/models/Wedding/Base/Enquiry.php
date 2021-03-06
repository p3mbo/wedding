<?php

namespace Wedding\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use Wedding\Enquiry as ChildEnquiry;
use Wedding\EnquiryComment as ChildEnquiryComment;
use Wedding\EnquiryCommentQuery as ChildEnquiryCommentQuery;
use Wedding\EnquiryQuery as ChildEnquiryQuery;
use Wedding\Quote as ChildQuote;
use Wedding\QuoteQuery as ChildQuoteQuery;
use Wedding\Viewing as ChildViewing;
use Wedding\ViewingQuery as ChildViewingQuery;
use Wedding\Map\EnquiryCommentTableMap;
use Wedding\Map\EnquiryTableMap;
use Wedding\Map\QuoteTableMap;
use Wedding\Map\ViewingTableMap;

/**
 * Base class that represents a row from the 'enquiry' table.
 *
 * 
 *
 * @package    propel.generator.Wedding.Base
 */
abstract class Enquiry implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Wedding\\Map\\EnquiryTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the entity_id field.
     * 
     * @var        int
     */
    protected $entity_id;

    /**
     * The value for the title field.
     * 
     * @var        string
     */
    protected $title;

    /**
     * The value for the name field.
     * 
     * @var        string
     */
    protected $name;

    /**
     * The value for the partner_name field.
     * 
     * @var        string
     */
    protected $partner_name;

    /**
     * The value for the email field.
     * 
     * @var        string
     */
    protected $email;

    /**
     * The value for the telephone field.
     * 
     * @var        string
     */
    protected $telephone;

    /**
     * The value for the mobile field.
     * 
     * @var        string
     */
    protected $mobile;

    /**
     * The value for the address field.
     * 
     * @var        string
     */
    protected $address;

    /**
     * The value for the day_guests field.
     * 
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $day_guests;

    /**
     * The value for the evening_guests field.
     * 
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $evening_guests;

    /**
     * The value for the year field.
     * 
     * @var        string
     */
    protected $year;

    /**
     * The value for the budget field.
     * 
     * @var        string
     */
    protected $budget;

    /**
     * The value for the heard field.
     * 
     * @var        string
     */
    protected $heard;

    /**
     * The value for the comment field.
     * 
     * @var        string
     */
    protected $comment;

    /**
     * The value for the created_at field.
     * 
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * 
     * @var        DateTime
     */
    protected $updated_at;

    /**
     * The value for the lost_at field.
     * 
     * @var        DateTime
     */
    protected $lost_at;

    /**
     * The value for the promoted_at field.
     * 
     * @var        DateTime
     */
    protected $promoted_at;

    /**
     * The value for the contacted_at field.
     * 
     * @var        DateTime
     */
    protected $contacted_at;

    /**
     * @var        ObjectCollection|ChildEnquiryComment[] Collection to store aggregation of ChildEnquiryComment objects.
     */
    protected $collEnquiryComments;
    protected $collEnquiryCommentsPartial;

    /**
     * @var        ObjectCollection|ChildQuote[] Collection to store aggregation of ChildQuote objects.
     */
    protected $collQuotes;
    protected $collQuotesPartial;

    /**
     * @var        ObjectCollection|ChildViewing[] Collection to store aggregation of ChildViewing objects.
     */
    protected $collViewings;
    protected $collViewingsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEnquiryComment[]
     */
    protected $enquiryCommentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildQuote[]
     */
    protected $quotesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildViewing[]
     */
    protected $viewingsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->day_guests = 0;
        $this->evening_guests = 0;
    }

    /**
     * Initializes internal state of Wedding\Base\Enquiry object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Enquiry</code> instance.  If
     * <code>obj</code> is an instance of <code>Enquiry</code>, delegates to
     * <code>equals(Enquiry)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Enquiry The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));
        
        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }
        
        return $propertyNames;
    }

    /**
     * Get the [entity_id] column value.
     * 
     * @return int
     */
    public function getEntityId()
    {
        return $this->entity_id;
    }

    /**
     * Get the [title] column value.
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [name] column value.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [partner_name] column value.
     * 
     * @return string
     */
    public function getPartnerName()
    {
        return $this->partner_name;
    }

    /**
     * Get the [email] column value.
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [telephone] column value.
     * 
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Get the [mobile] column value.
     * 
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Get the [address] column value.
     * 
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [day_guests] column value.
     * 
     * @return int
     */
    public function getDayGuests()
    {
        return $this->day_guests;
    }

    /**
     * Get the [evening_guests] column value.
     * 
     * @return int
     */
    public function getEveningGuests()
    {
        return $this->evening_guests;
    }

    /**
     * Get the [year] column value.
     * 
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Get the [budget] column value.
     * 
     * @return string
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Get the [heard] column value.
     * 
     * @return string
     */
    public function getHeard()
    {
        return $this->heard;
    }

    /**
     * Get the [comment] column value.
     * 
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [lost_at] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLostAt($format = NULL)
    {
        if ($format === null) {
            return $this->lost_at;
        } else {
            return $this->lost_at instanceof \DateTimeInterface ? $this->lost_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [promoted_at] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPromotedAt($format = NULL)
    {
        if ($format === null) {
            return $this->promoted_at;
        } else {
            return $this->promoted_at instanceof \DateTimeInterface ? $this->promoted_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [contacted_at] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getContactedAt($format = NULL)
    {
        if ($format === null) {
            return $this->contacted_at;
        } else {
            return $this->contacted_at instanceof \DateTimeInterface ? $this->contacted_at->format($format) : null;
        }
    }

    /**
     * Set the value of [entity_id] column.
     * 
     * @param int $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setEntityId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->entity_id !== $v) {
            $this->entity_id = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_ENTITY_ID] = true;
        }

        return $this;
    } // setEntityId()

    /**
     * Set the value of [title] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [name] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [partner_name] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setPartnerName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->partner_name !== $v) {
            $this->partner_name = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_PARTNER_NAME] = true;
        }

        return $this;
    } // setPartnerName()

    /**
     * Set the value of [email] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [telephone] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setTelephone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telephone !== $v) {
            $this->telephone = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_TELEPHONE] = true;
        }

        return $this;
    } // setTelephone()

    /**
     * Set the value of [mobile] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobile !== $v) {
            $this->mobile = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_MOBILE] = true;
        }

        return $this;
    } // setMobile()

    /**
     * Set the value of [address] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [day_guests] column.
     * 
     * @param int $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setDayGuests($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->day_guests !== $v) {
            $this->day_guests = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_DAY_GUESTS] = true;
        }

        return $this;
    } // setDayGuests()

    /**
     * Set the value of [evening_guests] column.
     * 
     * @param int $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setEveningGuests($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->evening_guests !== $v) {
            $this->evening_guests = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_EVENING_GUESTS] = true;
        }

        return $this;
    } // setEveningGuests()

    /**
     * Set the value of [year] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setYear($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->year !== $v) {
            $this->year = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_YEAR] = true;
        }

        return $this;
    } // setYear()

    /**
     * Set the value of [budget] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setBudget($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->budget !== $v) {
            $this->budget = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_BUDGET] = true;
        }

        return $this;
    } // setBudget()

    /**
     * Set the value of [heard] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setHeard($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->heard !== $v) {
            $this->heard = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_HEARD] = true;
        }

        return $this;
    } // setHeard()

    /**
     * Set the value of [comment] column.
     * 
     * @param string $v new value
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment !== $v) {
            $this->comment = $v;
            $this->modifiedColumns[EnquiryTableMap::COL_COMMENT] = true;
        }

        return $this;
    } // setComment()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EnquiryTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EnquiryTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Sets the value of [lost_at] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setLostAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lost_at !== null || $dt !== null) {
            if ($this->lost_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->lost_at->format("Y-m-d H:i:s.u")) {
                $this->lost_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EnquiryTableMap::COL_LOST_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setLostAt()

    /**
     * Sets the value of [promoted_at] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setPromotedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->promoted_at !== null || $dt !== null) {
            if ($this->promoted_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->promoted_at->format("Y-m-d H:i:s.u")) {
                $this->promoted_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EnquiryTableMap::COL_PROMOTED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setPromotedAt()

    /**
     * Sets the value of [contacted_at] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function setContactedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->contacted_at !== null || $dt !== null) {
            if ($this->contacted_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->contacted_at->format("Y-m-d H:i:s.u")) {
                $this->contacted_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EnquiryTableMap::COL_CONTACTED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setContactedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->day_guests !== 0) {
                return false;
            }

            if ($this->evening_guests !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EnquiryTableMap::translateFieldName('EntityId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->entity_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EnquiryTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EnquiryTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EnquiryTableMap::translateFieldName('PartnerName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->partner_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EnquiryTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EnquiryTableMap::translateFieldName('Telephone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telephone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EnquiryTableMap::translateFieldName('Mobile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mobile = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EnquiryTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : EnquiryTableMap::translateFieldName('DayGuests', TableMap::TYPE_PHPNAME, $indexType)];
            $this->day_guests = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : EnquiryTableMap::translateFieldName('EveningGuests', TableMap::TYPE_PHPNAME, $indexType)];
            $this->evening_guests = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : EnquiryTableMap::translateFieldName('Year', TableMap::TYPE_PHPNAME, $indexType)];
            $this->year = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : EnquiryTableMap::translateFieldName('Budget', TableMap::TYPE_PHPNAME, $indexType)];
            $this->budget = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : EnquiryTableMap::translateFieldName('Heard', TableMap::TYPE_PHPNAME, $indexType)];
            $this->heard = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : EnquiryTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : EnquiryTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : EnquiryTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : EnquiryTableMap::translateFieldName('LostAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->lost_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : EnquiryTableMap::translateFieldName('PromotedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->promoted_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : EnquiryTableMap::translateFieldName('ContactedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->contacted_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 19; // 19 = EnquiryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Wedding\\Enquiry'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EnquiryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEnquiryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collEnquiryComments = null;

            $this->collQuotes = null;

            $this->collViewings = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Enquiry::setDeleted()
     * @see Enquiry::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEnquiryQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }
 
        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                EnquiryTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->enquiryCommentsScheduledForDeletion !== null) {
                if (!$this->enquiryCommentsScheduledForDeletion->isEmpty()) {
                    \Wedding\EnquiryCommentQuery::create()
                        ->filterByPrimaryKeys($this->enquiryCommentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->enquiryCommentsScheduledForDeletion = null;
                }
            }

            if ($this->collEnquiryComments !== null) {
                foreach ($this->collEnquiryComments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->quotesScheduledForDeletion !== null) {
                if (!$this->quotesScheduledForDeletion->isEmpty()) {
                    \Wedding\QuoteQuery::create()
                        ->filterByPrimaryKeys($this->quotesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->quotesScheduledForDeletion = null;
                }
            }

            if ($this->collQuotes !== null) {
                foreach ($this->collQuotes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->viewingsScheduledForDeletion !== null) {
                if (!$this->viewingsScheduledForDeletion->isEmpty()) {
                    \Wedding\ViewingQuery::create()
                        ->filterByPrimaryKeys($this->viewingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->viewingsScheduledForDeletion = null;
                }
            }

            if ($this->collViewings !== null) {
                foreach ($this->collViewings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[EnquiryTableMap::COL_ENTITY_ID] = true;
        if (null !== $this->entity_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EnquiryTableMap::COL_ENTITY_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EnquiryTableMap::COL_ENTITY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'entity_id';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_PARTNER_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'partner_name';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_TELEPHONE)) {
            $modifiedColumns[':p' . $index++]  = 'telephone';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_MOBILE)) {
            $modifiedColumns[':p' . $index++]  = 'mobile';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_DAY_GUESTS)) {
            $modifiedColumns[':p' . $index++]  = 'day_guests';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_EVENING_GUESTS)) {
            $modifiedColumns[':p' . $index++]  = 'evening_guests';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_YEAR)) {
            $modifiedColumns[':p' . $index++]  = 'year';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_BUDGET)) {
            $modifiedColumns[':p' . $index++]  = 'budget';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_HEARD)) {
            $modifiedColumns[':p' . $index++]  = 'heard';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'comment';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_LOST_AT)) {
            $modifiedColumns[':p' . $index++]  = 'lost_at';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_PROMOTED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'promoted_at';
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_CONTACTED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'contacted_at';
        }

        $sql = sprintf(
            'INSERT INTO enquiry (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'entity_id':                        
                        $stmt->bindValue($identifier, $this->entity_id, PDO::PARAM_INT);
                        break;
                    case 'title':                        
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'name':                        
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'partner_name':                        
                        $stmt->bindValue($identifier, $this->partner_name, PDO::PARAM_STR);
                        break;
                    case 'email':                        
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'telephone':                        
                        $stmt->bindValue($identifier, $this->telephone, PDO::PARAM_STR);
                        break;
                    case 'mobile':                        
                        $stmt->bindValue($identifier, $this->mobile, PDO::PARAM_STR);
                        break;
                    case 'address':                        
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'day_guests':                        
                        $stmt->bindValue($identifier, $this->day_guests, PDO::PARAM_INT);
                        break;
                    case 'evening_guests':                        
                        $stmt->bindValue($identifier, $this->evening_guests, PDO::PARAM_INT);
                        break;
                    case 'year':                        
                        $stmt->bindValue($identifier, $this->year, PDO::PARAM_STR);
                        break;
                    case 'budget':                        
                        $stmt->bindValue($identifier, $this->budget, PDO::PARAM_STR);
                        break;
                    case 'heard':                        
                        $stmt->bindValue($identifier, $this->heard, PDO::PARAM_STR);
                        break;
                    case 'comment':                        
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);
                        break;
                    case 'created_at':                        
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':                        
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'lost_at':                        
                        $stmt->bindValue($identifier, $this->lost_at ? $this->lost_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'promoted_at':                        
                        $stmt->bindValue($identifier, $this->promoted_at ? $this->promoted_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'contacted_at':                        
                        $stmt->bindValue($identifier, $this->contacted_at ? $this->contacted_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setEntityId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EnquiryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getEntityId();
                break;
            case 1:
                return $this->getTitle();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getPartnerName();
                break;
            case 4:
                return $this->getEmail();
                break;
            case 5:
                return $this->getTelephone();
                break;
            case 6:
                return $this->getMobile();
                break;
            case 7:
                return $this->getAddress();
                break;
            case 8:
                return $this->getDayGuests();
                break;
            case 9:
                return $this->getEveningGuests();
                break;
            case 10:
                return $this->getYear();
                break;
            case 11:
                return $this->getBudget();
                break;
            case 12:
                return $this->getHeard();
                break;
            case 13:
                return $this->getComment();
                break;
            case 14:
                return $this->getCreatedAt();
                break;
            case 15:
                return $this->getUpdatedAt();
                break;
            case 16:
                return $this->getLostAt();
                break;
            case 17:
                return $this->getPromotedAt();
                break;
            case 18:
                return $this->getContactedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Enquiry'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Enquiry'][$this->hashCode()] = true;
        $keys = EnquiryTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getEntityId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getPartnerName(),
            $keys[4] => $this->getEmail(),
            $keys[5] => $this->getTelephone(),
            $keys[6] => $this->getMobile(),
            $keys[7] => $this->getAddress(),
            $keys[8] => $this->getDayGuests(),
            $keys[9] => $this->getEveningGuests(),
            $keys[10] => $this->getYear(),
            $keys[11] => $this->getBudget(),
            $keys[12] => $this->getHeard(),
            $keys[13] => $this->getComment(),
            $keys[14] => $this->getCreatedAt(),
            $keys[15] => $this->getUpdatedAt(),
            $keys[16] => $this->getLostAt(),
            $keys[17] => $this->getPromotedAt(),
            $keys[18] => $this->getContactedAt(),
        );
        if ($result[$keys[14]] instanceof \DateTime) {
            $result[$keys[14]] = $result[$keys[14]]->format('c');
        }
        
        if ($result[$keys[15]] instanceof \DateTime) {
            $result[$keys[15]] = $result[$keys[15]]->format('c');
        }
        
        if ($result[$keys[16]] instanceof \DateTime) {
            $result[$keys[16]] = $result[$keys[16]]->format('c');
        }
        
        if ($result[$keys[17]] instanceof \DateTime) {
            $result[$keys[17]] = $result[$keys[17]]->format('c');
        }
        
        if ($result[$keys[18]] instanceof \DateTime) {
            $result[$keys[18]] = $result[$keys[18]]->format('c');
        }
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->collEnquiryComments) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'enquiryComments';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'enquiry_comments';
                        break;
                    default:
                        $key = 'EnquiryComments';
                }
        
                $result[$key] = $this->collEnquiryComments->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collQuotes) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'quotes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'quotes';
                        break;
                    default:
                        $key = 'Quotes';
                }
        
                $result[$key] = $this->collQuotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collViewings) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'viewings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'viewings';
                        break;
                    default:
                        $key = 'Viewings';
                }
        
                $result[$key] = $this->collViewings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Wedding\Enquiry
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EnquiryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Wedding\Enquiry
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setEntityId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setPartnerName($value);
                break;
            case 4:
                $this->setEmail($value);
                break;
            case 5:
                $this->setTelephone($value);
                break;
            case 6:
                $this->setMobile($value);
                break;
            case 7:
                $this->setAddress($value);
                break;
            case 8:
                $this->setDayGuests($value);
                break;
            case 9:
                $this->setEveningGuests($value);
                break;
            case 10:
                $this->setYear($value);
                break;
            case 11:
                $this->setBudget($value);
                break;
            case 12:
                $this->setHeard($value);
                break;
            case 13:
                $this->setComment($value);
                break;
            case 14:
                $this->setCreatedAt($value);
                break;
            case 15:
                $this->setUpdatedAt($value);
                break;
            case 16:
                $this->setLostAt($value);
                break;
            case 17:
                $this->setPromotedAt($value);
                break;
            case 18:
                $this->setContactedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = EnquiryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setEntityId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPartnerName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEmail($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTelephone($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMobile($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setAddress($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDayGuests($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEveningGuests($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setYear($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setBudget($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setHeard($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setComment($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCreatedAt($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setUpdatedAt($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setLostAt($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setPromotedAt($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setContactedAt($arr[$keys[18]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Wedding\Enquiry The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EnquiryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EnquiryTableMap::COL_ENTITY_ID)) {
            $criteria->add(EnquiryTableMap::COL_ENTITY_ID, $this->entity_id);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_TITLE)) {
            $criteria->add(EnquiryTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_NAME)) {
            $criteria->add(EnquiryTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_PARTNER_NAME)) {
            $criteria->add(EnquiryTableMap::COL_PARTNER_NAME, $this->partner_name);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_EMAIL)) {
            $criteria->add(EnquiryTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_TELEPHONE)) {
            $criteria->add(EnquiryTableMap::COL_TELEPHONE, $this->telephone);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_MOBILE)) {
            $criteria->add(EnquiryTableMap::COL_MOBILE, $this->mobile);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_ADDRESS)) {
            $criteria->add(EnquiryTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_DAY_GUESTS)) {
            $criteria->add(EnquiryTableMap::COL_DAY_GUESTS, $this->day_guests);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_EVENING_GUESTS)) {
            $criteria->add(EnquiryTableMap::COL_EVENING_GUESTS, $this->evening_guests);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_YEAR)) {
            $criteria->add(EnquiryTableMap::COL_YEAR, $this->year);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_BUDGET)) {
            $criteria->add(EnquiryTableMap::COL_BUDGET, $this->budget);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_HEARD)) {
            $criteria->add(EnquiryTableMap::COL_HEARD, $this->heard);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_COMMENT)) {
            $criteria->add(EnquiryTableMap::COL_COMMENT, $this->comment);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_CREATED_AT)) {
            $criteria->add(EnquiryTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_UPDATED_AT)) {
            $criteria->add(EnquiryTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_LOST_AT)) {
            $criteria->add(EnquiryTableMap::COL_LOST_AT, $this->lost_at);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_PROMOTED_AT)) {
            $criteria->add(EnquiryTableMap::COL_PROMOTED_AT, $this->promoted_at);
        }
        if ($this->isColumnModified(EnquiryTableMap::COL_CONTACTED_AT)) {
            $criteria->add(EnquiryTableMap::COL_CONTACTED_AT, $this->contacted_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildEnquiryQuery::create();
        $criteria->add(EnquiryTableMap::COL_ENTITY_ID, $this->entity_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getEntityId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }
        
    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getEntityId();
    }

    /**
     * Generic method to set the primary key (entity_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setEntityId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getEntityId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Wedding\Enquiry (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setName($this->getName());
        $copyObj->setPartnerName($this->getPartnerName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setTelephone($this->getTelephone());
        $copyObj->setMobile($this->getMobile());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setDayGuests($this->getDayGuests());
        $copyObj->setEveningGuests($this->getEveningGuests());
        $copyObj->setYear($this->getYear());
        $copyObj->setBudget($this->getBudget());
        $copyObj->setHeard($this->getHeard());
        $copyObj->setComment($this->getComment());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setLostAt($this->getLostAt());
        $copyObj->setPromotedAt($this->getPromotedAt());
        $copyObj->setContactedAt($this->getContactedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getEnquiryComments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEnquiryComment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getQuotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addQuote($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getViewings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addViewing($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setEntityId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Wedding\Enquiry Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('EnquiryComment' == $relationName) {
            return $this->initEnquiryComments();
        }
        if ('Quote' == $relationName) {
            return $this->initQuotes();
        }
        if ('Viewing' == $relationName) {
            return $this->initViewings();
        }
    }

    /**
     * Clears out the collEnquiryComments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEnquiryComments()
     */
    public function clearEnquiryComments()
    {
        $this->collEnquiryComments = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEnquiryComments collection loaded partially.
     */
    public function resetPartialEnquiryComments($v = true)
    {
        $this->collEnquiryCommentsPartial = $v;
    }

    /**
     * Initializes the collEnquiryComments collection.
     *
     * By default this just sets the collEnquiryComments collection to an empty array (like clearcollEnquiryComments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEnquiryComments($overrideExisting = true)
    {
        if (null !== $this->collEnquiryComments && !$overrideExisting) {
            return;
        }

        $collectionClassName = EnquiryCommentTableMap::getTableMap()->getCollectionClassName();

        $this->collEnquiryComments = new $collectionClassName;
        $this->collEnquiryComments->setModel('\Wedding\EnquiryComment');
    }

    /**
     * Gets an array of ChildEnquiryComment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEnquiry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEnquiryComment[] List of ChildEnquiryComment objects
     * @throws PropelException
     */
    public function getEnquiryComments(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEnquiryCommentsPartial && !$this->isNew();
        if (null === $this->collEnquiryComments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEnquiryComments) {
                // return empty collection
                $this->initEnquiryComments();
            } else {
                $collEnquiryComments = ChildEnquiryCommentQuery::create(null, $criteria)
                    ->filterByEnquiry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEnquiryCommentsPartial && count($collEnquiryComments)) {
                        $this->initEnquiryComments(false);

                        foreach ($collEnquiryComments as $obj) {
                            if (false == $this->collEnquiryComments->contains($obj)) {
                                $this->collEnquiryComments->append($obj);
                            }
                        }

                        $this->collEnquiryCommentsPartial = true;
                    }

                    return $collEnquiryComments;
                }

                if ($partial && $this->collEnquiryComments) {
                    foreach ($this->collEnquiryComments as $obj) {
                        if ($obj->isNew()) {
                            $collEnquiryComments[] = $obj;
                        }
                    }
                }

                $this->collEnquiryComments = $collEnquiryComments;
                $this->collEnquiryCommentsPartial = false;
            }
        }

        return $this->collEnquiryComments;
    }

    /**
     * Sets a collection of ChildEnquiryComment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $enquiryComments A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEnquiry The current object (for fluent API support)
     */
    public function setEnquiryComments(Collection $enquiryComments, ConnectionInterface $con = null)
    {
        /** @var ChildEnquiryComment[] $enquiryCommentsToDelete */
        $enquiryCommentsToDelete = $this->getEnquiryComments(new Criteria(), $con)->diff($enquiryComments);

        
        $this->enquiryCommentsScheduledForDeletion = $enquiryCommentsToDelete;

        foreach ($enquiryCommentsToDelete as $enquiryCommentRemoved) {
            $enquiryCommentRemoved->setEnquiry(null);
        }

        $this->collEnquiryComments = null;
        foreach ($enquiryComments as $enquiryComment) {
            $this->addEnquiryComment($enquiryComment);
        }

        $this->collEnquiryComments = $enquiryComments;
        $this->collEnquiryCommentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EnquiryComment objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related EnquiryComment objects.
     * @throws PropelException
     */
    public function countEnquiryComments(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEnquiryCommentsPartial && !$this->isNew();
        if (null === $this->collEnquiryComments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEnquiryComments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEnquiryComments());
            }

            $query = ChildEnquiryCommentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEnquiry($this)
                ->count($con);
        }

        return count($this->collEnquiryComments);
    }

    /**
     * Method called to associate a ChildEnquiryComment object to this object
     * through the ChildEnquiryComment foreign key attribute.
     *
     * @param  ChildEnquiryComment $l ChildEnquiryComment
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function addEnquiryComment(ChildEnquiryComment $l)
    {
        if ($this->collEnquiryComments === null) {
            $this->initEnquiryComments();
            $this->collEnquiryCommentsPartial = true;
        }

        if (!$this->collEnquiryComments->contains($l)) {
            $this->doAddEnquiryComment($l);

            if ($this->enquiryCommentsScheduledForDeletion and $this->enquiryCommentsScheduledForDeletion->contains($l)) {
                $this->enquiryCommentsScheduledForDeletion->remove($this->enquiryCommentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEnquiryComment $enquiryComment The ChildEnquiryComment object to add.
     */
    protected function doAddEnquiryComment(ChildEnquiryComment $enquiryComment)
    {
        $this->collEnquiryComments[]= $enquiryComment;
        $enquiryComment->setEnquiry($this);
    }

    /**
     * @param  ChildEnquiryComment $enquiryComment The ChildEnquiryComment object to remove.
     * @return $this|ChildEnquiry The current object (for fluent API support)
     */
    public function removeEnquiryComment(ChildEnquiryComment $enquiryComment)
    {
        if ($this->getEnquiryComments()->contains($enquiryComment)) {
            $pos = $this->collEnquiryComments->search($enquiryComment);
            $this->collEnquiryComments->remove($pos);
            if (null === $this->enquiryCommentsScheduledForDeletion) {
                $this->enquiryCommentsScheduledForDeletion = clone $this->collEnquiryComments;
                $this->enquiryCommentsScheduledForDeletion->clear();
            }
            $this->enquiryCommentsScheduledForDeletion[]= $enquiryComment;
            $enquiryComment->setEnquiry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Enquiry is new, it will return
     * an empty collection; or if this Enquiry has previously
     * been saved, it will retrieve related EnquiryComments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Enquiry.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEnquiryComment[] List of ChildEnquiryComment objects
     */
    public function getEnquiryCommentsJoinStaff(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEnquiryCommentQuery::create(null, $criteria);
        $query->joinWith('Staff', $joinBehavior);

        return $this->getEnquiryComments($query, $con);
    }

    /**
     * Clears out the collQuotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addQuotes()
     */
    public function clearQuotes()
    {
        $this->collQuotes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collQuotes collection loaded partially.
     */
    public function resetPartialQuotes($v = true)
    {
        $this->collQuotesPartial = $v;
    }

    /**
     * Initializes the collQuotes collection.
     *
     * By default this just sets the collQuotes collection to an empty array (like clearcollQuotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initQuotes($overrideExisting = true)
    {
        if (null !== $this->collQuotes && !$overrideExisting) {
            return;
        }

        $collectionClassName = QuoteTableMap::getTableMap()->getCollectionClassName();

        $this->collQuotes = new $collectionClassName;
        $this->collQuotes->setModel('\Wedding\Quote');
    }

    /**
     * Gets an array of ChildQuote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEnquiry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildQuote[] List of ChildQuote objects
     * @throws PropelException
     */
    public function getQuotes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collQuotesPartial && !$this->isNew();
        if (null === $this->collQuotes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collQuotes) {
                // return empty collection
                $this->initQuotes();
            } else {
                $collQuotes = ChildQuoteQuery::create(null, $criteria)
                    ->filterByEnquiry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collQuotesPartial && count($collQuotes)) {
                        $this->initQuotes(false);

                        foreach ($collQuotes as $obj) {
                            if (false == $this->collQuotes->contains($obj)) {
                                $this->collQuotes->append($obj);
                            }
                        }

                        $this->collQuotesPartial = true;
                    }

                    return $collQuotes;
                }

                if ($partial && $this->collQuotes) {
                    foreach ($this->collQuotes as $obj) {
                        if ($obj->isNew()) {
                            $collQuotes[] = $obj;
                        }
                    }
                }

                $this->collQuotes = $collQuotes;
                $this->collQuotesPartial = false;
            }
        }

        return $this->collQuotes;
    }

    /**
     * Sets a collection of ChildQuote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $quotes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEnquiry The current object (for fluent API support)
     */
    public function setQuotes(Collection $quotes, ConnectionInterface $con = null)
    {
        /** @var ChildQuote[] $quotesToDelete */
        $quotesToDelete = $this->getQuotes(new Criteria(), $con)->diff($quotes);

        
        $this->quotesScheduledForDeletion = $quotesToDelete;

        foreach ($quotesToDelete as $quoteRemoved) {
            $quoteRemoved->setEnquiry(null);
        }

        $this->collQuotes = null;
        foreach ($quotes as $quote) {
            $this->addQuote($quote);
        }

        $this->collQuotes = $quotes;
        $this->collQuotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Quote objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Quote objects.
     * @throws PropelException
     */
    public function countQuotes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collQuotesPartial && !$this->isNew();
        if (null === $this->collQuotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collQuotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getQuotes());
            }

            $query = ChildQuoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEnquiry($this)
                ->count($con);
        }

        return count($this->collQuotes);
    }

    /**
     * Method called to associate a ChildQuote object to this object
     * through the ChildQuote foreign key attribute.
     *
     * @param  ChildQuote $l ChildQuote
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function addQuote(ChildQuote $l)
    {
        if ($this->collQuotes === null) {
            $this->initQuotes();
            $this->collQuotesPartial = true;
        }

        if (!$this->collQuotes->contains($l)) {
            $this->doAddQuote($l);

            if ($this->quotesScheduledForDeletion and $this->quotesScheduledForDeletion->contains($l)) {
                $this->quotesScheduledForDeletion->remove($this->quotesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildQuote $quote The ChildQuote object to add.
     */
    protected function doAddQuote(ChildQuote $quote)
    {
        $this->collQuotes[]= $quote;
        $quote->setEnquiry($this);
    }

    /**
     * @param  ChildQuote $quote The ChildQuote object to remove.
     * @return $this|ChildEnquiry The current object (for fluent API support)
     */
    public function removeQuote(ChildQuote $quote)
    {
        if ($this->getQuotes()->contains($quote)) {
            $pos = $this->collQuotes->search($quote);
            $this->collQuotes->remove($pos);
            if (null === $this->quotesScheduledForDeletion) {
                $this->quotesScheduledForDeletion = clone $this->collQuotes;
                $this->quotesScheduledForDeletion->clear();
            }
            $this->quotesScheduledForDeletion[]= $quote;
            $quote->setEnquiry(null);
        }

        return $this;
    }

    /**
     * Clears out the collViewings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addViewings()
     */
    public function clearViewings()
    {
        $this->collViewings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collViewings collection loaded partially.
     */
    public function resetPartialViewings($v = true)
    {
        $this->collViewingsPartial = $v;
    }

    /**
     * Initializes the collViewings collection.
     *
     * By default this just sets the collViewings collection to an empty array (like clearcollViewings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initViewings($overrideExisting = true)
    {
        if (null !== $this->collViewings && !$overrideExisting) {
            return;
        }

        $collectionClassName = ViewingTableMap::getTableMap()->getCollectionClassName();

        $this->collViewings = new $collectionClassName;
        $this->collViewings->setModel('\Wedding\Viewing');
    }

    /**
     * Gets an array of ChildViewing objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEnquiry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildViewing[] List of ChildViewing objects
     * @throws PropelException
     */
    public function getViewings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collViewingsPartial && !$this->isNew();
        if (null === $this->collViewings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collViewings) {
                // return empty collection
                $this->initViewings();
            } else {
                $collViewings = ChildViewingQuery::create(null, $criteria)
                    ->filterByEnquiry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collViewingsPartial && count($collViewings)) {
                        $this->initViewings(false);

                        foreach ($collViewings as $obj) {
                            if (false == $this->collViewings->contains($obj)) {
                                $this->collViewings->append($obj);
                            }
                        }

                        $this->collViewingsPartial = true;
                    }

                    return $collViewings;
                }

                if ($partial && $this->collViewings) {
                    foreach ($this->collViewings as $obj) {
                        if ($obj->isNew()) {
                            $collViewings[] = $obj;
                        }
                    }
                }

                $this->collViewings = $collViewings;
                $this->collViewingsPartial = false;
            }
        }

        return $this->collViewings;
    }

    /**
     * Sets a collection of ChildViewing objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $viewings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildEnquiry The current object (for fluent API support)
     */
    public function setViewings(Collection $viewings, ConnectionInterface $con = null)
    {
        /** @var ChildViewing[] $viewingsToDelete */
        $viewingsToDelete = $this->getViewings(new Criteria(), $con)->diff($viewings);

        
        $this->viewingsScheduledForDeletion = $viewingsToDelete;

        foreach ($viewingsToDelete as $viewingRemoved) {
            $viewingRemoved->setEnquiry(null);
        }

        $this->collViewings = null;
        foreach ($viewings as $viewing) {
            $this->addViewing($viewing);
        }

        $this->collViewings = $viewings;
        $this->collViewingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Viewing objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Viewing objects.
     * @throws PropelException
     */
    public function countViewings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collViewingsPartial && !$this->isNew();
        if (null === $this->collViewings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collViewings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getViewings());
            }

            $query = ChildViewingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEnquiry($this)
                ->count($con);
        }

        return count($this->collViewings);
    }

    /**
     * Method called to associate a ChildViewing object to this object
     * through the ChildViewing foreign key attribute.
     *
     * @param  ChildViewing $l ChildViewing
     * @return $this|\Wedding\Enquiry The current object (for fluent API support)
     */
    public function addViewing(ChildViewing $l)
    {
        if ($this->collViewings === null) {
            $this->initViewings();
            $this->collViewingsPartial = true;
        }

        if (!$this->collViewings->contains($l)) {
            $this->doAddViewing($l);

            if ($this->viewingsScheduledForDeletion and $this->viewingsScheduledForDeletion->contains($l)) {
                $this->viewingsScheduledForDeletion->remove($this->viewingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildViewing $viewing The ChildViewing object to add.
     */
    protected function doAddViewing(ChildViewing $viewing)
    {
        $this->collViewings[]= $viewing;
        $viewing->setEnquiry($this);
    }

    /**
     * @param  ChildViewing $viewing The ChildViewing object to remove.
     * @return $this|ChildEnquiry The current object (for fluent API support)
     */
    public function removeViewing(ChildViewing $viewing)
    {
        if ($this->getViewings()->contains($viewing)) {
            $pos = $this->collViewings->search($viewing);
            $this->collViewings->remove($pos);
            if (null === $this->viewingsScheduledForDeletion) {
                $this->viewingsScheduledForDeletion = clone $this->collViewings;
                $this->viewingsScheduledForDeletion->clear();
            }
            $this->viewingsScheduledForDeletion[]= $viewing;
            $viewing->setEnquiry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Enquiry is new, it will return
     * an empty collection; or if this Enquiry has previously
     * been saved, it will retrieve related Viewings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Enquiry.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildViewing[] List of ChildViewing objects
     */
    public function getViewingsJoinStaff(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildViewingQuery::create(null, $criteria);
        $query->joinWith('Staff', $joinBehavior);

        return $this->getViewings($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->entity_id = null;
        $this->title = null;
        $this->name = null;
        $this->partner_name = null;
        $this->email = null;
        $this->telephone = null;
        $this->mobile = null;
        $this->address = null;
        $this->day_guests = null;
        $this->evening_guests = null;
        $this->year = null;
        $this->budget = null;
        $this->heard = null;
        $this->comment = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->lost_at = null;
        $this->promoted_at = null;
        $this->contacted_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collEnquiryComments) {
                foreach ($this->collEnquiryComments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collQuotes) {
                foreach ($this->collQuotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collViewings) {
                foreach ($this->collViewings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collEnquiryComments = null;
        $this->collQuotes = null;
        $this->collViewings = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EnquiryTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
