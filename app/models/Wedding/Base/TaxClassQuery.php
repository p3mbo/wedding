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
use Wedding\TaxClass as ChildTaxClass;
use Wedding\TaxClassQuery as ChildTaxClassQuery;
use Wedding\Map\TaxClassTableMap;

/**
 * Base class that represents a query for the 'tax_class' table.
 *
 * 
 *
 * @method     ChildTaxClassQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildTaxClassQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildTaxClassQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildTaxClassQuery groupByEntityId() Group by the entity_id column
 * @method     ChildTaxClassQuery groupByName() Group by the name column
 * @method     ChildTaxClassQuery groupByValue() Group by the value column
 *
 * @method     ChildTaxClassQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTaxClassQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTaxClassQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTaxClassQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTaxClassQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTaxClassQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTaxClassQuery leftJoinQuoteItemGroupItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the QuoteItemGroupItem relation
 * @method     ChildTaxClassQuery rightJoinQuoteItemGroupItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the QuoteItemGroupItem relation
 * @method     ChildTaxClassQuery innerJoinQuoteItemGroupItem($relationAlias = null) Adds a INNER JOIN clause to the query using the QuoteItemGroupItem relation
 *
 * @method     ChildTaxClassQuery joinWithQuoteItemGroupItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the QuoteItemGroupItem relation
 *
 * @method     ChildTaxClassQuery leftJoinWithQuoteItemGroupItem() Adds a LEFT JOIN clause and with to the query using the QuoteItemGroupItem relation
 * @method     ChildTaxClassQuery rightJoinWithQuoteItemGroupItem() Adds a RIGHT JOIN clause and with to the query using the QuoteItemGroupItem relation
 * @method     ChildTaxClassQuery innerJoinWithQuoteItemGroupItem() Adds a INNER JOIN clause and with to the query using the QuoteItemGroupItem relation
 *
 * @method     \Wedding\QuoteItemGroupItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTaxClass findOne(ConnectionInterface $con = null) Return the first ChildTaxClass matching the query
 * @method     ChildTaxClass findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTaxClass matching the query, or a new ChildTaxClass object populated from the query conditions when no match is found
 *
 * @method     ChildTaxClass findOneByEntityId(int $entity_id) Return the first ChildTaxClass filtered by the entity_id column
 * @method     ChildTaxClass findOneByName(string $name) Return the first ChildTaxClass filtered by the name column
 * @method     ChildTaxClass findOneByValue(int $value) Return the first ChildTaxClass filtered by the value column *

 * @method     ChildTaxClass requirePk($key, ConnectionInterface $con = null) Return the ChildTaxClass by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaxClass requireOne(ConnectionInterface $con = null) Return the first ChildTaxClass matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTaxClass requireOneByEntityId(int $entity_id) Return the first ChildTaxClass filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaxClass requireOneByName(string $name) Return the first ChildTaxClass filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTaxClass requireOneByValue(int $value) Return the first ChildTaxClass filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTaxClass[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTaxClass objects based on current ModelCriteria
 * @method     ChildTaxClass[]|ObjectCollection findByEntityId(int $entity_id) Return ChildTaxClass objects filtered by the entity_id column
 * @method     ChildTaxClass[]|ObjectCollection findByName(string $name) Return ChildTaxClass objects filtered by the name column
 * @method     ChildTaxClass[]|ObjectCollection findByValue(int $value) Return ChildTaxClass objects filtered by the value column
 * @method     ChildTaxClass[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TaxClassQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\TaxClassQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\TaxClass', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTaxClassQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTaxClassQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTaxClassQuery) {
            return $criteria;
        }
        $query = new ChildTaxClassQuery();
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
     * @return ChildTaxClass|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TaxClassTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TaxClassTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTaxClass A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, name, value FROM tax_class WHERE entity_id = :p0';
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
            /** @var ChildTaxClass $obj */
            $obj = new ChildTaxClass();
            $obj->hydrate($row);
            TaxClassTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTaxClass|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTaxClassQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TaxClassTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTaxClassQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TaxClassTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildTaxClassQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(TaxClassTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(TaxClassTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaxClassTableMap::COL_ENTITY_ID, $entityId, $comparison);
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
     * @return $this|ChildTaxClassQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaxClassTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTaxClassQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(TaxClassTableMap::COL_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(TaxClassTableMap::COL_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TaxClassTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\QuoteItemGroupItem object
     *
     * @param \Wedding\QuoteItemGroupItem|ObjectCollection $quoteItemGroupItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTaxClassQuery The current query, for fluid interface
     */
    public function filterByQuoteItemGroupItem($quoteItemGroupItem, $comparison = null)
    {
        if ($quoteItemGroupItem instanceof \Wedding\QuoteItemGroupItem) {
            return $this
                ->addUsingAlias(TaxClassTableMap::COL_ENTITY_ID, $quoteItemGroupItem->getTaxClassId(), $comparison);
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
     * @return $this|ChildTaxClassQuery The current query, for fluid interface
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
     * @param   ChildTaxClass $taxClass Object to remove from the list of results
     *
     * @return $this|ChildTaxClassQuery The current query, for fluid interface
     */
    public function prune($taxClass = null)
    {
        if ($taxClass) {
            $this->addUsingAlias(TaxClassTableMap::COL_ENTITY_ID, $taxClass->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tax_class table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TaxClassTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TaxClassTableMap::clearInstancePool();
            TaxClassTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TaxClassTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TaxClassTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            TaxClassTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            TaxClassTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TaxClassQuery
