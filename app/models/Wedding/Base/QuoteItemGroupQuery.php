<?php

namespace Wedding\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Wedding\QuoteItemGroup as ChildQuoteItemGroup;
use Wedding\QuoteItemGroupQuery as ChildQuoteItemGroupQuery;
use Wedding\Map\QuoteItemGroupTableMap;

/**
 * Base class that represents a query for the 'quote_item_group' table.
 *
 * 
 *
 * @method     ChildQuoteItemGroupQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildQuoteItemGroupQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildQuoteItemGroupQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildQuoteItemGroupQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildQuoteItemGroupQuery orderByArchivedAt($order = Criteria::ASC) Order by the archived_at column
 *
 * @method     ChildQuoteItemGroupQuery groupByEntityId() Group by the entity_id column
 * @method     ChildQuoteItemGroupQuery groupByName() Group by the name column
 * @method     ChildQuoteItemGroupQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildQuoteItemGroupQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildQuoteItemGroupQuery groupByArchivedAt() Group by the archived_at column
 *
 * @method     ChildQuoteItemGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildQuoteItemGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildQuoteItemGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildQuoteItemGroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildQuoteItemGroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildQuoteItemGroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildQuoteItemGroupQuery leftJoinQuoteItemGroupItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the QuoteItemGroupItem relation
 * @method     ChildQuoteItemGroupQuery rightJoinQuoteItemGroupItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the QuoteItemGroupItem relation
 * @method     ChildQuoteItemGroupQuery innerJoinQuoteItemGroupItem($relationAlias = null) Adds a INNER JOIN clause to the query using the QuoteItemGroupItem relation
 *
 * @method     ChildQuoteItemGroupQuery joinWithQuoteItemGroupItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the QuoteItemGroupItem relation
 *
 * @method     ChildQuoteItemGroupQuery leftJoinWithQuoteItemGroupItem() Adds a LEFT JOIN clause and with to the query using the QuoteItemGroupItem relation
 * @method     ChildQuoteItemGroupQuery rightJoinWithQuoteItemGroupItem() Adds a RIGHT JOIN clause and with to the query using the QuoteItemGroupItem relation
 * @method     ChildQuoteItemGroupQuery innerJoinWithQuoteItemGroupItem() Adds a INNER JOIN clause and with to the query using the QuoteItemGroupItem relation
 *
 * @method     \Wedding\QuoteItemGroupItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildQuoteItemGroup findOne(ConnectionInterface $con = null) Return the first ChildQuoteItemGroup matching the query
 * @method     ChildQuoteItemGroup findOneOrCreate(ConnectionInterface $con = null) Return the first ChildQuoteItemGroup matching the query, or a new ChildQuoteItemGroup object populated from the query conditions when no match is found
 *
 * @method     ChildQuoteItemGroup findOneByEntityId(int $entity_id) Return the first ChildQuoteItemGroup filtered by the entity_id column
 * @method     ChildQuoteItemGroup findOneByName(string $name) Return the first ChildQuoteItemGroup filtered by the name column
 * @method     ChildQuoteItemGroup findOneByCreatedAt(string $created_at) Return the first ChildQuoteItemGroup filtered by the created_at column
 * @method     ChildQuoteItemGroup findOneByUpdatedAt(string $updated_at) Return the first ChildQuoteItemGroup filtered by the updated_at column
 * @method     ChildQuoteItemGroup findOneByArchivedAt(string $archived_at) Return the first ChildQuoteItemGroup filtered by the archived_at column *

 * @method     ChildQuoteItemGroup requirePk($key, ConnectionInterface $con = null) Return the ChildQuoteItemGroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroup requireOne(ConnectionInterface $con = null) Return the first ChildQuoteItemGroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuoteItemGroup requireOneByEntityId(int $entity_id) Return the first ChildQuoteItemGroup filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroup requireOneByName(string $name) Return the first ChildQuoteItemGroup filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroup requireOneByCreatedAt(string $created_at) Return the first ChildQuoteItemGroup filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroup requireOneByUpdatedAt(string $updated_at) Return the first ChildQuoteItemGroup filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroup requireOneByArchivedAt(string $archived_at) Return the first ChildQuoteItemGroup filtered by the archived_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuoteItemGroup[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildQuoteItemGroup objects based on current ModelCriteria
 * @method     ChildQuoteItemGroup[]|ObjectCollection findByEntityId(int $entity_id) Return ChildQuoteItemGroup objects filtered by the entity_id column
 * @method     ChildQuoteItemGroup[]|ObjectCollection findByName(string $name) Return ChildQuoteItemGroup objects filtered by the name column
 * @method     ChildQuoteItemGroup[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildQuoteItemGroup objects filtered by the created_at column
 * @method     ChildQuoteItemGroup[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildQuoteItemGroup objects filtered by the updated_at column
 * @method     ChildQuoteItemGroup[]|ObjectCollection findByArchivedAt(string $archived_at) Return ChildQuoteItemGroup objects filtered by the archived_at column
 * @method     ChildQuoteItemGroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class QuoteItemGroupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\QuoteItemGroupQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\QuoteItemGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildQuoteItemGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildQuoteItemGroupQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildQuoteItemGroupQuery) {
            return $criteria;
        }
        $query = new ChildQuoteItemGroupQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildQuoteItemGroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(QuoteItemGroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = QuoteItemGroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuoteItemGroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, name, created_at, updated_at, archived_at FROM quote_item_group WHERE entity_id = :p0';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildQuoteItemGroup $obj */
            $obj = new ChildQuoteItemGroup();
            $obj->hydrate($row);
            QuoteItemGroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildQuoteItemGroup|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(QuoteItemGroupTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(QuoteItemGroupTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the entity_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEntityId(1234); // WHERE entity_id = 1234
     * $query->filterByEntityId(array(12, 34)); // WHERE entity_id IN (12, 34)
     * $query->filterByEntityId(array('min' => 12)); // WHERE entity_id > 12
     * </code>
     *
     * @param     mixed $entityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(QuoteItemGroupTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(QuoteItemGroupTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupTableMap::COL_ENTITY_ID, $entityId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(QuoteItemGroupTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(QuoteItemGroupTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(QuoteItemGroupTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(QuoteItemGroupTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the archived_at column
     *
     * Example usage:
     * <code>
     * $query->filterByArchivedAt('2011-03-14'); // WHERE archived_at = '2011-03-14'
     * $query->filterByArchivedAt('now'); // WHERE archived_at = '2011-03-14'
     * $query->filterByArchivedAt(array('max' => 'yesterday')); // WHERE archived_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $archivedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function filterByArchivedAt($archivedAt = null, $comparison = null)
    {
        if (is_array($archivedAt)) {
            $useMinMax = false;
            if (isset($archivedAt['min'])) {
                $this->addUsingAlias(QuoteItemGroupTableMap::COL_ARCHIVED_AT, $archivedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($archivedAt['max'])) {
                $this->addUsingAlias(QuoteItemGroupTableMap::COL_ARCHIVED_AT, $archivedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupTableMap::COL_ARCHIVED_AT, $archivedAt, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\QuoteItemGroupItem object
     *
     * @param \Wedding\QuoteItemGroupItem|ObjectCollection $quoteItemGroupItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function filterByQuoteItemGroupItem($quoteItemGroupItem, $comparison = null)
    {
        if ($quoteItemGroupItem instanceof \Wedding\QuoteItemGroupItem) {
            return $this
                ->addUsingAlias(QuoteItemGroupTableMap::COL_ENTITY_ID, $quoteItemGroupItem->getQuoteItemGroupId(), $comparison);
        } elseif ($quoteItemGroupItem instanceof ObjectCollection) {
            return $this
                ->useQuoteItemGroupItemQuery()
                ->filterByPrimaryKeys($quoteItemGroupItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByQuoteItemGroupItem() only accepts arguments of type \Wedding\QuoteItemGroupItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the QuoteItemGroupItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function joinQuoteItemGroupItem($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('QuoteItemGroupItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'QuoteItemGroupItem');
        }

        return $this;
    }

    /**
     * Use the QuoteItemGroupItem relation QuoteItemGroupItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Wedding\QuoteItemGroupItemQuery A secondary query class using the current class as primary query
     */
    public function useQuoteItemGroupItemQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinQuoteItemGroupItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'QuoteItemGroupItem', '\Wedding\QuoteItemGroupItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildQuoteItemGroup $quoteItemGroup Object to remove from the list of results
     *
     * @return $this|ChildQuoteItemGroupQuery The current query, for fluid interface
     */
    public function prune($quoteItemGroup = null)
    {
        if ($quoteItemGroup) {
            $this->addUsingAlias(QuoteItemGroupTableMap::COL_ENTITY_ID, $quoteItemGroup->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the quote_item_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemGroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            QuoteItemGroupTableMap::clearInstancePool();
            QuoteItemGroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemGroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(QuoteItemGroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            QuoteItemGroupTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            QuoteItemGroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // QuoteItemGroupQuery
