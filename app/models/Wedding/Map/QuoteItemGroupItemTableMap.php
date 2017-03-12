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
use Wedding\QuoteItemGroupItem;
use Wedding\QuoteItemGroupItemQuery;


/**
 * This class defines the structure of the 'quote_item_group_item' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class QuoteItemGroupItemTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Wedding.Map.QuoteItemGroupItemTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'quote_item_group_item';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Wedding\\QuoteItemGroupItem';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Wedding.QuoteItemGroupItem';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the entity_id field
     */
    const COL_ENTITY_ID = 'quote_item_group_item.entity_id';

    /**
     * the column name for the quote_item_group_id field
     */
    const COL_QUOTE_ITEM_GROUP_ID = 'quote_item_group_item.quote_item_group_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'quote_item_group_item.name';

    /**
     * the column name for the suggested_price field
     */
    const COL_SUGGESTED_PRICE = 'quote_item_group_item.suggested_price';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'quote_item_group_item.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'quote_item_group_item.updated_at';

    /**
     * the column name for the archived_at field
     */
    const COL_ARCHIVED_AT = 'quote_item_group_item.archived_at';

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
        self::TYPE_PHPNAME       => array('EntityId', 'QuoteItemGroupId', 'Name', 'SuggestedPrice', 'CreatedAt', 'UpdatedAt', 'ArchivedAt', ),
        self::TYPE_CAMELNAME     => array('entityId', 'quoteItemGroupId', 'name', 'suggestedPrice', 'createdAt', 'updatedAt', 'archivedAt', ),
        self::TYPE_COLNAME       => array(QuoteItemGroupItemTableMap::COL_ENTITY_ID, QuoteItemGroupItemTableMap::COL_QUOTE_ITEM_GROUP_ID, QuoteItemGroupItemTableMap::COL_NAME, QuoteItemGroupItemTableMap::COL_SUGGESTED_PRICE, QuoteItemGroupItemTableMap::COL_CREATED_AT, QuoteItemGroupItemTableMap::COL_UPDATED_AT, QuoteItemGroupItemTableMap::COL_ARCHIVED_AT, ),
        self::TYPE_FIELDNAME     => array('entity_id', 'quote_item_group_id', 'name', 'suggested_price', 'created_at', 'updated_at', 'archived_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EntityId' => 0, 'QuoteItemGroupId' => 1, 'Name' => 2, 'SuggestedPrice' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'ArchivedAt' => 6, ),
        self::TYPE_CAMELNAME     => array('entityId' => 0, 'quoteItemGroupId' => 1, 'name' => 2, 'suggestedPrice' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'archivedAt' => 6, ),
        self::TYPE_COLNAME       => array(QuoteItemGroupItemTableMap::COL_ENTITY_ID => 0, QuoteItemGroupItemTableMap::COL_QUOTE_ITEM_GROUP_ID => 1, QuoteItemGroupItemTableMap::COL_NAME => 2, QuoteItemGroupItemTableMap::COL_SUGGESTED_PRICE => 3, QuoteItemGroupItemTableMap::COL_CREATED_AT => 4, QuoteItemGroupItemTableMap::COL_UPDATED_AT => 5, QuoteItemGroupItemTableMap::COL_ARCHIVED_AT => 6, ),
        self::TYPE_FIELDNAME     => array('entity_id' => 0, 'quote_item_group_id' => 1, 'name' => 2, 'suggested_price' => 3, 'created_at' => 4, 'updated_at' => 5, 'archived_at' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('quote_item_group_item');
        $this->setPhpName('QuoteItemGroupItem');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Wedding\\QuoteItemGroupItem');
        $this->setPackage('Wedding');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('entity_id', 'EntityId', 'INTEGER', true, null, null);
        $this->addForeignKey('quote_item_group_id', 'QuoteItemGroupId', 'INTEGER', 'quote_item_group', 'entity_id', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('suggested_price', 'SuggestedPrice', 'DECIMAL', false, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('archived_at', 'ArchivedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('QuoteItemGroup', '\\Wedding\\QuoteItemGroup', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':quote_item_group_id',
    1 => ':entity_id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('QuoteItem', '\\Wedding\\QuoteItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':quote_item_group_item_id',
    1 => ':entity_id',
  ),
), 'CASCADE', 'CASCADE', 'QuoteItems', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to quote_item_group_item     * by a foreign key with ON DELETE CASCADE
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
        return $withPrefix ? QuoteItemGroupItemTableMap::CLASS_DEFAULT : QuoteItemGroupItemTableMap::OM_CLASS;
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
     * @return array           (QuoteItemGroupItem object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = QuoteItemGroupItemTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = QuoteItemGroupItemTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + QuoteItemGroupItemTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = QuoteItemGroupItemTableMap::OM_CLASS;
            /** @var QuoteItemGroupItem $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            QuoteItemGroupItemTableMap::addInstanceToPool($obj, $key);
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
            $key = QuoteItemGroupItemTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = QuoteItemGroupItemTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var QuoteItemGroupItem $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                QuoteItemGroupItemTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(QuoteItemGroupItemTableMap::COL_ENTITY_ID);
            $criteria->addSelectColumn(QuoteItemGroupItemTableMap::COL_QUOTE_ITEM_GROUP_ID);
            $criteria->addSelectColumn(QuoteItemGroupItemTableMap::COL_NAME);
            $criteria->addSelectColumn(QuoteItemGroupItemTableMap::COL_SUGGESTED_PRICE);
            $criteria->addSelectColumn(QuoteItemGroupItemTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(QuoteItemGroupItemTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(QuoteItemGroupItemTableMap::COL_ARCHIVED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.entity_id');
            $criteria->addSelectColumn($alias . '.quote_item_group_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.suggested_price');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.archived_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(QuoteItemGroupItemTableMap::DATABASE_NAME)->getTable(QuoteItemGroupItemTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(QuoteItemGroupItemTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(QuoteItemGroupItemTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new QuoteItemGroupItemTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a QuoteItemGroupItem or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or QuoteItemGroupItem object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemGroupItemTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Wedding\QuoteItemGroupItem) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(QuoteItemGroupItemTableMap::DATABASE_NAME);
            $criteria->add(QuoteItemGroupItemTableMap::COL_ENTITY_ID, (array) $values, Criteria::IN);
        }

        $query = QuoteItemGroupItemQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            QuoteItemGroupItemTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                QuoteItemGroupItemTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the quote_item_group_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return QuoteItemGroupItemQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a QuoteItemGroupItem or Criteria object.
     *
     * @param mixed               $criteria Criteria or QuoteItemGroupItem object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemGroupItemTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from QuoteItemGroupItem object
        }

        if ($criteria->containsKey(QuoteItemGroupItemTableMap::COL_ENTITY_ID) && $criteria->keyContainsValue(QuoteItemGroupItemTableMap::COL_ENTITY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.QuoteItemGroupItemTableMap::COL_ENTITY_ID.')');
        }


        // Set the correct dbName
        $query = QuoteItemGroupItemQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // QuoteItemGroupItemTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
QuoteItemGroupItemTableMap::buildTableMap();
