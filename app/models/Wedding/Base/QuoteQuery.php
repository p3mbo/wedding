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
use Wedding\Quote as ChildQuote;
use Wedding\QuoteQuery as ChildQuoteQuery;
use Wedding\Map\QuoteTableMap;

/**
 * Base class that represents a query for the 'quote' table.
 *
 * 
 *
 * @method     ChildQuoteQuery orderByEntityId($order = Criteria::ASC) Order by the entity_id column
 * @method     ChildQuoteQuery orderByEnquiryId($order = Criteria::ASC) Order by the enquiry_id column
 * @method     ChildQuoteQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildQuoteQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildQuoteQuery orderByDay($order = Criteria::ASC) Order by the day column
 * @method     ChildQuoteQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildQuoteQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildQuoteQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildQuoteQuery orderByExclusive($order = Criteria::ASC) Order by the exclusive column
 * @method     ChildQuoteQuery orderBySpecificDate($order = Criteria::ASC) Order by the specific_date column
 * @method     ChildQuoteQuery orderByDayGuests($order = Criteria::ASC) Order by the day_guests column
 * @method     ChildQuoteQuery orderByEveGuests($order = Criteria::ASC) Order by the eve_guests column
 * @method     ChildQuoteQuery orderByCeremonyTypeId($order = Criteria::ASC) Order by the ceremony_type_id column
 *
 * @method     ChildQuoteQuery groupByEntityId() Group by the entity_id column
 * @method     ChildQuoteQuery groupByEnquiryId() Group by the enquiry_id column
 * @method     ChildQuoteQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildQuoteQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildQuoteQuery groupByDay() Group by the day column
 * @method     ChildQuoteQuery groupByMonth() Group by the month column
 * @method     ChildQuoteQuery groupByYear() Group by the year column
 * @method     ChildQuoteQuery groupByNotes() Group by the notes column
 * @method     ChildQuoteQuery groupByExclusive() Group by the exclusive column
 * @method     ChildQuoteQuery groupBySpecificDate() Group by the specific_date column
 * @method     ChildQuoteQuery groupByDayGuests() Group by the day_guests column
 * @method     ChildQuoteQuery groupByEveGuests() Group by the eve_guests column
 * @method     ChildQuoteQuery groupByCeremonyTypeId() Group by the ceremony_type_id column
 *
 * @method     ChildQuoteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildQuoteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildQuoteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildQuoteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildQuoteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildQuoteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildQuoteQuery leftJoinEnquiry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Enquiry relation
 * @method     ChildQuoteQuery rightJoinEnquiry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Enquiry relation
 * @method     ChildQuoteQuery innerJoinEnquiry($relationAlias = null) Adds a INNER JOIN clause to the query using the Enquiry relation
 *
 * @method     ChildQuoteQuery joinWithEnquiry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Enquiry relation
 *
 * @method     ChildQuoteQuery leftJoinWithEnquiry() Adds a LEFT JOIN clause and with to the query using the Enquiry relation
 * @method     ChildQuoteQuery rightJoinWithEnquiry() Adds a RIGHT JOIN clause and with to the query using the Enquiry relation
 * @method     ChildQuoteQuery innerJoinWithEnquiry() Adds a INNER JOIN clause and with to the query using the Enquiry relation
 *
 * @method     \Wedding\EnquiryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildQuote findOne(ConnectionInterface $con = null) Return the first ChildQuote matching the query
 * @method     ChildQuote findOneOrCreate(ConnectionInterface $con = null) Return the first ChildQuote matching the query, or a new ChildQuote object populated from the query conditions when no match is found
 *
 * @method     ChildQuote findOneByEntityId(int $entity_id) Return the first ChildQuote filtered by the entity_id column
 * @method     ChildQuote findOneByEnquiryId(int $enquiry_id) Return the first ChildQuote filtered by the enquiry_id column
 * @method     ChildQuote findOneByCreatedAt(string $created_at) Return the first ChildQuote filtered by the created_at column
 * @method     ChildQuote findOneByUpdatedAt(string $updated_at) Return the first ChildQuote filtered by the updated_at column
 * @method     ChildQuote findOneByDay(string $day) Return the first ChildQuote filtered by the day column
 * @method     ChildQuote findOneByMonth(string $month) Return the first ChildQuote filtered by the month column
 * @method     ChildQuote findOneByYear(string $year) Return the first ChildQuote filtered by the year column
 * @method     ChildQuote findOneByNotes(string $notes) Return the first ChildQuote filtered by the notes column
 * @method     ChildQuote findOneByExclusive(string $exclusive) Return the first ChildQuote filtered by the exclusive column
 * @method     ChildQuote findOneBySpecificDate(string $specific_date) Return the first ChildQuote filtered by the specific_date column
 * @method     ChildQuote findOneByDayGuests(string $day_guests) Return the first ChildQuote filtered by the day_guests column
 * @method     ChildQuote findOneByEveGuests(string $eve_guests) Return the first ChildQuote filtered by the eve_guests column
 * @method     ChildQuote findOneByCeremonyTypeId(int $ceremony_type_id) Return the first ChildQuote filtered by the ceremony_type_id column *

 * @method     ChildQuote requirePk($key, ConnectionInterface $con = null) Return the ChildQuote by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOne(ConnectionInterface $con = null) Return the first ChildQuote matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuote requireOneByEntityId(int $entity_id) Return the first ChildQuote filtered by the entity_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByEnquiryId(int $enquiry_id) Return the first ChildQuote filtered by the enquiry_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByCreatedAt(string $created_at) Return the first ChildQuote filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByUpdatedAt(string $updated_at) Return the first ChildQuote filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByDay(string $day) Return the first ChildQuote filtered by the day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByMonth(string $month) Return the first ChildQuote filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByYear(string $year) Return the first ChildQuote filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByNotes(string $notes) Return the first ChildQuote filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByExclusive(string $exclusive) Return the first ChildQuote filtered by the exclusive column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneBySpecificDate(string $specific_date) Return the first ChildQuote filtered by the specific_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByDayGuests(string $day_guests) Return the first ChildQuote filtered by the day_guests column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByEveGuests(string $eve_guests) Return the first ChildQuote filtered by the eve_guests column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuote requireOneByCeremonyTypeId(int $ceremony_type_id) Return the first ChildQuote filtered by the ceremony_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuote[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildQuote objects based on current ModelCriteria
 * @method     ChildQuote[]|ObjectCollection findByEntityId(int $entity_id) Return ChildQuote objects filtered by the entity_id column
 * @method     ChildQuote[]|ObjectCollection findByEnquiryId(int $enquiry_id) Return ChildQuote objects filtered by the enquiry_id column
 * @method     ChildQuote[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildQuote objects filtered by the created_at column
 * @method     ChildQuote[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildQuote objects filtered by the updated_at column
 * @method     ChildQuote[]|ObjectCollection findByDay(string $day) Return ChildQuote objects filtered by the day column
 * @method     ChildQuote[]|ObjectCollection findByMonth(string $month) Return ChildQuote objects filtered by the month column
 * @method     ChildQuote[]|ObjectCollection findByYear(string $year) Return ChildQuote objects filtered by the year column
 * @method     ChildQuote[]|ObjectCollection findByNotes(string $notes) Return ChildQuote objects filtered by the notes column
 * @method     ChildQuote[]|ObjectCollection findByExclusive(string $exclusive) Return ChildQuote objects filtered by the exclusive column
 * @method     ChildQuote[]|ObjectCollection findBySpecificDate(string $specific_date) Return ChildQuote objects filtered by the specific_date column
 * @method     ChildQuote[]|ObjectCollection findByDayGuests(string $day_guests) Return ChildQuote objects filtered by the day_guests column
 * @method     ChildQuote[]|ObjectCollection findByEveGuests(string $eve_guests) Return ChildQuote objects filtered by the eve_guests column
 * @method     ChildQuote[]|ObjectCollection findByCeremonyTypeId(int $ceremony_type_id) Return ChildQuote objects filtered by the ceremony_type_id column
 * @method     ChildQuote[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class QuoteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Wedding\Base\QuoteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Wedding\\Quote', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildQuoteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildQuoteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildQuoteQuery) {
            return $criteria;
        }
        $query = new ChildQuoteQuery();
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
     * @return ChildQuote|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(QuoteTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = QuoteTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildQuote A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entity_id, enquiry_id, created_at, updated_at, day, month, year, notes, exclusive, specific_date, day_guests, eve_guests, ceremony_type_id FROM quote WHERE entity_id = :p0';
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
            /** @var ChildQuote $obj */
            $obj = new ChildQuote();
            $obj->hydrate($row);
            QuoteTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildQuote|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(QuoteTableMap::COL_ENTITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(QuoteTableMap::COL_ENTITY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByEntityId($entityId = null, $comparison = null)
    {
        if (is_array($entityId)) {
            $useMinMax = false;
            if (isset($entityId['min'])) {
                $this->addUsingAlias(QuoteTableMap::COL_ENTITY_ID, $entityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityId['max'])) {
                $this->addUsingAlias(QuoteTableMap::COL_ENTITY_ID, $entityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_ENTITY_ID, $entityId, $comparison);
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
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByEnquiryId($enquiryId = null, $comparison = null)
    {
        if (is_array($enquiryId)) {
            $useMinMax = false;
            if (isset($enquiryId['min'])) {
                $this->addUsingAlias(QuoteTableMap::COL_ENQUIRY_ID, $enquiryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enquiryId['max'])) {
                $this->addUsingAlias(QuoteTableMap::COL_ENQUIRY_ID, $enquiryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_ENQUIRY_ID, $enquiryId, $comparison);
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
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(QuoteTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(QuoteTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(QuoteTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(QuoteTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the day column
     *
     * Example usage:
     * <code>
     * $query->filterByDay('fooValue');   // WHERE day = 'fooValue'
     * $query->filterByDay('%fooValue%', Criteria::LIKE); // WHERE day LIKE '%fooValue%'
     * </code>
     *
     * @param     string $day The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByDay($day = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($day)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_DAY, $day, $comparison);
    }

    /**
     * Filter the query on the month column
     *
     * Example usage:
     * <code>
     * $query->filterByMonth('fooValue');   // WHERE month = 'fooValue'
     * $query->filterByMonth('%fooValue%', Criteria::LIKE); // WHERE month LIKE '%fooValue%'
     * </code>
     *
     * @param     string $month The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByMonth($month = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($month)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_MONTH, $month, $comparison);
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
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($year)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_YEAR, $year, $comparison);
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
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_NOTES, $notes, $comparison);
    }

    /**
     * Filter the query on the exclusive column
     *
     * Example usage:
     * <code>
     * $query->filterByExclusive('fooValue');   // WHERE exclusive = 'fooValue'
     * $query->filterByExclusive('%fooValue%', Criteria::LIKE); // WHERE exclusive LIKE '%fooValue%'
     * </code>
     *
     * @param     string $exclusive The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByExclusive($exclusive = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($exclusive)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_EXCLUSIVE, $exclusive, $comparison);
    }

    /**
     * Filter the query on the specific_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySpecificDate('fooValue');   // WHERE specific_date = 'fooValue'
     * $query->filterBySpecificDate('%fooValue%', Criteria::LIKE); // WHERE specific_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $specificDate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterBySpecificDate($specificDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($specificDate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_SPECIFIC_DATE, $specificDate, $comparison);
    }

    /**
     * Filter the query on the day_guests column
     *
     * Example usage:
     * <code>
     * $query->filterByDayGuests('fooValue');   // WHERE day_guests = 'fooValue'
     * $query->filterByDayGuests('%fooValue%', Criteria::LIKE); // WHERE day_guests LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dayGuests The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByDayGuests($dayGuests = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dayGuests)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_DAY_GUESTS, $dayGuests, $comparison);
    }

    /**
     * Filter the query on the eve_guests column
     *
     * Example usage:
     * <code>
     * $query->filterByEveGuests('fooValue');   // WHERE eve_guests = 'fooValue'
     * $query->filterByEveGuests('%fooValue%', Criteria::LIKE); // WHERE eve_guests LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eveGuests The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByEveGuests($eveGuests = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eveGuests)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_EVE_GUESTS, $eveGuests, $comparison);
    }

    /**
     * Filter the query on the ceremony_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCeremonyTypeId(1234); // WHERE ceremony_type_id = 1234
     * $query->filterByCeremonyTypeId(array(12, 34)); // WHERE ceremony_type_id IN (12, 34)
     * $query->filterByCeremonyTypeId(array('min' => 12)); // WHERE ceremony_type_id > 12
     * </code>
     *
     * @param     mixed $ceremonyTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByCeremonyTypeId($ceremonyTypeId = null, $comparison = null)
    {
        if (is_array($ceremonyTypeId)) {
            $useMinMax = false;
            if (isset($ceremonyTypeId['min'])) {
                $this->addUsingAlias(QuoteTableMap::COL_CEREMONY_TYPE_ID, $ceremonyTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ceremonyTypeId['max'])) {
                $this->addUsingAlias(QuoteTableMap::COL_CEREMONY_TYPE_ID, $ceremonyTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuoteTableMap::COL_CEREMONY_TYPE_ID, $ceremonyTypeId, $comparison);
    }

    /**
     * Filter the query by a related \Wedding\Enquiry object
     *
     * @param \Wedding\Enquiry|ObjectCollection $enquiry The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuoteQuery The current query, for fluid interface
     */
    public function filterByEnquiry($enquiry, $comparison = null)
    {
        if ($enquiry instanceof \Wedding\Enquiry) {
            return $this
                ->addUsingAlias(QuoteTableMap::COL_ENQUIRY_ID, $enquiry->getEntityId(), $comparison);
        } elseif ($enquiry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(QuoteTableMap::COL_ENQUIRY_ID, $enquiry->toKeyValue('PrimaryKey', 'EntityId'), $comparison);
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
     * @return $this|ChildQuoteQuery The current query, for fluid interface
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
     * @param   ChildQuote $quote Object to remove from the list of results
     *
     * @return $this|ChildQuoteQuery The current query, for fluid interface
     */
    public function prune($quote = null)
    {
        if ($quote) {
            $this->addUsingAlias(QuoteTableMap::COL_ENTITY_ID, $quote->getEntityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the quote table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            QuoteTableMap::clearInstancePool();
            QuoteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(QuoteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(QuoteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            QuoteTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            QuoteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // QuoteQuery
