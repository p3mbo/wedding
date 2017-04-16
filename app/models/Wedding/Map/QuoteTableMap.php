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
use Wedding\Quote;
use Wedding\QuoteQuery;


/**
 * This class defines the structure of the 'quote' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class QuoteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Wedding.Map.QuoteTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'quote';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Wedding\\Quote';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Wedding.Quote';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the entity_id field
     */
    const COL_ENTITY_ID = 'quote.entity_id';

    /**
     * the column name for the enquiry_id field
     */
    const COL_ENQUIRY_ID = 'quote.enquiry_id';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'quote.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'quote.updated_at';

    /**
     * the column name for the day field
     */
    const COL_DAY = 'quote.day';

    /**
     * the column name for the month field
     */
    const COL_MONTH = 'quote.month';

    /**
     * the column name for the year field
     */
    const COL_YEAR = 'quote.year';

    /**
     * the column name for the notes field
     */
    const COL_NOTES = 'quote.notes';

    /**
     * the column name for the exclusive field
     */
    const COL_EXCLUSIVE = 'quote.exclusive';

    /**
     * the column name for the specific_date field
     */
    const COL_SPECIFIC_DATE = 'quote.specific_date';

    /**
     * the column name for the day_guests field
     */
    const COL_DAY_GUESTS = 'quote.day_guests';

    /**
     * the column name for the eve_guests field
     */
    const COL_EVE_GUESTS = 'quote.eve_guests';

    /**
     * the column name for the ceremony_type_id field
     */
    const COL_CEREMONY_TYPE_ID = 'quote.ceremony_type_id';

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
        self::TYPE_PHPNAME       => array('EntityId', 'EnquiryId', 'CreatedAt', 'UpdatedAt', 'Day', 'Month', 'Year', 'Notes', 'Exclusive', 'SpecificDate', 'DayGuests', 'EveGuests', 'CeremonyTypeId', ),
        self::TYPE_CAMELNAME     => array('entityId', 'enquiryId', 'createdAt', 'updatedAt', 'day', 'month', 'year', 'notes', 'exclusive', 'specificDate', 'dayGuests', 'eveGuests', 'ceremonyTypeId', ),
        self::TYPE_COLNAME       => array(QuoteTableMap::COL_ENTITY_ID, QuoteTableMap::COL_ENQUIRY_ID, QuoteTableMap::COL_CREATED_AT, QuoteTableMap::COL_UPDATED_AT, QuoteTableMap::COL_DAY, QuoteTableMap::COL_MONTH, QuoteTableMap::COL_YEAR, QuoteTableMap::COL_NOTES, QuoteTableMap::COL_EXCLUSIVE, QuoteTableMap::COL_SPECIFIC_DATE, QuoteTableMap::COL_DAY_GUESTS, QuoteTableMap::COL_EVE_GUESTS, QuoteTableMap::COL_CEREMONY_TYPE_ID, ),
        self::TYPE_FIELDNAME     => array('entity_id', 'enquiry_id', 'created_at', 'updated_at', 'day', 'month', 'year', 'notes', 'exclusive', 'specific_date', 'day_guests', 'eve_guests', 'ceremony_type_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EntityId' => 0, 'EnquiryId' => 1, 'CreatedAt' => 2, 'UpdatedAt' => 3, 'Day' => 4, 'Month' => 5, 'Year' => 6, 'Notes' => 7, 'Exclusive' => 8, 'SpecificDate' => 9, 'DayGuests' => 10, 'EveGuests' => 11, 'CeremonyTypeId' => 12, ),
        self::TYPE_CAMELNAME     => array('entityId' => 0, 'enquiryId' => 1, 'createdAt' => 2, 'updatedAt' => 3, 'day' => 4, 'month' => 5, 'year' => 6, 'notes' => 7, 'exclusive' => 8, 'specificDate' => 9, 'dayGuests' => 10, 'eveGuests' => 11, 'ceremonyTypeId' => 12, ),
        self::TYPE_COLNAME       => array(QuoteTableMap::COL_ENTITY_ID => 0, QuoteTableMap::COL_ENQUIRY_ID => 1, QuoteTableMap::COL_CREATED_AT => 2, QuoteTableMap::COL_UPDATED_AT => 3, QuoteTableMap::COL_DAY => 4, QuoteTableMap::COL_MONTH => 5, QuoteTableMap::COL_YEAR => 6, QuoteTableMap::COL_NOTES => 7, QuoteTableMap::COL_EXCLUSIVE => 8, QuoteTableMap::COL_SPECIFIC_DATE => 9, QuoteTableMap::COL_DAY_GUESTS => 10, QuoteTableMap::COL_EVE_GUESTS => 11, QuoteTableMap::COL_CEREMONY_TYPE_ID => 12, ),
        self::TYPE_FIELDNAME     => array('entity_id' => 0, 'enquiry_id' => 1, 'created_at' => 2, 'updated_at' => 3, 'day' => 4, 'month' => 5, 'year' => 6, 'notes' => 7, 'exclusive' => 8, 'specific_date' => 9, 'day_guests' => 10, 'eve_guests' => 11, 'ceremony_type_id' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $this->setName('quote');
        $this->setPhpName('Quote');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Wedding\\Quote');
        $this->setPackage('Wedding');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('entity_id', 'EntityId', 'INTEGER', true, null, null);
        $this->addForeignKey('enquiry_id', 'EnquiryId', 'INTEGER', 'enquiry', 'entity_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('day', 'Day', 'VARCHAR', false, 255, null);
        $this->addColumn('month', 'Month', 'VARCHAR', false, 255, null);
        $this->addColumn('year', 'Year', 'VARCHAR', false, 255, null);
        $this->addColumn('notes', 'Notes', 'LONGVARCHAR', false, null, null);
        $this->addColumn('exclusive', 'Exclusive', 'VARCHAR', false, 255, null);
        $this->addColumn('specific_date', 'SpecificDate', 'VARCHAR', false, 255, null);
        $this->addColumn('day_guests', 'DayGuests', 'VARCHAR', false, 255, null);
        $this->addColumn('eve_guests', 'EveGuests', 'VARCHAR', false, 255, null);
        $this->addColumn('ceremony_type_id', 'CeremonyTypeId', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Enquiry', '\\Wedding\\Enquiry', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':enquiry_id',
    1 => ':entity_id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('QuoteItem', '\\Wedding\\QuoteItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':quote_id',
    1 => ':entity_id',
  ),
), 'CASCADE', 'CASCADE', 'QuoteItems', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to quote     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        QuoteItemTableMap::clearInstancePool();
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
        return $withPrefix ? QuoteTableMap::CLASS_DEFAULT : QuoteTableMap::OM_CLASS;
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
     * @return array           (Quote object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = QuoteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = QuoteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + QuoteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = QuoteTableMap::OM_CLASS;
            /** @var Quote $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            QuoteTableMap::addInstanceToPool($obj, $key);
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
            $key = QuoteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = QuoteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Quote $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                QuoteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(QuoteTableMap::COL_ENTITY_ID);
            $criteria->addSelectColumn(QuoteTableMap::COL_ENQUIRY_ID);
            $criteria->addSelectColumn(QuoteTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(QuoteTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(QuoteTableMap::COL_DAY);
            $criteria->addSelectColumn(QuoteTableMap::COL_MONTH);
            $criteria->addSelectColumn(QuoteTableMap::COL_YEAR);
            $criteria->addSelectColumn(QuoteTableMap::COL_NOTES);
            $criteria->addSelectColumn(QuoteTableMap::COL_EXCLUSIVE);
            $criteria->addSelectColumn(QuoteTableMap::COL_SPECIFIC_DATE);
            $criteria->addSelectColumn(QuoteTableMap::COL_DAY_GUESTS);
            $criteria->addSelectColumn(QuoteTableMap::COL_EVE_GUESTS);
            $criteria->addSelectColumn(QuoteTableMap::COL_CEREMONY_TYPE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.entity_id');
            $criteria->addSelectColumn($alias . '.enquiry_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.day');
            $criteria->addSelectColumn($alias . '.month');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.exclusive');
            $criteria->addSelectColumn($alias . '.specific_date');
            $criteria->addSelectColumn($alias . '.day_guests');
            $criteria->addSelectColumn($alias . '.eve_guests');
            $criteria->addSelectColumn($alias . '.ceremony_type_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(QuoteTableMap::DATABASE_NAME)->getTable(QuoteTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(QuoteTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(QuoteTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new QuoteTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Quote or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Quote object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Wedding\Quote) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(QuoteTableMap::DATABASE_NAME);
            $criteria->add(QuoteTableMap::COL_ENTITY_ID, (array) $values, Criteria::IN);
        }

        $query = QuoteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            QuoteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                QuoteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the quote table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return QuoteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Quote or Criteria object.
     *
     * @param mixed               $criteria Criteria or Quote object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Quote object
        }

        if ($criteria->containsKey(QuoteTableMap::COL_ENTITY_ID) && $criteria->keyContainsValue(QuoteTableMap::COL_ENTITY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.QuoteTableMap::COL_ENTITY_ID.')');
        }


        // Set the correct dbName
        $query = QuoteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // QuoteTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
QuoteTableMap::buildTableMap();
