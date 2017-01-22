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
use Wedding\EnquiryComment as ChildEnquiryComment;
use Wedding\EnquiryCommentQuery as ChildEnquiryCommentQuery;
use Wedding\Map\EnquiryCommentTableMap;

/**
 * Base class that represents a query for the 'enquiry_comment' table.
 *
 * 
 *
 * @method     ChildEnquiryCommentQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildEnquiryCommentQuery orderByEnquiryId($order = Criteria::ASC) Order by the enquiry_id column
 * @method     ChildEnquiryCommentQuery orderByStaffId($order = Criteria::ASC) Order by the staff_id column
 * @method     ChildEnquiryCommentQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     ChildEnquiryCommentQuery groupByEntityId() Group by the entity_id column
 * @method     ChildEnquiryCommentQuery groupByEnquiryId() Group by the enquiry_id column
 * @method     ChildEnquiryCommentQuery groupByStaffId() Group by the staff_id column
 * @method     ChildEnquiryCommentQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     ChildEnquiryCommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEnquiryCommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEnquiryCommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEnquiryCommentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEnquiryCommentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEnquiryCommentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEnquiryCommentQuery leftJoinEnquiry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Enquiry relation
 * @method     ChildEnquiryCommentQuery rightJoinEnquiry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Enquiry relation
 * @method     ChildEnquiryCommentQuery innerJoinEnquiry($relationAlias = null) Adds a INNER JOIN clause to the query using the Enquiry relation
 *
 * @method     ChildEnquiryCommentQuery joinWithEnquiry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Enquiry relation
 *
 * @method     ChildEnquiryCommentQuery leftJoinWithEnquiry() Adds a LEFT JOIN clause and with to the query using the Enquiry relation
 * @method     ChildEnquiryCommentQuery rightJoinWithEnquiry() Adds a RIGHT JOIN clause and with to the query using the Enquiry relation
 * @method     ChildEnquiryCommentQuery innerJoinWithEnquiry() Adds a INNER JOIN clause and with to the query using the Enquiry relation
 *
 * @method     \Wedding\EnquiryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEnquiryComment findOne(ConnectionInterface $con = null) Return the first ChildEnquiryComment matching the query
 * @method     ChildEnquiryComment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEnquiryComment matching the query, or a new ChildEnquiryComment object populated from the query conditions when no match is found
 *
 * @method     ChildEnquiryComment findOneByEntityId(int $entity_id) Return the first ChildEnquiryComment filtered by the entity_id column
 * @method     ChildEnquiryComment findOneByEnquiryId(int $enquiry_id) Return the first ChildEnquiryComment filtered by the enquiry_id column
 * @method     ChildEnquiryComment findOneByStaffId(int $staff_id) Return the first ChildEnquiryComment filtered by the staff_id column
 * @method     ChildEnquiryComment findOneByCreatedAt(string $created_at) Return the first ChildEnquiryComment filtered by the created_at column *

 * @method     ChildEnquiryComment requirePk($key, ConnectionInterface $con = null) Return the ChildEnquiryComment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiryComment requireOne(ConnectionInterface $con = null) Return the first ChildEnquiryComment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEnquiryComment requireOneByEntityId(int $entity_id) Return the first ChildEnquiryComment filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiryComment requireOneByEnquiryId(int $enquiry_id) Return the first ChildEnquiryComment filtered by the enquiry_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiryComment requireOneByStaffId(int $staff_id) Return the first ChildEnquiryComment filtered by the staff_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiryComment requireOneByCreatedAt(string $created_at) Return the first ChildEnquiryComment filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEnquiryComment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEnquiryComment objects based on current ModelCriteria
 * @method     ChildEnquiryComment[]|ObjectCollection findByEntityId(int $entity_id) Return ChildEnquiryComment objects filtered by the entity_id column
 * @method     ChildEnquiryComment[]|ObjectCollection findByEnquiryId(int $enquiry_id) Return ChildEnquiryComment objects filtered by the enquiry_id column
 * @method     ChildEnquiryComment[]|ObjectCollection findByStaffId(int $staff_id) Return ChildEnquiryComment objects filtered by the staff_id column
 * @method     ChildEnquiryComment[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildEnquiryComment objects filtered by the created_at column
 * @method     ChildEnquiryComment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EnquiryCommentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\EnquiryCommentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\EnquiryComment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEnquiryCommentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEnquiryCommentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEnquiryCommentQuery) {
            return $criteria;
        }
        $query = new ChildEnquiryCommentQuery();
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
     * @return ChildEnquiryComment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EnquiryCommentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EnquiryCommentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEnquiryComment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, enquiry_id, staff_id, created_at FROM enquiry_comment WHERE entity_id = :p0';
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
            /** @var ChildEnquiryComment $obj */
            $obj = new ChildEnquiryComment();
            $obj->hydrate($row);
            EnquiryCommentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEnquiryComment|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEnquiryCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EnquiryCommentTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEnquiryCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EnquiryCommentTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildEnquiryCommentQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(EnquiryCommentTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(EnquiryCommentTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryCommentTableMap::COL_ENTITY_ID, $entityId, $comparison);
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
     * @return $this|ChildEnquiryCommentQuery The current query, for fluid interface
     */
    public function filterByEnquiryId($enquiryId = null, $comparison = null)
    {
        if (is_array($enquiryId)) {
            $useMinMax = false;
            if (isset($enquiryId['min'])) {
                $this->addUsingAlias(EnquiryCommentTableMap::COL_ENQUIRY_ID, $enquiryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enquiryId['max'])) {
                $this->addUsingAlias(EnquiryCommentTableMap::COL_ENQUIRY_ID, $enquiryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryCommentTableMap::COL_ENQUIRY_ID, $enquiryId, $comparison);
    }

    /**
     * Filter the query on the staff_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStaffId(1234); // WHERE staff_id = 1234
     * $query->filterByStaffId(array(12, 34)); // WHERE staff_id IN (12, 34)
     * $query->filterByStaffId(array('min' => 12)); // WHERE staff_id > 12
     * </code>
     *
     * @param     mixed $staffId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryCommentQuery The current query, for fluid interface
     */
    public function filterByStaffId($staffId = null, $comparison = null)
    {
        if (is_array($staffId)) {
            $useMinMax = false;
            if (isset($staffId['min'])) {
                $this->addUsingAlias(EnquiryCommentTableMap::COL_STAFF_ID, $staffId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($staffId['max'])) {
                $this->addUsingAlias(EnquiryCommentTableMap::COL_STAFF_ID, $staffId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryCommentTableMap::COL_STAFF_ID, $staffId, $comparison);
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
     * @return $this|ChildEnquiryCommentQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(EnquiryCommentTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EnquiryCommentTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryCommentTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\Enquiry object
     *
     * @param \Wedding\Enquiry|ObjectCollection $enquiry The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEnquiryCommentQuery The current query, for fluid interface
     */
    public function filterByEnquiry($enquiry, $comparison = null)
    {
        if ($enquiry instanceof \Wedding\Enquiry) {
            return $this
                ->addUsingAlias(EnquiryCommentTableMap::COL_ENQUIRY_ID, $enquiry->getEntityId(), $comparison);
        } elseif ($enquiry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EnquiryCommentTableMap::COL_ENQUIRY_ID, $enquiry->toKeyValue('PrimaryKey', 'EntityId'), $comparison);
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
     * @return $this|ChildEnquiryCommentQuery The current query, for fluid interface
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
     * @param   ChildEnquiryComment $enquiryComment Object to remove from the list of results
     *
     * @return $this|ChildEnquiryCommentQuery The current query, for fluid interface
     */
    public function prune($enquiryComment = null)
    {
        if ($enquiryComment) {
            $this->addUsingAlias(EnquiryCommentTableMap::COL_ENTITY_ID, $enquiryComment->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the enquiry_comment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryCommentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EnquiryCommentTableMap::clearInstancePool();
            EnquiryCommentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryCommentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EnquiryCommentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            EnquiryCommentTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            EnquiryCommentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EnquiryCommentQuery
