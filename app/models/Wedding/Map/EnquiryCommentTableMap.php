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
use Wedding\EnquiryComment;
use Wedding\EnquiryCommentQuery;


/**
 * This class defines the structure of the 'enquiry_comment' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EnquiryCommentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Wedding.Map.EnquiryCommentTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'enquiry_comment';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Wedding\\EnquiryComment';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Wedding.EnquiryComment';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the entity_id field
     */
    const COL_ENTITY_ID = 'enquiry_comment.entity_id';

    /**
     * the column name for the enquiry_id field
     */
    const COL_ENQUIRY_ID = 'enquiry_comment.enquiry_id';

    /**
     * the column name for the staff_id field
     */
    const COL_STAFF_ID = 'enquiry_comment.staff_id';

    /**
     * the column name for the comment field
     */
    const COL_COMMENT = 'enquiry_comment.comment';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'enquiry_comment.created_at';

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
        self::TYPE_PHPNAME       => array('EntityId', 'EnquiryId', 'StaffId', 'Comment', 'CreatedAt', ),
        self::TYPE_CAMELNAME     => array('entityId', 'enquiryId', 'staffId', 'comment', 'createdAt', ),
        self::TYPE_COLNAME       => array(EnquiryCommentTableMap::COL_ENTITY_ID, EnquiryCommentTableMap::COL_ENQUIRY_ID, EnquiryCommentTableMap::COL_STAFF_ID, EnquiryCommentTableMap::COL_COMMENT, EnquiryCommentTableMap::COL_CREATED_AT, ),
        self::TYPE_FIELDNAME     => array('entity_id', 'enquiry_id', 'staff_id', 'comment', 'created_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EntityId' => 0, 'EnquiryId' => 1, 'StaffId' => 2, 'Comment' => 3, 'CreatedAt' => 4, ),
        self::TYPE_CAMELNAME     => array('entityId' => 0, 'enquiryId' => 1, 'staffId' => 2, 'comment' => 3, 'createdAt' => 4, ),
        self::TYPE_COLNAME       => array(EnquiryCommentTableMap::COL_ENTITY_ID => 0, EnquiryCommentTableMap::COL_ENQUIRY_ID => 1, EnquiryCommentTableMap::COL_STAFF_ID => 2, EnquiryCommentTableMap::COL_COMMENT => 3, EnquiryCommentTableMap::COL_CREATED_AT => 4, ),
        self::TYPE_FIELDNAME     => array('entity_id' => 0, 'enquiry_id' => 1, 'staff_id' => 2, 'comment' => 3, 'created_at' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('enquiry_comment');
        $this->setPhpName('EnquiryComment');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Wedding\\EnquiryComment');
        $this->setPackage('Wedding');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('entity_id', 'EntityId', 'INTEGER', true, null, null);
        $this->addForeignKey('enquiry_id', 'EnquiryId', 'INTEGER', 'enquiry', 'entity_id', false, null, null);
        $this->addColumn('staff_id', 'StaffId', 'INTEGER', false, null, null);
        $this->addColumn('comment', 'Comment', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
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
    } // buildRelations()

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
        return $withPrefix ? EnquiryCommentTableMap::CLASS_DEFAULT : EnquiryCommentTableMap::OM_CLASS;
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
     * @return array           (EnquiryComment object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EnquiryCommentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EnquiryCommentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EnquiryCommentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EnquiryCommentTableMap::OM_CLASS;
            /** @var EnquiryComment $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EnquiryCommentTableMap::addInstanceToPool($obj, $key);
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
            $key = EnquiryCommentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EnquiryCommentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EnquiryComment $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EnquiryCommentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EnquiryCommentTableMap::COL_ENTITY_ID);
            $criteria->addSelectColumn(EnquiryCommentTableMap::COL_ENQUIRY_ID);
            $criteria->addSelectColumn(EnquiryCommentTableMap::COL_STAFF_ID);
            $criteria->addSelectColumn(EnquiryCommentTableMap::COL_COMMENT);
            $criteria->addSelectColumn(EnquiryCommentTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.entity_id');
            $criteria->addSelectColumn($alias . '.enquiry_id');
            $criteria->addSelectColumn($alias . '.staff_id');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.created_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(EnquiryCommentTableMap::DATABASE_NAME)->getTable(EnquiryCommentTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EnquiryCommentTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EnquiryCommentTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EnquiryCommentTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a EnquiryComment or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or EnquiryComment object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryCommentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Wedding\EnquiryComment) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EnquiryCommentTableMap::DATABASE_NAME);
            $criteria->add(EnquiryCommentTableMap::COL_ENTITY_ID, (array) $values, Criteria::IN);
        }

        $query = EnquiryCommentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EnquiryCommentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EnquiryCommentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the enquiry_comment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EnquiryCommentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EnquiryComment or Criteria object.
     *
     * @param mixed               $criteria Criteria or EnquiryComment object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryCommentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EnquiryComment object
        }

        if ($criteria->containsKey(EnquiryCommentTableMap::COL_ENTITY_ID) && $criteria->keyContainsValue(EnquiryCommentTableMap::COL_ENTITY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EnquiryCommentTableMap::COL_ENTITY_ID.')');
        }


        // Set the correct dbName
        $query = EnquiryCommentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EnquiryCommentTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EnquiryCommentTableMap::buildTableMap();
