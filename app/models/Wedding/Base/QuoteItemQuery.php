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
use Wedding\QuoteItem as ChildQuoteItem;
use Wedding\QuoteItemQuery as ChildQuoteItemQuery;
use Wedding\Map\QuoteItemTableMap;

/**
 * Base class that represents a query for the 'quote_item' table.
 *
 * 
 *
 * @method     ChildQuoteItemQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildQuoteItemQuery orderByQuoteItemGroupItemId($order = Criteria::ASC) Order by the quote_item_group_item_id column
 * @method     ChildQuoteItemQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildQuoteItemQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildQuoteItemQuery orderByPrice($order = Criteria::ASC) Order by the price column
 *
 * @method     ChildQuoteItemQuery groupByEntityId() Group by the entity_id column
 * @method     ChildQuoteItemQuery groupByQuoteItemGroupItemId() Group by the quote_item_group_item_id column
 * @method     ChildQuoteItemQuery groupByQty() Group by the qty column
 * @method     ChildQuoteItemQuery groupByNotes() Group by the notes column
 * @method     ChildQuoteItemQuery groupByPrice() Group by the price column
 *
 * @method     ChildQuoteItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildQuoteItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildQuoteItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildQuoteItemQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildQuoteItemQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildQuoteItemQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildQuoteItemQuery leftJoinQuoteItemGroupItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the QuoteItemGroupItem relation
 * @method     ChildQuoteItemQuery rightJoinQuoteItemGroupItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the QuoteItemGroupItem relation
 * @method     ChildQuoteItemQuery innerJoinQuoteItemGroupItem($relationAlias = null) Adds a INNER JOIN clause to the query using the QuoteItemGroupItem relation
 *
 * @method     ChildQuoteItemQuery joinWithQuoteItemGroupItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the QuoteItemGroupItem relation
 *
 * @method     ChildQuoteItemQuery leftJoinWithQuoteItemGroupItem() Adds a LEFT JOIN clause and with to the query using the QuoteItemGroupItem relation
 * @method     ChildQuoteItemQuery rightJoinWithQuoteItemGroupItem() Adds a RIGHT JOIN clause and with to the query using the QuoteItemGroupItem relation
 * @method     ChildQuoteItemQuery innerJoinWithQuoteItemGroupItem() Adds a INNER JOIN clause and with to the query using the QuoteItemGroupItem relation
 *
 * @method     \Wedding\QuoteItemGroupItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildQuoteItem findOne(ConnectionInterface $con = null) Return the first ChildQuoteItem matching the query
 * @method     ChildQuoteItem findOneOrCreate(ConnectionInterface $con = null) Return the first ChildQuoteItem matching the query, or a new ChildQuoteItem object populated from the query conditions when no match is found
 *
 * @method     ChildQuoteItem findOneByEntityId(int $entity_id) Return the first ChildQuoteItem filtered by the entity_id column
 * @method     ChildQuoteItem findOneByQuoteItemGroupItemId(int $quote_item_group_item_id) Return the first ChildQuoteItem filtered by the quote_item_group_item_id column
 * @method     ChildQuoteItem findOneByQty(int $qty) Return the first ChildQuoteItem filtered by the qty column
 * @method     ChildQuoteItem findOneByNotes(string $notes) Return the first ChildQuoteItem filtered by the notes column
 * @method     ChildQuoteItem findOneByPrice(string $price) Return the first ChildQuoteItem filtered by the price column *

 * @method     ChildQuoteItem requirePk($key, ConnectionInterface $con = null) Return the ChildQuoteItem by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItem requireOne(ConnectionInterface $con = null) Return the first ChildQuoteItem matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuoteItem requireOneByEntityId(int $entity_id) Return the first ChildQuoteItem filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItem requireOneByQuoteItemGroupItemId(int $quote_item_group_item_id) Return the first ChildQuoteItem filtered by the quote_item_group_item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItem requireOneByQty(int $qty) Return the first ChildQuoteItem filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItem requireOneByNotes(string $notes) Return the first ChildQuoteItem filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItem requireOneByPrice(string $price) Return the first ChildQuoteItem filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuoteItem[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildQuoteItem objects based on current ModelCriteria
 * @method     ChildQuoteItem[]|ObjectCollection findByEntityId(int $entity_id) Return ChildQuoteItem objects filtered by the entity_id column
 * @method     ChildQuoteItem[]|ObjectCollection findByQuoteItemGroupItemId(int $quote_item_group_item_id) Return ChildQuoteItem objects filtered by the quote_item_group_item_id column
 * @method     ChildQuoteItem[]|ObjectCollection findByQty(int $qty) Return ChildQuoteItem objects filtered by the qty column
 * @method     ChildQuoteItem[]|ObjectCollection findByNotes(string $notes) Return ChildQuoteItem objects filtered by the notes column
 * @method     ChildQuoteItem[]|ObjectCollection findByPrice(string $price) Return ChildQuoteItem objects filtered by the price column
 * @method     ChildQuoteItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class QuoteItemQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\QuoteItemQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\QuoteItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildQuoteItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildQuoteItemQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildQuoteItemQuery) {
            return $criteria;
        }
        $query = new ChildQuoteItemQuery();
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
     * @return ChildQuoteItem|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(QuoteItemTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = QuoteItemTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildQuoteItem A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, quote_item_group_item_id, qty, notes, price FROM quote_item WHERE entity_id = :p0';
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
            /** @var ChildQuoteItem $obj */
            $obj = new ChildQuoteItem();
            $obj->hydrate($row);
            QuoteItemTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildQuoteItem|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(QuoteItemTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(QuoteItemTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(QuoteItemTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(QuoteItemTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemTableMap::COL_ENTITY_ID, $entityId, $comparison);
    }

    /**
     * Filter the query on the quote_item_group_item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByQuoteItemGroupItemId(1234); // WHERE quote_item_group_item_id = 1234
     * $query->filterByQuoteItemGroupItemId(array(12, 34)); // WHERE quote_item_group_item_id IN (12, 34)
     * $query->filterByQuoteItemGroupItemId(array('min' => 12)); // WHERE quote_item_group_item_id > 12
     * </code>
     *
     * @see       filterByQuoteItemGroupItem()
     *
     * @param     mixed $quoteItemGroupItemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
     */
    public function filterByQuoteItemGroupItemId($quoteItemGroupItemId = null, $comparison = null)
    {
        if (is_array($quoteItemGroupItemId)) {
            $useMinMax = false;
            if (isset($quoteItemGroupItemId['min'])) {
                $this->addUsingAlias(QuoteItemTableMap::COL_QUOTE_ITEM_GROUP_ITEM_ID, $quoteItemGroupItemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quoteItemGroupItemId['max'])) {
                $this->addUsingAlias(QuoteItemTableMap::COL_QUOTE_ITEM_GROUP_ITEM_ID, $quoteItemGroupItemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemTableMap::COL_QUOTE_ITEM_GROUP_ITEM_ID, $quoteItemGroupItemId, $comparison);
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param     mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(QuoteItemTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(QuoteItemTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemTableMap::COL_QTY, $qty, $comparison);
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE notes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemTableMap::COL_NOTES, $notes, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(QuoteItemTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(QuoteItemTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\QuoteItemGroupItem object
     *
     * @param \Wedding\QuoteItemGroupItem|ObjectCollection $quoteItemGroupItem The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuoteItemQuery The current query, for fluid interface
     */
    public function filterByQuoteItemGroupItem($quoteItemGroupItem, $comparison = null)
    {
        if ($quoteItemGroupItem instanceof \Wedding\QuoteItemGroupItem) {
            return $this
                ->addUsingAlias(QuoteItemTableMap::COL_QUOTE_ITEM_GROUP_ITEM_ID, $quoteItemGroupItem->getEntityId(), $comparison);
        } elseif ($quoteItemGroupItem instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(QuoteItemTableMap::COL_QUOTE_ITEM_GROUP_ITEM_ID, $quoteItemGroupItem->toKeyValue('PrimaryKey', 'EntityId'), $comparison);
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
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
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
     * @param   ChildQuoteItem $quoteItem Object to remove from the list of results
     *
     * @return $this|ChildQuoteItemQuery The current query, for fluid interface
     */
    public function prune($quoteItem = null)
    {
        if ($quoteItem) {
            $this->addUsingAlias(QuoteItemTableMap::COL_ENTITY_ID, $quoteItem->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the quote_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            QuoteItemTableMap::clearInstancePool();
            QuoteItemTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(QuoteItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            QuoteItemTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            QuoteItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // QuoteItemQuery
