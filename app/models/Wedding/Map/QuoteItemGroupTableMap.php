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
use Wedding\QuoteItemGroup;
use Wedding\QuoteItemGroupQuery;


/**
 * This class defines the structure of the 'quote_item_group' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class QuoteItemGroupTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Wedding.Map.QuoteItemGroupTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'quote_item_group';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Wedding\\QuoteItemGroup';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Wedding.QuoteItemGroup';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the entity_id field
     */
    const COL_ENTITY_ID = 'quote_item_group.entity_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'quote_item_group.name';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'quote_item_group.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'quote_item_group.updated_at';

    /**
     * the column name for the archived_at field
     */
    const COL_ARCHIVED_AT = 'quote_item_group.archived_at';

    /**
     * the column name for the sort_order field
     */
    const COL_SORT_ORDER = 'quote_item_group.sort_order';

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
        self::TYPE_PHPNAME       => array('EntityId', 'Name', 'CreatedAt', 'UpdatedAt', 'ArchivedAt', 'SortOrder', ),
        self::TYPE_CAMELNAME     => array('entityId', 'name', 'createdAt', 'updatedAt', 'archivedAt', 'sortOrder', ),
        self::TYPE_COLNAME       => array(QuoteItemGroupTableMap::COL_ENTITY_ID, QuoteItemGroupTableMap::COL_NAME, QuoteItemGroupTableMap::COL_CREATED_AT, QuoteItemGroupTableMap::COL_UPDATED_AT, QuoteItemGroupTableMap::COL_ARCHIVED_AT, QuoteItemGroupTableMap::COL_SORT_ORDER, ),
        self::TYPE_FIELDNAME     => array('entity_id', 'name', 'created_at', 'updated_at', 'archived_at', 'sort_order', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EntityId' => 0, 'Name' => 1, 'CreatedAt' => 2, 'UpdatedAt' => 3, 'ArchivedAt' => 4, 'SortOrder' => 5, ),
        self::TYPE_CAMELNAME     => array('entityId' => 0, 'name' => 1, 'createdAt' => 2, 'updatedAt' => 3, 'archivedAt' => 4, 'sortOrder' => 5, ),
        self::TYPE_COLNAME       => array(QuoteItemGroupTableMap::COL_ENTITY_ID => 0, QuoteItemGroupTableMap::COL_NAME => 1, QuoteItemGroupTableMap::COL_CREATED_AT => 2, QuoteItemGroupTableMap::COL_UPDATED_AT => 3, QuoteItemGroupTableMap::COL_ARCHIVED_AT => 4, QuoteItemGroupTableMap::COL_SORT_ORDER => 5, ),
        self::TYPE_FIELDNAME     => array('entity_id' => 0, 'name' => 1, 'created_at' => 2, 'updated_at' => 3, 'archived_at' => 4, 'sort_order' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('quote_item_group');
        $this->setPhpName('QuoteItemGroup');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Wedding\\QuoteItemGroup');
        $this->setPackage('Wedding');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('entity_id', 'EntityId', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('archived_at', 'ArchivedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('sort_order', 'SortOrder', 'INTEGER', false, 10, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('QuoteItemGroupItem', '\\Wedding\\QuoteItemGroupItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':quote_item_group_id',
    1 => ':entity_id',
  ),
), 'CASCADE', 'CASCADE', 'QuoteItemGroupItems', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to quote_item_group     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        QuoteItemGroupItemTableMap::clearInstancePool();
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
        return $withPrefix ? QuoteItemGroupTableMap::CLASS_DEFAULT : QuoteItemGroupTableMap::OM_CLASS;
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
     * @return array           (QuoteItemGroup object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = QuoteItemGroupTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = QuoteItemGroupTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + QuoteItemGroupTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = QuoteItemGroupTableMap::OM_CLASS;
            /** @var QuoteItemGroup $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            QuoteItemGroupTableMap::addInstanceToPool($obj, $key);
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
            $key = QuoteItemGroupTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = QuoteItemGroupTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var QuoteItemGroup $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                QuoteItemGroupTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(QuoteItemGroupTableMap::COL_ENTITY_ID);
            $criteria->addSelectColumn(QuoteItemGroupTableMap::COL_NAME);
            $criteria->addSelectColumn(QuoteItemGroupTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(QuoteItemGroupTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(QuoteItemGroupTableMap::COL_ARCHIVED_AT);
            $criteria->addSelectColumn(QuoteItemGroupTableMap::COL_SORT_ORDER);
        } else {
            $criteria->addSelectColumn($alias . '.entity_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.archived_at');
            $criteria->addSelectColumn($alias . '.sort_order');
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
        return Propel::getServiceContainer()->getDatabaseMap(QuoteItemGroupTableMap::DATABASE_NAME)->getTable(QuoteItemGroupTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(QuoteItemGroupTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(QuoteItemGroupTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new QuoteItemGroupTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a QuoteItemGroup or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or QuoteItemGroup object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemGroupTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Wedding\QuoteItemGroup) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(QuoteItemGroupTableMap::DATABASE_NAME);
            $criteria->add(QuoteItemGroupTableMap::COL_ENTITY_ID, (array) $values, Criteria::IN);
        }

        $query = QuoteItemGroupQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            QuoteItemGroupTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                QuoteItemGroupTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the quote_item_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return QuoteItemGroupQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a QuoteItemGroup or Criteria object.
     *
     * @param mixed               $criteria Criteria or QuoteItemGroup object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemGroupTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from QuoteItemGroup object
        }

        if ($criteria->containsKey(QuoteItemGroupTableMap::COL_ENTITY_ID) && $criteria->keyContainsValue(QuoteItemGroupTableMap::COL_ENTITY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.QuoteItemGroupTableMap::COL_ENTITY_ID.')');
        }


        // Set the correct dbName
        $query = QuoteItemGroupQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // QuoteItemGroupTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
QuoteItemGroupTableMap::buildTableMap();
