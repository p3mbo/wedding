<?php

namespace Wedding\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Wedding\Enquiry;
use Wedding\EnquiryQuery;


/**
 * This class defines the structure of the 'enquiry' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EnquiryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Wedding.Map.EnquiryTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'enquiry';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Wedding\\Enquiry';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Wedding.Enquiry';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 19;

    /**
     * the column name for the entity_id field
     */
    const COL_ENTITY_ID = 'enquiry.entity_id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'enquiry.title';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'enquiry.name';

    /**
     * the column name for the partner_name field
     */
    const COL_PARTNER_NAME = 'enquiry.partner_name';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'enquiry.email';

    /**
     * the column name for the telephone field
     */
    const COL_TELEPHONE = 'enquiry.telephone';

    /**
     * the column name for the mobile field
     */
    const COL_MOBILE = 'enquiry.mobile';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'enquiry.address';

    /**
     * the column name for the day_guests field
     */
    const COL_DAY_GUESTS = 'enquiry.day_guests';

    /**
     * the column name for the evening_guests field
     */
    const COL_EVENING_GUESTS = 'enquiry.evening_guests';

    /**
     * the column name for the year field
     */
    const COL_YEAR = 'enquiry.year';

    /**
     * the column name for the budget field
     */
    const COL_BUDGET = 'enquiry.budget';

    /**
     * the column name for the heard field
     */
    const COL_HEARD = 'enquiry.heard';

    /**
     * the column name for the comment field
     */
    const COL_COMMENT = 'enquiry.comment';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'enquiry.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'enquiry.updated_at';

    /**
     * the column name for the lost_at field
     */
    const COL_LOST_AT = 'enquiry.lost_at';

    /**
     * the column name for the promted_at field
     */
    const COL_PROMTED_AT = 'enquiry.promted_at';

    /**
     * the column name for the contacted_at field
     */
    const COL_CONTACTED_AT = 'enquiry.contacted_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('EntityId', 'Title', 'Name', 'PartnerName', 'Email', 'Telephone', 'Mobile', 'Address', 'DayGuests', 'EveningGuests', 'Year', 'Budget', 'Heard', 'Comment', 'CreatedAt', 'UpdatedAt', 'LostAt', 'PromtedAt', 'ContactedAt', ),
        self::TYPE_CAMELNAME     => array('entityId', 'title', 'name', 'partnerName', 'email', 'telephone', 'mobile', 'address', 'dayGuests', 'eveningGuests', 'year', 'budget', 'heard', 'comment', 'createdAt', 'updatedAt', 'lostAt', 'promtedAt', 'contactedAt', ),
        self::TYPE_COLNAME       => array(EnquiryTableMap::COL_ENTITY_ID, EnquiryTableMap::COL_TITLE, EnquiryTableMap::COL_NAME, EnquiryTableMap::COL_PARTNER_NAME, EnquiryTableMap::COL_EMAIL, EnquiryTableMap::COL_TELEPHONE, EnquiryTableMap::COL_MOBILE, EnquiryTableMap::COL_ADDRESS, EnquiryTableMap::COL_DAY_GUESTS, EnquiryTableMap::COL_EVENING_GUESTS, EnquiryTableMap::COL_YEAR, EnquiryTableMap::COL_BUDGET, EnquiryTableMap::COL_HEARD, EnquiryTableMap::COL_COMMENT, EnquiryTableMap::COL_CREATED_AT, EnquiryTableMap::COL_UPDATED_AT, EnquiryTableMap::COL_LOST_AT, EnquiryTableMap::COL_PROMTED_AT, EnquiryTableMap::COL_CONTACTED_AT, ),
        self::TYPE_FIELDNAME     => array('entity_id', 'title', 'name', 'partner_name', 'email', 'telephone', 'mobile', 'address', 'day_guests', 'evening_guests', 'year', 'budget', 'heard', 'comment', 'created_at', 'updated_at', 'lost_at', 'promted_at', 'contacted_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EntityId' => 0, 'Title' => 1, 'Name' => 2, 'PartnerName' => 3, 'Email' => 4, 'Telephone' => 5, 'Mobile' => 6, 'Address' => 7, 'DayGuests' => 8, 'EveningGuests' => 9, 'Year' => 10, 'Budget' => 11, 'Heard' => 12, 'Comment' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, 'LostAt' => 16, 'PromtedAt' => 17, 'ContactedAt' => 18, ),
        self::TYPE_CAMELNAME     => array('entityId' => 0, 'title' => 1, 'name' => 2, 'partnerName' => 3, 'email' => 4, 'telephone' => 5, 'mobile' => 6, 'address' => 7, 'dayGuests' => 8, 'eveningGuests' => 9, 'year' => 10, 'budget' => 11, 'heard' => 12, 'comment' => 13, 'createdAt' => 14, 'updatedAt' => 15, 'lostAt' => 16, 'promtedAt' => 17, 'contactedAt' => 18, ),
        self::TYPE_COLNAME       => array(EnquiryTableMap::COL_ENTITY_ID => 0, EnquiryTableMap::COL_TITLE => 1, EnquiryTableMap::COL_NAME => 2, EnquiryTableMap::COL_PARTNER_NAME => 3, EnquiryTableMap::COL_EMAIL => 4, EnquiryTableMap::COL_TELEPHONE => 5, EnquiryTableMap::COL_MOBILE => 6, EnquiryTableMap::COL_ADDRESS => 7, EnquiryTableMap::COL_DAY_GUESTS => 8, EnquiryTableMap::COL_EVENING_GUESTS => 9, EnquiryTableMap::COL_YEAR => 10, EnquiryTableMap::COL_BUDGET => 11, EnquiryTableMap::COL_HEARD => 12, EnquiryTableMap::COL_COMMENT => 13, EnquiryTableMap::COL_CREATED_AT => 14, EnquiryTableMap::COL_UPDATED_AT => 15, EnquiryTableMap::COL_LOST_AT => 16, EnquiryTableMap::COL_PROMTED_AT => 17, EnquiryTableMap::COL_CONTACTED_AT => 18, ),
        self::TYPE_FIELDNAME     => array('entity_id' => 0, 'title' => 1, 'name' => 2, 'partner_name' => 3, 'email' => 4, 'telephone' => 5, 'mobile' => 6, 'address' => 7, 'day_guests' => 8, 'evening_guests' => 9, 'year' => 10, 'budget' => 11, 'heard' => 12, 'comment' => 13, 'created_at' => 14, 'updated_at' => 15, 'lost_at' => 16, 'promted_at' => 17, 'contacted_at' => 18, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('enquiry');
        $this->setPhpName('Enquiry');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Wedding\\Enquiry');
        $this->setPackage('Wedding');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('entity_id', 'EntityId', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 35, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('partner_name', 'PartnerName', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('telephone', 'Telephone', 'VARCHAR', false, 255, null);
        $this->addColumn('mobile', 'Mobile', 'VARCHAR', false, 255, null);
        $this->addColumn('address', 'Address', 'LONGVARCHAR', false, null, null);
        $this->addColumn('day_guests', 'DayGuests', 'INTEGER', false, null, 0);
        $this->addColumn('evening_guests', 'EveningGuests', 'INTEGER', false, null, 0);
        $this->addColumn('year', 'Year', 'VARCHAR', false, 255, null);
        $this->addColumn('budget', 'Budget', 'DECIMAL', false, 10, null);
        $this->addColumn('heard', 'Heard', 'VARCHAR', false, 255, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('lost_at', 'LostAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('promted_at', 'PromtedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('contacted_at', 'ContactedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('EnquiryComment', '\\Wedding\\EnquiryComment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':enquiry_id',
    1 => ':entity_id',
  ),
), 'CASCADE', 'CASCADE', 'EnquiryComments', false);
        $this->addRelation('Viewing', '\\Wedding\\Viewing', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':enquiry_id',
    1 => ':entity_id',
  ),
), 'CASCADE', 'CASCADE', 'Viewings', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to enquiry     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EnquiryCommentTableMap::clearInstancePool();
        ViewingTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntityId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntityId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntityId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntityId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntityId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntityId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('EntityId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }
    
    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? EnquiryTableMap::CLASS_DEFAULT : EnquiryTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Enquiry object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EnquiryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EnquiryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EnquiryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EnquiryTableMap::OM_CLASS;
            /** @var Enquiry $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EnquiryTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();
    
        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = EnquiryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EnquiryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Enquiry $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EnquiryTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(EnquiryTableMap::COL_ENTITY_ID);
            $criteria->addSelectColumn(EnquiryTableMap::COL_TITLE);
            $criteria->addSelectColumn(EnquiryTableMap::COL_NAME);
            $criteria->addSelectColumn(EnquiryTableMap::COL_PARTNER_NAME);
            $criteria->addSelectColumn(EnquiryTableMap::COL_EMAIL);
            $criteria->addSelectColumn(EnquiryTableMap::COL_TELEPHONE);
            $criteria->addSelectColumn(EnquiryTableMap::COL_MOBILE);
            $criteria->addSelectColumn(EnquiryTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(EnquiryTableMap::COL_DAY_GUESTS);
            $criteria->addSelectColumn(EnquiryTableMap::COL_EVENING_GUESTS);
            $criteria->addSelectColumn(EnquiryTableMap::COL_YEAR);
            $criteria->addSelectColumn(EnquiryTableMap::COL_BUDGET);
            $criteria->addSelectColumn(EnquiryTableMap::COL_HEARD);
            $criteria->addSelectColumn(EnquiryTableMap::COL_COMMENT);
            $criteria->addSelectColumn(EnquiryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EnquiryTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EnquiryTableMap::COL_LOST_AT);
            $criteria->addSelectColumn(EnquiryTableMap::COL_PROMTED_AT);
            $criteria->addSelectColumn(EnquiryTableMap::COL_CONTACTED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.entity_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.partner_name');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.telephone');
            $criteria->addSelectColumn($alias . '.mobile');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.day_guests');
            $criteria->addSelectColumn($alias . '.evening_guests');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.budget');
            $criteria->addSelectColumn($alias . '.heard');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.lost_at');
            $criteria->addSelectColumn($alias . '.promted_at');
            $criteria->addSelectColumn($alias . '.contacted_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(EnquiryTableMap::DATABASE_NAME)->getTable(EnquiryTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EnquiryTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EnquiryTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EnquiryTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Enquiry or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Enquiry object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Wedding\Enquiry) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EnquiryTableMap::DATABASE_NAME);
            $criteria->add(EnquiryTableMap::COL_ENTITY_ID, (array) $values, Criteria::IN);
        }

        $query = EnquiryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EnquiryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EnquiryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the enquiry table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EnquiryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Enquiry or Criteria object.
     *
     * @param mixed               $criteria Criteria or Enquiry object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Enquiry object
        }

        if ($criteria->containsKey(EnquiryTableMap::COL_ENTITY_ID) && $criteria->keyContainsValue(EnquiryTableMap::COL_ENTITY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EnquiryTableMap::COL_ENTITY_ID.')');
        }


        // Set the correct dbName
        $query = EnquiryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EnquiryTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EnquiryTableMap::buildTableMap();
