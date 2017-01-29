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
use Wedding\Viewing as ChildViewing;
use Wedding\ViewingQuery as ChildViewingQuery;
use Wedding\Map\ViewingTableMap;

/**
 * Base class that represents a query for the 'viewing' table.
 *
 * 
 *
 * @method     ChildViewingQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildViewingQuery orderByEnquiryId($order = Criteria::ASC) Order by the enquiry_id column
 * @method     ChildViewingQuery orderByViewingAt($order = Criteria::ASC) Order by the viewing_at column
 * @method     ChildViewingQuery orderByAssignedTo($order = Criteria::ASC) Order by the assigned_to column
 * @method     ChildViewingQuery orderByNoshowAt($order = Criteria::ASC) Order by the noshow_at column
 * @method     ChildViewingQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildViewingQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildViewingQuery groupByEntityId() Group by the entity_id column
 * @method     ChildViewingQuery groupByEnquiryId() Group by the enquiry_id column
 * @method     ChildViewingQuery groupByViewingAt() Group by the viewing_at column
 * @method     ChildViewingQuery groupByAssignedTo() Group by the assigned_to column
 * @method     ChildViewingQuery groupByNoshowAt() Group by the noshow_at column
 * @method     ChildViewingQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildViewingQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildViewingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildViewingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildViewingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildViewingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildViewingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildViewingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildViewingQuery leftJoinStaff($relationAlias = null) Adds a LEFT JOIN clause to the query using the Staff relation
 * @method     ChildViewingQuery rightJoinStaff($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Staff relation
 * @method     ChildViewingQuery innerJoinStaff($relationAlias = null) Adds a INNER JOIN clause to the query using the Staff relation
 *
 * @method     ChildViewingQuery joinWithStaff($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Staff relation
 *
 * @method     ChildViewingQuery leftJoinWithStaff() Adds a LEFT JOIN clause and with to the query using the Staff relation
 * @method     ChildViewingQuery rightJoinWithStaff() Adds a RIGHT JOIN clause and with to the query using the Staff relation
 * @method     ChildViewingQuery innerJoinWithStaff() Adds a INNER JOIN clause and with to the query using the Staff relation
 *
 * @method     ChildViewingQuery leftJoinEnquiry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Enquiry relation
 * @method     ChildViewingQuery rightJoinEnquiry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Enquiry relation
 * @method     ChildViewingQuery innerJoinEnquiry($relationAlias = null) Adds a INNER JOIN clause to the query using the Enquiry relation
 *
 * @method     ChildViewingQuery joinWithEnquiry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Enquiry relation
 *
 * @method     ChildViewingQuery leftJoinWithEnquiry() Adds a LEFT JOIN clause and with to the query using the Enquiry relation
 * @method     ChildViewingQuery rightJoinWithEnquiry() Adds a RIGHT JOIN clause and with to the query using the Enquiry relation
 * @method     ChildViewingQuery innerJoinWithEnquiry() Adds a INNER JOIN clause and with to the query using the Enquiry relation
 *
 * @method     \Wedding\StaffQuery|\Wedding\EnquiryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildViewing findOne(ConnectionInterface $con = null) Return the first ChildViewing matching the query
 * @method     ChildViewing findOneOrCreate(ConnectionInterface $con = null) Return the first ChildViewing matching the query, or a new ChildViewing object populated from the query conditions when no match is found
 *
 * @method     ChildViewing findOneByEntityId(int $entity_id) Return the first ChildViewing filtered by the entity_id column
 * @method     ChildViewing findOneByEnquiryId(int $enquiry_id) Return the first ChildViewing filtered by the enquiry_id column
 * @method     ChildViewing findOneByViewingAt(string $viewing_at) Return the first ChildViewing filtered by the viewing_at column
 * @method     ChildViewing findOneByAssignedTo(int $assigned_to) Return the first ChildViewing filtered by the assigned_to column
 * @method     ChildViewing findOneByNoshowAt(string $noshow_at) Return the first ChildViewing filtered by the noshow_at column
 * @method     ChildViewing findOneByCreatedAt(string $created_at) Return the first ChildViewing filtered by the created_at column
 * @method     ChildViewing findOneByUpdatedAt(string $updated_at) Return the first ChildViewing filtered by the updated_at column *

 * @method     ChildViewing requirePk($key, ConnectionInterface $con = null) Return the ChildViewing by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViewing requireOne(ConnectionInterface $con = null) Return the first ChildViewing matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildViewing requireOneByEntityId(int $entity_id) Return the first ChildViewing filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViewing requireOneByEnquiryId(int $enquiry_id) Return the first ChildViewing filtered by the enquiry_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViewing requireOneByViewingAt(string $viewing_at) Return the first ChildViewing filtered by the viewing_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViewing requireOneByAssignedTo(int $assigned_to) Return the first ChildViewing filtered by the assigned_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViewing requireOneByNoshowAt(string $noshow_at) Return the first ChildViewing filtered by the noshow_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViewing requireOneByCreatedAt(string $created_at) Return the first ChildViewing filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildViewing requireOneByUpdatedAt(string $updated_at) Return the first ChildViewing filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildViewing[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildViewing objects based on current ModelCriteria
 * @method     ChildViewing[]|ObjectCollection findByEntityId(int $entity_id) Return ChildViewing objects filtered by the entity_id column
 * @method     ChildViewing[]|ObjectCollection findByEnquiryId(int $enquiry_id) Return ChildViewing objects filtered by the enquiry_id column
 * @method     ChildViewing[]|ObjectCollection findByViewingAt(string $viewing_at) Return ChildViewing objects filtered by the viewing_at column
 * @method     ChildViewing[]|ObjectCollection findByAssignedTo(int $assigned_to) Return ChildViewing objects filtered by the assigned_to column
 * @method     ChildViewing[]|ObjectCollection findByNoshowAt(string $noshow_at) Return ChildViewing objects filtered by the noshow_at column
 * @method     ChildViewing[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildViewing objects filtered by the created_at column
 * @method     ChildViewing[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildViewing objects filtered by the updated_at column
 * @method     ChildViewing[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ViewingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\ViewingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\Viewing', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildViewingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildViewingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildViewingQuery) {
            return $criteria;
        }
        $query = new ChildViewingQuery();
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
     * @return ChildViewing|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ViewingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ViewingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildViewing A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, enquiry_id, viewing_at, assigned_to, noshow_at, created_at, updated_at FROM viewing WHERE entity_id = :p0';
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
            /** @var ChildViewing $obj */
            $obj = new ChildViewing();
            $obj->hydrate($row);
            ViewingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildViewing|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ViewingTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ViewingTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(ViewingTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(ViewingTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViewingTableMap::COL_ENTITY_ID, $entityId, $comparison);
    }

    /**
     * Filter the query on the enquiry_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEnquiryId(1234); // WHERE enquiry_id = 1234
     * $query->filterByEnquiryId(array(12, 34)); // WHERE enquiry_id IN (12, 34)
     * $query->filterByEnquiryId(array('min' => 12)); // WHERE enquiry_id > 12
     * </code>
     *
     * @see       filterByEnquiry()
     *
     * @param     mixed $enquiryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByEnquiryId($enquiryId = null, $comparison = null)
    {
        if (is_array($enquiryId)) {
            $useMinMax = false;
            if (isset($enquiryId['min'])) {
                $this->addUsingAlias(ViewingTableMap::COL_ENQUIRY_ID, $enquiryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enquiryId['max'])) {
                $this->addUsingAlias(ViewingTableMap::COL_ENQUIRY_ID, $enquiryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViewingTableMap::COL_ENQUIRY_ID, $enquiryId, $comparison);
    }

    /**
     * Filter the query on the viewing_at column
     *
     * Example usage:
     * <code>
     * $query->filterByViewingAt('2011-03-14'); // WHERE viewing_at = '2011-03-14'
     * $query->filterByViewingAt('now'); // WHERE viewing_at = '2011-03-14'
     * $query->filterByViewingAt(array('max' => 'yesterday')); // WHERE viewing_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $viewingAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByViewingAt($viewingAt = null, $comparison = null)
    {
        if (is_array($viewingAt)) {
            $useMinMax = false;
            if (isset($viewingAt['min'])) {
                $this->addUsingAlias(ViewingTableMap::COL_VIEWING_AT, $viewingAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($viewingAt['max'])) {
                $this->addUsingAlias(ViewingTableMap::COL_VIEWING_AT, $viewingAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViewingTableMap::COL_VIEWING_AT, $viewingAt, $comparison);
    }

    /**
     * Filter the query on the assigned_to column
     *
     * Example usage:
     * <code>
     * $query->filterByAssignedTo(1234); // WHERE assigned_to = 1234
     * $query->filterByAssignedTo(array(12, 34)); // WHERE assigned_to IN (12, 34)
     * $query->filterByAssignedTo(array('min' => 12)); // WHERE assigned_to > 12
     * </code>
     *
     * @see       filterByStaff()
     *
     * @param     mixed $assignedTo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByAssignedTo($assignedTo = null, $comparison = null)
    {
        if (is_array($assignedTo)) {
            $useMinMax = false;
            if (isset($assignedTo['min'])) {
                $this->addUsingAlias(ViewingTableMap::COL_ASSIGNED_TO, $assignedTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($assignedTo['max'])) {
                $this->addUsingAlias(ViewingTableMap::COL_ASSIGNED_TO, $assignedTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViewingTableMap::COL_ASSIGNED_TO, $assignedTo, $comparison);
    }

    /**
     * Filter the query on the noshow_at column
     *
     * Example usage:
     * <code>
     * $query->filterByNoshowAt('2011-03-14'); // WHERE noshow_at = '2011-03-14'
     * $query->filterByNoshowAt('now'); // WHERE noshow_at = '2011-03-14'
     * $query->filterByNoshowAt(array('max' => 'yesterday')); // WHERE noshow_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $noshowAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByNoshowAt($noshowAt = null, $comparison = null)
    {
        if (is_array($noshowAt)) {
            $useMinMax = false;
            if (isset($noshowAt['min'])) {
                $this->addUsingAlias(ViewingTableMap::COL_NOSHOW_AT, $noshowAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($noshowAt['max'])) {
                $this->addUsingAlias(ViewingTableMap::COL_NOSHOW_AT, $noshowAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViewingTableMap::COL_NOSHOW_AT, $noshowAt, $comparison);
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
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ViewingTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ViewingTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViewingTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ViewingTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ViewingTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ViewingTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\Staff object
     *
     * @param \Wedding\Staff|ObjectCollection $staff The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildViewingQuery The current query, for fluid interface
     */
    public function filterByStaff($staff, $comparison = null)
    {
        if ($staff instanceof \Wedding\Staff) {
            return $this
                ->addUsingAlias(ViewingTableMap::COL_ASSIGNED_TO, $staff->getEntityId(), $comparison);
        } elseif ($staff instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ViewingTableMap::COL_ASSIGNED_TO, $staff->toKeyValue('PrimaryKey', 'EntityId'), $comparison);
        } else {
            throw new PropelException('filterByStaff() only accepts arguments of type \Wedding\Staff or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Staff relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function joinStaff($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Staff');

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
            $this->addJoinObject($join, 'Staff');
        }

        return $this;
    }

    /**
     * Use the Staff relation Staff object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Wedding\StaffQuery A secondary query class using the current class as primary query
     */
    public function useStaffQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStaff($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Staff', '\Wedding\StaffQuery');
    }

    /**
     * Filter the query by a related \Wedding\Enquiry object
     *
     * @param \Wedding\Enquiry|ObjectCollection $enquiry The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildViewingQuery The current query, for fluid interface
     */
    public function filterByEnquiry($enquiry, $comparison = null)
    {
        if ($enquiry instanceof \Wedding\Enquiry) {
            return $this
                ->addUsingAlias(ViewingTableMap::COL_ENQUIRY_ID, $enquiry->getEntityId(), $comparison);
        } elseif ($enquiry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ViewingTableMap::COL_ENQUIRY_ID, $enquiry->toKeyValue('PrimaryKey', 'EntityId'), $comparison);
        } else {
            throw new PropelException('filterByEnquiry() only accepts arguments of type \Wedding\Enquiry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Enquiry relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function joinEnquiry($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Enquiry');

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
            $this->addJoinObject($join, 'Enquiry');
        }

        return $this;
    }

    /**
     * Use the Enquiry relation Enquiry object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Wedding\EnquiryQuery A secondary query class using the current class as primary query
     */
    public function useEnquiryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEnquiry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Enquiry', '\Wedding\EnquiryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildViewing $viewing Object to remove from the list of results
     *
     * @return $this|ChildViewingQuery The current query, for fluid interface
     */
    public function prune($viewing = null)
    {
        if ($viewing) {
            $this->addUsingAlias(ViewingTableMap::COL_ENTITY_ID, $viewing->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the viewing table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ViewingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ViewingTableMap::clearInstancePool();
            ViewingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ViewingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ViewingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ViewingTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ViewingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ViewingQuery
