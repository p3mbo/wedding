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
use Wedding\QuoteItemGroupItem as ChildQuoteItemGroupItem;
use Wedding\QuoteItemGroupItemQuery as ChildQuoteItemGroupItemQuery;
use Wedding\Map\QuoteItemGroupItemTableMap;

/**
 * Base class that represents a query for the 'quote_item_group_item' table.
 *
 * 
 *
 * @method     ChildQuoteItemGroupItemQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildQuoteItemGroupItemQuery orderByQuoteItemGroupId($order = Criteria::ASC) Order by the quote_item_group_id column
 * @method     ChildQuoteItemGroupItemQuery orderByTaxClassId($order = Criteria::ASC) Order by the tax_class_id column
 * @method     ChildQuoteItemGroupItemQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildQuoteItemGroupItemQuery orderBySuggestedPrice($order = Criteria::ASC) Order by the suggested_price column
 * @method     ChildQuoteItemGroupItemQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildQuoteItemGroupItemQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildQuoteItemGroupItemQuery orderByArchivedAt($order = Criteria::ASC) Order by the archived_at column
 *
 * @method     ChildQuoteItemGroupItemQuery groupByEntityId() Group by the entity_id column
 * @method     ChildQuoteItemGroupItemQuery groupByQuoteItemGroupId() Group by the quote_item_group_id column
 * @method     ChildQuoteItemGroupItemQuery groupByTaxClassId() Group by the tax_class_id column
 * @method     ChildQuoteItemGroupItemQuery groupByName() Group by the name column
 * @method     ChildQuoteItemGroupItemQuery groupBySuggestedPrice() Group by the suggested_price column
 * @method     ChildQuoteItemGroupItemQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildQuoteItemGroupItemQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildQuoteItemGroupItemQuery groupByArchivedAt() Group by the archived_at column
 *
 * @method     ChildQuoteItemGroupItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildQuoteItemGroupItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildQuoteItemGroupItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildQuoteItemGroupItemQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildQuoteItemGroupItemQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildQuoteItemGroupItemQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildQuoteItemGroupItemQuery leftJoinQuoteItemGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the QuoteItemGroup relation
 * @method     ChildQuoteItemGroupItemQuery rightJoinQuoteItemGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the QuoteItemGroup relation
 * @method     ChildQuoteItemGroupItemQuery innerJoinQuoteItemGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the QuoteItemGroup relation
 *
 * @method     ChildQuoteItemGroupItemQuery joinWithQuoteItemGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the QuoteItemGroup relation
 *
 * @method     ChildQuoteItemGroupItemQuery leftJoinWithQuoteItemGroup() Adds a LEFT JOIN clause and with to the query using the QuoteItemGroup relation
 * @method     ChildQuoteItemGroupItemQuery rightJoinWithQuoteItemGroup() Adds a RIGHT JOIN clause and with to the query using the QuoteItemGroup relation
 * @method     ChildQuoteItemGroupItemQuery innerJoinWithQuoteItemGroup() Adds a INNER JOIN clause and with to the query using the QuoteItemGroup relation
 *
 * @method     ChildQuoteItemGroupItemQuery leftJoinTaxClass($relationAlias = null) Adds a LEFT JOIN clause to the query using the TaxClass relation
 * @method     ChildQuoteItemGroupItemQuery rightJoinTaxClass($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TaxClass relation
 * @method     ChildQuoteItemGroupItemQuery innerJoinTaxClass($relationAlias = null) Adds a INNER JOIN clause to the query using the TaxClass relation
 *
 * @method     ChildQuoteItemGroupItemQuery joinWithTaxClass($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TaxClass relation
 *
 * @method     ChildQuoteItemGroupItemQuery leftJoinWithTaxClass() Adds a LEFT JOIN clause and with to the query using the TaxClass relation
 * @method     ChildQuoteItemGroupItemQuery rightJoinWithTaxClass() Adds a RIGHT JOIN clause and with to the query using the TaxClass relation
 * @method     ChildQuoteItemGroupItemQuery innerJoinWithTaxClass() Adds a INNER JOIN clause and with to the query using the TaxClass relation
 *
 * @method     ChildQuoteItemGroupItemQuery leftJoinQuoteItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the QuoteItem relation
 * @method     ChildQuoteItemGroupItemQuery rightJoinQuoteItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the QuoteItem relation
 * @method     ChildQuoteItemGroupItemQuery innerJoinQuoteItem($relationAlias = null) Adds a INNER JOIN clause to the query using the QuoteItem relation
 *
 * @method     ChildQuoteItemGroupItemQuery joinWithQuoteItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the QuoteItem relation
 *
 * @method     ChildQuoteItemGroupItemQuery leftJoinWithQuoteItem() Adds a LEFT JOIN clause and with to the query using the QuoteItem relation
 * @method     ChildQuoteItemGroupItemQuery rightJoinWithQuoteItem() Adds a RIGHT JOIN clause and with to the query using the QuoteItem relation
 * @method     ChildQuoteItemGroupItemQuery innerJoinWithQuoteItem() Adds a INNER JOIN clause and with to the query using the QuoteItem relation
 *
 * @method     \Wedding\QuoteItemGroupQuery|\Wedding\TaxClassQuery|\Wedding\QuoteItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildQuoteItemGroupItem findOne(ConnectionInterface $con = null) Return the first ChildQuoteItemGroupItem matching the query
 * @method     ChildQuoteItemGroupItem findOneOrCreate(ConnectionInterface $con = null) Return the first ChildQuoteItemGroupItem matching the query, or a new ChildQuoteItemGroupItem object populated from the query conditions when no match is found
 *
 * @method     ChildQuoteItemGroupItem findOneByEntityId(int $entity_id) Return the first ChildQuoteItemGroupItem filtered by the entity_id column
 * @method     ChildQuoteItemGroupItem findOneByQuoteItemGroupId(int $quote_item_group_id) Return the first ChildQuoteItemGroupItem filtered by the quote_item_group_id column
 * @method     ChildQuoteItemGroupItem findOneByTaxClassId(int $tax_class_id) Return the first ChildQuoteItemGroupItem filtered by the tax_class_id column
 * @method     ChildQuoteItemGroupItem findOneByName(string $name) Return the first ChildQuoteItemGroupItem filtered by the name column
 * @method     ChildQuoteItemGroupItem findOneBySuggestedPrice(string $suggested_price) Return the first ChildQuoteItemGroupItem filtered by the suggested_price column
 * @method     ChildQuoteItemGroupItem findOneByCreatedAt(string $created_at) Return the first ChildQuoteItemGroupItem filtered by the created_at column
 * @method     ChildQuoteItemGroupItem findOneByUpdatedAt(string $updated_at) Return the first ChildQuoteItemGroupItem filtered by the updated_at column
 * @method     ChildQuoteItemGroupItem findOneByArchivedAt(string $archived_at) Return the first ChildQuoteItemGroupItem filtered by the archived_at column *

 * @method     ChildQuoteItemGroupItem requirePk($key, ConnectionInterface $con = null) Return the ChildQuoteItemGroupItem by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroupItem requireOne(ConnectionInterface $con = null) Return the first ChildQuoteItemGroupItem matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuoteItemGroupItem requireOneByEntityId(int $entity_id) Return the first ChildQuoteItemGroupItem filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroupItem requireOneByQuoteItemGroupId(int $quote_item_group_id) Return the first ChildQuoteItemGroupItem filtered by the quote_item_group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroupItem requireOneByTaxClassId(int $tax_class_id) Return the first ChildQuoteItemGroupItem filtered by the tax_class_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroupItem requireOneByName(string $name) Return the first ChildQuoteItemGroupItem filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroupItem requireOneBySuggestedPrice(string $suggested_price) Return the first ChildQuoteItemGroupItem filtered by the suggested_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroupItem requireOneByCreatedAt(string $created_at) Return the first ChildQuoteItemGroupItem filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroupItem requireOneByUpdatedAt(string $updated_at) Return the first ChildQuoteItemGroupItem filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuoteItemGroupItem requireOneByArchivedAt(string $archived_at) Return the first ChildQuoteItemGroupItem filtered by the archived_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildQuoteItemGroupItem objects based on current ModelCriteria
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection findByEntityId(int $entity_id) Return ChildQuoteItemGroupItem objects filtered by the entity_id column
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection findByQuoteItemGroupId(int $quote_item_group_id) Return ChildQuoteItemGroupItem objects filtered by the quote_item_group_id column
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection findByTaxClassId(int $tax_class_id) Return ChildQuoteItemGroupItem objects filtered by the tax_class_id column
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection findByName(string $name) Return ChildQuoteItemGroupItem objects filtered by the name column
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection findBySuggestedPrice(string $suggested_price) Return ChildQuoteItemGroupItem objects filtered by the suggested_price column
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildQuoteItemGroupItem objects filtered by the created_at column
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildQuoteItemGroupItem objects filtered by the updated_at column
 * @method     ChildQuoteItemGroupItem[]|ObjectCollection findByArchivedAt(string $archived_at) Return ChildQuoteItemGroupItem objects filtered by the archived_at column
 * @method     ChildQuoteItemGroupItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class QuoteItemGroupItemQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\QuoteItemGroupItemQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\QuoteItemGroupItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildQuoteItemGroupItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildQuoteItemGroupItemQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildQuoteItemGroupItemQuery) {
            return $criteria;
        }
        $query = new ChildQuoteItemGroupItemQuery();
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
     * @return ChildQuoteItemGroupItem|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(QuoteItemGroupItemTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = QuoteItemGroupItemTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildQuoteItemGroupItem A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, quote_item_group_id, tax_class_id, name, suggested_price, created_at, updated_at, archived_at FROM quote_item_group_item WHERE entity_id = :p0';
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
            /** @var ChildQuoteItemGroupItem $obj */
            $obj = new ChildQuoteItemGroupItem();
            $obj->hydrate($row);
            QuoteItemGroupItemTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildQuoteItemGroupItem|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ENTITY_ID, $entityId, $comparison);
    }

    /**
     * Filter the query on the quote_item_group_id column
     *
     * Example usage:
     * <code>
     * $query->filterByQuoteItemGroupId(1234); // WHERE quote_item_group_id = 1234
     * $query->filterByQuoteItemGroupId(array(12, 34)); // WHERE quote_item_group_id IN (12, 34)
     * $query->filterByQuoteItemGroupId(array('min' => 12)); // WHERE quote_item_group_id > 12
     * </code>
     *
     * @see       filterByQuoteItemGroup()
     *
     * @param     mixed $quoteItemGroupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByQuoteItemGroupId($quoteItemGroupId = null, $comparison = null)
    {
        if (is_array($quoteItemGroupId)) {
            $useMinMax = false;
            if (isset($quoteItemGroupId['min'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_QUOTE_ITEM_GROUP_ID, $quoteItemGroupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quoteItemGroupId['max'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_QUOTE_ITEM_GROUP_ID, $quoteItemGroupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_QUOTE_ITEM_GROUP_ID, $quoteItemGroupId, $comparison);
    }

    /**
     * Filter the query on the tax_class_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxClassId(1234); // WHERE tax_class_id = 1234
     * $query->filterByTaxClassId(array(12, 34)); // WHERE tax_class_id IN (12, 34)
     * $query->filterByTaxClassId(array('min' => 12)); // WHERE tax_class_id > 12
     * </code>
     *
     * @see       filterByTaxClass()
     *
     * @param     mixed $taxClassId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByTaxClassId($taxClassId = null, $comparison = null)
    {
        if (is_array($taxClassId)) {
            $useMinMax = false;
            if (isset($taxClassId['min'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_TAX_CLASS_ID, $taxClassId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($taxClassId['max'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_TAX_CLASS_ID, $taxClassId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_TAX_CLASS_ID, $taxClassId, $comparison);
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
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the suggested_price column
     *
     * Example usage:
     * <code>
     * $query->filterBySuggestedPrice(1234); // WHERE suggested_price = 1234
     * $query->filterBySuggestedPrice(array(12, 34)); // WHERE suggested_price IN (12, 34)
     * $query->filterBySuggestedPrice(array('min' => 12)); // WHERE suggested_price > 12
     * </code>
     *
     * @param     mixed $suggestedPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterBySuggestedPrice($suggestedPrice = null, $comparison = null)
    {
        if (is_array($suggestedPrice)) {
            $useMinMax = false;
            if (isset($suggestedPrice['min'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_SUGGESTED_PRICE, $suggestedPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($suggestedPrice['max'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_SUGGESTED_PRICE, $suggestedPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_SUGGESTED_PRICE, $suggestedPrice, $comparison);
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
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByArchivedAt($archivedAt = null, $comparison = null)
    {
        if (is_array($archivedAt)) {
            $useMinMax = false;
            if (isset($archivedAt['min'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ARCHIVED_AT, $archivedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($archivedAt['max'])) {
                $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ARCHIVED_AT, $archivedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ARCHIVED_AT, $archivedAt, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\QuoteItemGroup object
     *
     * @param \Wedding\QuoteItemGroup|ObjectCollection $quoteItemGroup The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByQuoteItemGroup($quoteItemGroup, $comparison = null)
    {
        if ($quoteItemGroup instanceof \Wedding\QuoteItemGroup) {
            return $this
                ->addUsingAlias(QuoteItemGroupItemTableMap::COL_QUOTE_ITEM_GROUP_ID, $quoteItemGroup->getEntityId(), $comparison);
        } elseif ($quoteItemGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(QuoteItemGroupItemTableMap::COL_QUOTE_ITEM_GROUP_ID, $quoteItemGroup->toKeyValue('PrimaryKey', 'EntityId'), $comparison);
        } else {
            throw new PropelException('filterByQuoteItemGroup() only accepts arguments of type \Wedding\QuoteItemGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the QuoteItemGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function joinQuoteItemGroup($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('QuoteItemGroup');

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
            $this->addJoinObject($join, 'QuoteItemGroup');
        }

        return $this;
    }

    /**
     * Use the QuoteItemGroup relation QuoteItemGroup object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Wedding\QuoteItemGroupQuery A secondary query class using the current class as primary query
     */
    public function useQuoteItemGroupQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinQuoteItemGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'QuoteItemGroup', '\Wedding\QuoteItemGroupQuery');
    }

    /**
     * Filter the query by a related \Wedding\TaxClass object
     *
     * @param \Wedding\TaxClass|ObjectCollection $taxClass The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByTaxClass($taxClass, $comparison = null)
    {
        if ($taxClass instanceof \Wedding\TaxClass) {
            return $this
                ->addUsingAlias(QuoteItemGroupItemTableMap::COL_TAX_CLASS_ID, $taxClass->getEntityId(), $comparison);
        } elseif ($taxClass instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(QuoteItemGroupItemTableMap::COL_TAX_CLASS_ID, $taxClass->toKeyValue('PrimaryKey', 'EntityId'), $comparison);
        } else {
            throw new PropelException('filterByTaxClass() only accepts arguments of type \Wedding\TaxClass or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TaxClass relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function joinTaxClass($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TaxClass');

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
            $this->addJoinObject($join, 'TaxClass');
        }

        return $this;
    }

    /**
     * Use the TaxClass relation TaxClass object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Wedding\TaxClassQuery A secondary query class using the current class as primary query
     */
    public function useTaxClassQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTaxClass($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TaxClass', '\Wedding\TaxClassQuery');
    }

    /**
     * Filter the query by a related \Wedding\QuoteItem object
     *
     * @param \Wedding\QuoteItem|ObjectCollection $quoteItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function filterByQuoteItem($quoteItem, $comparison = null)
    {
        if ($quoteItem instanceof \Wedding\QuoteItem) {
            return $this
                ->addUsingAlias(QuoteItemGroupItemTableMap::COL_ENTITY_ID, $quoteItem->getQuoteItemGroupItemId(), $comparison);
        } elseif ($quoteItem instanceof ObjectCollection) {
            return $this
                ->useQuoteItemQuery()
                ->filterByPrimaryKeys($quoteItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByQuoteItem() only accepts arguments of type \Wedding\QuoteItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the QuoteItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function joinQuoteItem($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('QuoteItem');

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
            $this->addJoinObject($join, 'QuoteItem');
        }

        return $this;
    }

    /**
     * Use the QuoteItem relation QuoteItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Wedding\QuoteItemQuery A secondary query class using the current class as primary query
     */
    public function useQuoteItemQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinQuoteItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'QuoteItem', '\Wedding\QuoteItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildQuoteItemGroupItem $quoteItemGroupItem Object to remove from the list of results
     *
     * @return $this|ChildQuoteItemGroupItemQuery The current query, for fluid interface
     */
    public function prune($quoteItemGroupItem = null)
    {
        if ($quoteItemGroupItem) {
            $this->addUsingAlias(QuoteItemGroupItemTableMap::COL_ENTITY_ID, $quoteItemGroupItem->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the quote_item_group_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemGroupItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            QuoteItemGroupItemTableMap::clearInstancePool();
            QuoteItemGroupItemTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteItemGroupItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(QuoteItemGroupItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            QuoteItemGroupItemTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            QuoteItemGroupItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // QuoteItemGroupItemQuery
