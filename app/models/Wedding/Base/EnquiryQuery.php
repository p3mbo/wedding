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
use Wedding\Enquiry as ChildEnquiry;
use Wedding\EnquiryQuery as ChildEnquiryQuery;
use Wedding\Map\EnquiryTableMap;

/**
 * Base class that represents a query for the 'enquiry' table.
 *
 * 
 *
 * @method     ChildEnquiryQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildEnquiryQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildEnquiryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildEnquiryQuery orderByPartnerName($order = Criteria::ASC) Order by the partner_name column
 * @method     ChildEnquiryQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildEnquiryQuery orderByTelephone($order = Criteria::ASC) Order by the telephone column
 * @method     ChildEnquiryQuery orderByMobile($order = Criteria::ASC) Order by the mobile column
 * @method     ChildEnquiryQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildEnquiryQuery orderByDayGuests($order = Criteria::ASC) Order by the day_guests column
 * @method     ChildEnquiryQuery orderByEveningGuests($order = Criteria::ASC) Order by the evening_guests column
 * @method     ChildEnquiryQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildEnquiryQuery orderByBudget($order = Criteria::ASC) Order by the budget column
 * @method     ChildEnquiryQuery orderByHeard($order = Criteria::ASC) Order by the heard column
 * @method     ChildEnquiryQuery orderByComment($order = Criteria::ASC) Order by the comment column
 * @method     ChildEnquiryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEnquiryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildEnquiryQuery orderByLostAt($order = Criteria::ASC) Order by the lost_at column
 * @method     ChildEnquiryQuery orderByPromotedAt($order = Criteria::ASC) Order by the promoted_at column
 * @method     ChildEnquiryQuery orderByContactedAt($order = Criteria::ASC) Order by the contacted_at column
 *
 * @method     ChildEnquiryQuery groupByEntityId() Group by the entity_id column
 * @method     ChildEnquiryQuery groupByTitle() Group by the title column
 * @method     ChildEnquiryQuery groupByName() Group by the name column
 * @method     ChildEnquiryQuery groupByPartnerName() Group by the partner_name column
 * @method     ChildEnquiryQuery groupByEmail() Group by the email column
 * @method     ChildEnquiryQuery groupByTelephone() Group by the telephone column
 * @method     ChildEnquiryQuery groupByMobile() Group by the mobile column
 * @method     ChildEnquiryQuery groupByAddress() Group by the address column
 * @method     ChildEnquiryQuery groupByDayGuests() Group by the day_guests column
 * @method     ChildEnquiryQuery groupByEveningGuests() Group by the evening_guests column
 * @method     ChildEnquiryQuery groupByYear() Group by the year column
 * @method     ChildEnquiryQuery groupByBudget() Group by the budget column
 * @method     ChildEnquiryQuery groupByHeard() Group by the heard column
 * @method     ChildEnquiryQuery groupByComment() Group by the comment column
 * @method     ChildEnquiryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEnquiryQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildEnquiryQuery groupByLostAt() Group by the lost_at column
 * @method     ChildEnquiryQuery groupByPromotedAt() Group by the promoted_at column
 * @method     ChildEnquiryQuery groupByContactedAt() Group by the contacted_at column
 *
 * @method     ChildEnquiryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEnquiryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEnquiryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEnquiryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEnquiryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEnquiryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEnquiryQuery leftJoinEnquiryComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the EnquiryComment relation
 * @method     ChildEnquiryQuery rightJoinEnquiryComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EnquiryComment relation
 * @method     ChildEnquiryQuery innerJoinEnquiryComment($relationAlias = null) Adds a INNER JOIN clause to the query using the EnquiryComment relation
 *
 * @method     ChildEnquiryQuery joinWithEnquiryComment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EnquiryComment relation
 *
 * @method     ChildEnquiryQuery leftJoinWithEnquiryComment() Adds a LEFT JOIN clause and with to the query using the EnquiryComment relation
 * @method     ChildEnquiryQuery rightJoinWithEnquiryComment() Adds a RIGHT JOIN clause and with to the query using the EnquiryComment relation
 * @method     ChildEnquiryQuery innerJoinWithEnquiryComment() Adds a INNER JOIN clause and with to the query using the EnquiryComment relation
 *
 * @method     ChildEnquiryQuery leftJoinViewing($relationAlias = null) Adds a LEFT JOIN clause to the query using the Viewing relation
 * @method     ChildEnquiryQuery rightJoinViewing($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Viewing relation
 * @method     ChildEnquiryQuery innerJoinViewing($relationAlias = null) Adds a INNER JOIN clause to the query using the Viewing relation
 *
 * @method     ChildEnquiryQuery joinWithViewing($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Viewing relation
 *
 * @method     ChildEnquiryQuery leftJoinWithViewing() Adds a LEFT JOIN clause and with to the query using the Viewing relation
 * @method     ChildEnquiryQuery rightJoinWithViewing() Adds a RIGHT JOIN clause and with to the query using the Viewing relation
 * @method     ChildEnquiryQuery innerJoinWithViewing() Adds a INNER JOIN clause and with to the query using the Viewing relation
 *
 * @method     \Wedding\EnquiryCommentQuery|\Wedding\ViewingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEnquiry findOne(ConnectionInterface $con = null) Return the first ChildEnquiry matching the query
 * @method     ChildEnquiry findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEnquiry matching the query, or a new ChildEnquiry object populated from the query conditions when no match is found
 *
 * @method     ChildEnquiry findOneByEntityId(int $entity_id) Return the first ChildEnquiry filtered by the entity_id column
 * @method     ChildEnquiry findOneByTitle(string $title) Return the first ChildEnquiry filtered by the title column
 * @method     ChildEnquiry findOneByName(string $name) Return the first ChildEnquiry filtered by the name column
 * @method     ChildEnquiry findOneByPartnerName(string $partner_name) Return the first ChildEnquiry filtered by the partner_name column
 * @method     ChildEnquiry findOneByEmail(string $email) Return the first ChildEnquiry filtered by the email column
 * @method     ChildEnquiry findOneByTelephone(string $telephone) Return the first ChildEnquiry filtered by the telephone column
 * @method     ChildEnquiry findOneByMobile(string $mobile) Return the first ChildEnquiry filtered by the mobile column
 * @method     ChildEnquiry findOneByAddress(string $address) Return the first ChildEnquiry filtered by the address column
 * @method     ChildEnquiry findOneByDayGuests(int $day_guests) Return the first ChildEnquiry filtered by the day_guests column
 * @method     ChildEnquiry findOneByEveningGuests(int $evening_guests) Return the first ChildEnquiry filtered by the evening_guests column
 * @method     ChildEnquiry findOneByYear(string $year) Return the first ChildEnquiry filtered by the year column
 * @method     ChildEnquiry findOneByBudget(string $budget) Return the first ChildEnquiry filtered by the budget column
 * @method     ChildEnquiry findOneByHeard(string $heard) Return the first ChildEnquiry filtered by the heard column
 * @method     ChildEnquiry findOneByComment(string $comment) Return the first ChildEnquiry filtered by the comment column
 * @method     ChildEnquiry findOneByCreatedAt(string $created_at) Return the first ChildEnquiry filtered by the created_at column
 * @method     ChildEnquiry findOneByUpdatedAt(string $updated_at) Return the first ChildEnquiry filtered by the updated_at column
 * @method     ChildEnquiry findOneByLostAt(string $lost_at) Return the first ChildEnquiry filtered by the lost_at column
 * @method     ChildEnquiry findOneByPromotedAt(string $promoted_at) Return the first ChildEnquiry filtered by the promoted_at column
 * @method     ChildEnquiry findOneByContactedAt(string $contacted_at) Return the first ChildEnquiry filtered by the contacted_at column *

 * @method     ChildEnquiry requirePk($key, ConnectionInterface $con = null) Return the ChildEnquiry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOne(ConnectionInterface $con = null) Return the first ChildEnquiry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEnquiry requireOneByEntityId(int $entity_id) Return the first ChildEnquiry filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByTitle(string $title) Return the first ChildEnquiry filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByName(string $name) Return the first ChildEnquiry filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByPartnerName(string $partner_name) Return the first ChildEnquiry filtered by the partner_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByEmail(string $email) Return the first ChildEnquiry filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByTelephone(string $telephone) Return the first ChildEnquiry filtered by the telephone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByMobile(string $mobile) Return the first ChildEnquiry filtered by the mobile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByAddress(string $address) Return the first ChildEnquiry filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByDayGuests(int $day_guests) Return the first ChildEnquiry filtered by the day_guests column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByEveningGuests(int $evening_guests) Return the first ChildEnquiry filtered by the evening_guests column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByYear(string $year) Return the first ChildEnquiry filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByBudget(string $budget) Return the first ChildEnquiry filtered by the budget column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByHeard(string $heard) Return the first ChildEnquiry filtered by the heard column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByComment(string $comment) Return the first ChildEnquiry filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByCreatedAt(string $created_at) Return the first ChildEnquiry filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByUpdatedAt(string $updated_at) Return the first ChildEnquiry filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByLostAt(string $lost_at) Return the first ChildEnquiry filtered by the lost_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByPromotedAt(string $promoted_at) Return the first ChildEnquiry filtered by the promoted_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEnquiry requireOneByContactedAt(string $contacted_at) Return the first ChildEnquiry filtered by the contacted_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEnquiry[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEnquiry objects based on current ModelCriteria
 * @method     ChildEnquiry[]|ObjectCollection findByEntityId(int $entity_id) Return ChildEnquiry objects filtered by the entity_id column
 * @method     ChildEnquiry[]|ObjectCollection findByTitle(string $title) Return ChildEnquiry objects filtered by the title column
 * @method     ChildEnquiry[]|ObjectCollection findByName(string $name) Return ChildEnquiry objects filtered by the name column
 * @method     ChildEnquiry[]|ObjectCollection findByPartnerName(string $partner_name) Return ChildEnquiry objects filtered by the partner_name column
 * @method     ChildEnquiry[]|ObjectCollection findByEmail(string $email) Return ChildEnquiry objects filtered by the email column
 * @method     ChildEnquiry[]|ObjectCollection findByTelephone(string $telephone) Return ChildEnquiry objects filtered by the telephone column
 * @method     ChildEnquiry[]|ObjectCollection findByMobile(string $mobile) Return ChildEnquiry objects filtered by the mobile column
 * @method     ChildEnquiry[]|ObjectCollection findByAddress(string $address) Return ChildEnquiry objects filtered by the address column
 * @method     ChildEnquiry[]|ObjectCollection findByDayGuests(int $day_guests) Return ChildEnquiry objects filtered by the day_guests column
 * @method     ChildEnquiry[]|ObjectCollection findByEveningGuests(int $evening_guests) Return ChildEnquiry objects filtered by the evening_guests column
 * @method     ChildEnquiry[]|ObjectCollection findByYear(string $year) Return ChildEnquiry objects filtered by the year column
 * @method     ChildEnquiry[]|ObjectCollection findByBudget(string $budget) Return ChildEnquiry objects filtered by the budget column
 * @method     ChildEnquiry[]|ObjectCollection findByHeard(string $heard) Return ChildEnquiry objects filtered by the heard column
 * @method     ChildEnquiry[]|ObjectCollection findByComment(string $comment) Return ChildEnquiry objects filtered by the comment column
 * @method     ChildEnquiry[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildEnquiry objects filtered by the created_at column
 * @method     ChildEnquiry[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildEnquiry objects filtered by the updated_at column
 * @method     ChildEnquiry[]|ObjectCollection findByLostAt(string $lost_at) Return ChildEnquiry objects filtered by the lost_at column
 * @method     ChildEnquiry[]|ObjectCollection findByPromotedAt(string $promoted_at) Return ChildEnquiry objects filtered by the promoted_at column
 * @method     ChildEnquiry[]|ObjectCollection findByContactedAt(string $contacted_at) Return ChildEnquiry objects filtered by the contacted_at column
 * @method     ChildEnquiry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EnquiryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\EnquiryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\Enquiry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEnquiryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEnquiryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEnquiryQuery) {
            return $criteria;
        }
        $query = new ChildEnquiryQuery();
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
     * @return ChildEnquiry|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EnquiryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EnquiryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEnquiry A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, title, name, partner_name, email, telephone, mobile, address, day_guests, evening_guests, year, budget, heard, comment, created_at, updated_at, lost_at, promoted_at, contacted_at FROM enquiry WHERE entity_id = :p0';
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
            /** @var ChildEnquiry $obj */
            $obj = new ChildEnquiry();
            $obj->hydrate($row);
            EnquiryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEnquiry|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EnquiryTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EnquiryTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_ENTITY_ID, $entityId, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the partner_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPartnerName('fooValue');   // WHERE partner_name = 'fooValue'
     * $query->filterByPartnerName('%fooValue%', Criteria::LIKE); // WHERE partner_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $partnerName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByPartnerName($partnerName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($partnerName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_PARTNER_NAME, $partnerName, $comparison);
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
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the telephone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone('fooValue');   // WHERE telephone = 'fooValue'
     * $query->filterByTelephone('%fooValue%', Criteria::LIKE); // WHERE telephone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByTelephone($telephone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_TELEPHONE, $telephone, $comparison);
    }

    /**
     * Filter the query on the mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByMobile('fooValue');   // WHERE mobile = 'fooValue'
     * $query->filterByMobile('%fooValue%', Criteria::LIKE); // WHERE mobile LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mobile The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByMobile($mobile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mobile)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_MOBILE, $mobile, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the day_guests column
     *
     * Example usage:
     * <code>
     * $query->filterByDayGuests(1234); // WHERE day_guests = 1234
     * $query->filterByDayGuests(array(12, 34)); // WHERE day_guests IN (12, 34)
     * $query->filterByDayGuests(array('min' => 12)); // WHERE day_guests > 12
     * </code>
     *
     * @param     mixed $dayGuests The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByDayGuests($dayGuests = null, $comparison = null)
    {
        if (is_array($dayGuests)) {
            $useMinMax = false;
            if (isset($dayGuests['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_DAY_GUESTS, $dayGuests['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dayGuests['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_DAY_GUESTS, $dayGuests['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_DAY_GUESTS, $dayGuests, $comparison);
    }

    /**
     * Filter the query on the evening_guests column
     *
     * Example usage:
     * <code>
     * $query->filterByEveningGuests(1234); // WHERE evening_guests = 1234
     * $query->filterByEveningGuests(array(12, 34)); // WHERE evening_guests IN (12, 34)
     * $query->filterByEveningGuests(array('min' => 12)); // WHERE evening_guests > 12
     * </code>
     *
     * @param     mixed $eveningGuests The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByEveningGuests($eveningGuests = null, $comparison = null)
    {
        if (is_array($eveningGuests)) {
            $useMinMax = false;
            if (isset($eveningGuests['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_EVENING_GUESTS, $eveningGuests['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eveningGuests['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_EVENING_GUESTS, $eveningGuests['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_EVENING_GUESTS, $eveningGuests, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear('fooValue');   // WHERE year = 'fooValue'
     * $query->filterByYear('%fooValue%', Criteria::LIKE); // WHERE year LIKE '%fooValue%'
     * </code>
     *
     * @param     string $year The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($year)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_YEAR, $year, $comparison);
    }

    /**
     * Filter the query on the budget column
     *
     * Example usage:
     * <code>
     * $query->filterByBudget(1234); // WHERE budget = 1234
     * $query->filterByBudget(array(12, 34)); // WHERE budget IN (12, 34)
     * $query->filterByBudget(array('min' => 12)); // WHERE budget > 12
     * </code>
     *
     * @param     mixed $budget The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByBudget($budget = null, $comparison = null)
    {
        if (is_array($budget)) {
            $useMinMax = false;
            if (isset($budget['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_BUDGET, $budget['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($budget['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_BUDGET, $budget['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_BUDGET, $budget, $comparison);
    }

    /**
     * Filter the query on the heard column
     *
     * Example usage:
     * <code>
     * $query->filterByHeard('fooValue');   // WHERE heard = 'fooValue'
     * $query->filterByHeard('%fooValue%', Criteria::LIKE); // WHERE heard LIKE '%fooValue%'
     * </code>
     *
     * @param     string $heard The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByHeard($heard = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($heard)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_HEARD, $heard, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_COMMENT, $comment, $comparison);
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
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the lost_at column
     *
     * Example usage:
     * <code>
     * $query->filterByLostAt('2011-03-14'); // WHERE lost_at = '2011-03-14'
     * $query->filterByLostAt('now'); // WHERE lost_at = '2011-03-14'
     * $query->filterByLostAt(array('max' => 'yesterday')); // WHERE lost_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $lostAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByLostAt($lostAt = null, $comparison = null)
    {
        if (is_array($lostAt)) {
            $useMinMax = false;
            if (isset($lostAt['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_LOST_AT, $lostAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lostAt['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_LOST_AT, $lostAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_LOST_AT, $lostAt, $comparison);
    }

    /**
     * Filter the query on the promoted_at column
     *
     * Example usage:
     * <code>
     * $query->filterByPromotedAt('2011-03-14'); // WHERE promoted_at = '2011-03-14'
     * $query->filterByPromotedAt('now'); // WHERE promoted_at = '2011-03-14'
     * $query->filterByPromotedAt(array('max' => 'yesterday')); // WHERE promoted_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $promotedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByPromotedAt($promotedAt = null, $comparison = null)
    {
        if (is_array($promotedAt)) {
            $useMinMax = false;
            if (isset($promotedAt['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_PROMOTED_AT, $promotedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promotedAt['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_PROMOTED_AT, $promotedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_PROMOTED_AT, $promotedAt, $comparison);
    }

    /**
     * Filter the query on the contacted_at column
     *
     * Example usage:
     * <code>
     * $query->filterByContactedAt('2011-03-14'); // WHERE contacted_at = '2011-03-14'
     * $query->filterByContactedAt('now'); // WHERE contacted_at = '2011-03-14'
     * $query->filterByContactedAt(array('max' => 'yesterday')); // WHERE contacted_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $contactedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByContactedAt($contactedAt = null, $comparison = null)
    {
        if (is_array($contactedAt)) {
            $useMinMax = false;
            if (isset($contactedAt['min'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_CONTACTED_AT, $contactedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contactedAt['max'])) {
                $this->addUsingAlias(EnquiryTableMap::COL_CONTACTED_AT, $contactedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EnquiryTableMap::COL_CONTACTED_AT, $contactedAt, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\EnquiryComment object
     *
     * @param \Wedding\EnquiryComment|ObjectCollection $enquiryComment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByEnquiryComment($enquiryComment, $comparison = null)
    {
        if ($enquiryComment instanceof \Wedding\EnquiryComment) {
            return $this
                ->addUsingAlias(EnquiryTableMap::COL_ENTITY_ID, $enquiryComment->getEnquiryId(), $comparison);
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
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
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
     * @return ChildEnquiryQuery The current query, for fluid interface
     */
    public function filterByViewing($viewing, $comparison = null)
    {
        if ($viewing instanceof \Wedding\Viewing) {
            return $this
                ->addUsingAlias(EnquiryTableMap::COL_ENTITY_ID, $viewing->getEnquiryId(), $comparison);
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
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
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
     * @param   ChildEnquiry $enquiry Object to remove from the list of results
     *
     * @return $this|ChildEnquiryQuery The current query, for fluid interface
     */
    public function prune($enquiry = null)
    {
        if ($enquiry) {
            $this->addUsingAlias(EnquiryTableMap::COL_ENTITY_ID, $enquiry->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the enquiry table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EnquiryTableMap::clearInstancePool();
            EnquiryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EnquiryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EnquiryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            EnquiryTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            EnquiryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EnquiryQuery
