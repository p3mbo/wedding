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
use Wedding\Staff as ChildStaff;
use Wedding\StaffQuery as ChildStaffQuery;
use Wedding\Map\StaffTableMap;

/**
 * Base class that represents a query for the 'staff' table.
 *
 * 
 *
 * @method     ChildStaffQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildStaffQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStaffQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildStaffQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildStaffQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildStaffQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildStaffQuery orderByArchivedAt($order = Criteria::ASC) Order by the archived_at column
 *
 * @method     ChildStaffQuery groupByEntityId() Group by the entity_id column
 * @method     ChildStaffQuery groupByName() Group by the name column
 * @method     ChildStaffQuery groupByEmail() Group by the email column
 * @method     ChildStaffQuery groupByPassword() Group by the password column
 * @method     ChildStaffQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildStaffQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildStaffQuery groupByArchivedAt() Group by the archived_at column
 *
 * @method     ChildStaffQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStaffQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStaffQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStaffQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStaffQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStaffQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStaffQuery leftJoinEnquiryComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the EnquiryComment relation
 * @method     ChildStaffQuery rightJoinEnquiryComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EnquiryComment relation
 * @method     ChildStaffQuery innerJoinEnquiryComment($relationAlias = null) Adds a INNER JOIN clause to the query using the EnquiryComment relation
 *
 * @method     ChildStaffQuery joinWithEnquiryComment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EnquiryComment relation
 *
 * @method     ChildStaffQuery leftJoinWithEnquiryComment() Adds a LEFT JOIN clause and with to the query using the EnquiryComment relation
 * @method     ChildStaffQuery rightJoinWithEnquiryComment() Adds a RIGHT JOIN clause and with to the query using the EnquiryComment relation
 * @method     ChildStaffQuery innerJoinWithEnquiryComment() Adds a INNER JOIN clause and with to the query using the EnquiryComment relation
 *
 * @method     ChildStaffQuery leftJoinViewing($relationAlias = null) Adds a LEFT JOIN clause to the query using the Viewing relation
 * @method     ChildStaffQuery rightJoinViewing($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Viewing relation
 * @method     ChildStaffQuery innerJoinViewing($relationAlias = null) Adds a INNER JOIN clause to the query using the Viewing relation
 *
 * @method     ChildStaffQuery joinWithViewing($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Viewing relation
 *
 * @method     ChildStaffQuery leftJoinWithViewing() Adds a LEFT JOIN clause and with to the query using the Viewing relation
 * @method     ChildStaffQuery rightJoinWithViewing() Adds a RIGHT JOIN clause and with to the query using the Viewing relation
 * @method     ChildStaffQuery innerJoinWithViewing() Adds a INNER JOIN clause and with to the query using the Viewing relation
 *
 * @method     \Wedding\EnquiryCommentQuery|\Wedding\ViewingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStaff findOne(ConnectionInterface $con = null) Return the first ChildStaff matching the query
 * @method     ChildStaff findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStaff matching the query, or a new ChildStaff object populated from the query conditions when no match is found
 *
 * @method     ChildStaff findOneByEntityId(int $entity_id) Return the first ChildStaff filtered by the entity_id column
 * @method     ChildStaff findOneByName(string $name) Return the first ChildStaff filtered by the name column
 * @method     ChildStaff findOneByEmail(string $email) Return the first ChildStaff filtered by the email column
 * @method     ChildStaff findOneByPassword(string $password) Return the first ChildStaff filtered by the password column
 * @method     ChildStaff findOneByCreatedAt(string $created_at) Return the first ChildStaff filtered by the created_at column
 * @method     ChildStaff findOneByUpdatedAt(string $updated_at) Return the first ChildStaff filtered by the updated_at column
 * @method     ChildStaff findOneByArchivedAt(string $archived_at) Return the first ChildStaff filtered by the archived_at column *

 * @method     ChildStaff requirePk($key, ConnectionInterface $con = null) Return the ChildStaff by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaff requireOne(ConnectionInterface $con = null) Return the first ChildStaff matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStaff requireOneByEntityId(int $entity_id) Return the first ChildStaff filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaff requireOneByName(string $name) Return the first ChildStaff filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaff requireOneByEmail(string $email) Return the first ChildStaff filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaff requireOneByPassword(string $password) Return the first ChildStaff filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaff requireOneByCreatedAt(string $created_at) Return the first ChildStaff filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaff requireOneByUpdatedAt(string $updated_at) Return the first ChildStaff filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaff requireOneByArchivedAt(string $archived_at) Return the first ChildStaff filtered by the archived_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStaff[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStaff objects based on current ModelCriteria
 * @method     ChildStaff[]|ObjectCollection findByEntityId(int $entity_id) Return ChildStaff objects filtered by the entity_id column
 * @method     ChildStaff[]|ObjectCollection findByName(string $name) Return ChildStaff objects filtered by the name column
 * @method     ChildStaff[]|ObjectCollection findByEmail(string $email) Return ChildStaff objects filtered by the email column
 * @method     ChildStaff[]|ObjectCollection findByPassword(string $password) Return ChildStaff objects filtered by the password column
 * @method     ChildStaff[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildStaff objects filtered by the created_at column
 * @method     ChildStaff[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildStaff objects filtered by the updated_at column
 * @method     ChildStaff[]|ObjectCollection findByArchivedAt(string $archived_at) Return ChildStaff objects filtered by the archived_at column
 * @method     ChildStaff[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StaffQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\StaffQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\Staff', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStaffQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStaffQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStaffQuery) {
            return $criteria;
        }
        $query = new ChildStaffQuery();
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
     * @return ChildStaff|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StaffTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StaffTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStaff A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, name, email, password, created_at, updated_at, archived_at FROM staff WHERE entity_id = :p0';
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
            /** @var ChildStaff $obj */
            $obj = new ChildStaff();
            $obj->hydrate($row);
            StaffTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStaff|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StaffTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StaffTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(StaffTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(StaffTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StaffTableMap::COL_ENTITY_ID, $entityId, $comparison);
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
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StaffTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StaffTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StaffTableMap::COL_PASSWORD, $password, $comparison);
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
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(StaffTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(StaffTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StaffTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(StaffTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(StaffTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StaffTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function filterByArchivedAt($archivedAt = null, $comparison = null)
    {
        if (is_array($archivedAt)) {
            $useMinMax = false;
            if (isset($archivedAt['min'])) {
                $this->addUsingAlias(StaffTableMap::COL_ARCHIVED_AT, $archivedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($archivedAt['max'])) {
                $this->addUsingAlias(StaffTableMap::COL_ARCHIVED_AT, $archivedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StaffTableMap::COL_ARCHIVED_AT, $archivedAt, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\EnquiryComment object
     *
     * @param \Wedding\EnquiryComment|ObjectCollection $enquiryComment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStaffQuery The current query, for fluid interface
     */
    public function filterByEnquiryComment($enquiryComment, $comparison = null)
    {
        if ($enquiryComment instanceof \Wedding\EnquiryComment) {
            return $this
                ->addUsingAlias(StaffTableMap::COL_ENTITY_ID, $enquiryComment->getStaffId(), $comparison);
        } elseif ($enquiryComment instanceof ObjectCollection) {
            return $this
                ->useEnquiryCommentQuery()
                ->filterByPrimaryKeys($enquiryComment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEnquiryComment() only accepts arguments of type \Wedding\EnquiryComment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EnquiryComment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function joinEnquiryComment($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EnquiryComment');

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
            $this->addJoinObject($join, 'EnquiryComment');
        }

        return $this;
    }

    /**
     * Use the EnquiryComment relation EnquiryComment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Wedding\EnquiryCommentQuery A secondary query class using the current class as primary query
     */
    public function useEnquiryCommentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEnquiryComment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EnquiryComment', '\Wedding\EnquiryCommentQuery');
    }

    /**
     * Filter the query by a related \Wedding\Viewing object
     *
     * @param \Wedding\Viewing|ObjectCollection $viewing the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStaffQuery The current query, for fluid interface
     */
    public function filterByViewing($viewing, $comparison = null)
    {
        if ($viewing instanceof \Wedding\Viewing) {
            return $this
                ->addUsingAlias(StaffTableMap::COL_ENTITY_ID, $viewing->getAssignedTo(), $comparison);
        } elseif ($viewing instanceof ObjectCollection) {
            return $this
                ->useViewingQuery()
                ->filterByPrimaryKeys($viewing->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByViewing() only accepts arguments of type \Wedding\Viewing or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Viewing relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function joinViewing($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Viewing');

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
            $this->addJoinObject($join, 'Viewing');
        }

        return $this;
    }

    /**
     * Use the Viewing relation Viewing object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Wedding\ViewingQuery A secondary query class using the current class as primary query
     */
    public function useViewingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinViewing($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Viewing', '\Wedding\ViewingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildStaff $staff Object to remove from the list of results
     *
     * @return $this|ChildStaffQuery The current query, for fluid interface
     */
    public function prune($staff = null)
    {
        if ($staff) {
            $this->addUsingAlias(StaffTableMap::COL_ENTITY_ID, $staff->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the staff table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StaffTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StaffTableMap::clearInstancePool();
            StaffTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StaffTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StaffTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            StaffTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            StaffTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StaffQuery
