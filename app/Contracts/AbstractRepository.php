<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class AbstractRepository
 * @package App\Contracts
 *
 * @template T
 */
abstract class AbstractRepository
{
    /**
     * @var class-string<T>
     */
    private string $modelClass;

    /**
     * @var \Illuminate\Database\Connection
     */
    private Connection $connection;

    /**
     * AbstractRepository constructor.
     * @param \Illuminate\Database\Connection $connection
     * @param class-string<T> $modelClass
     */
    public function __construct(Connection $connection, string $modelClass)
    {
        if (!\class_exists($modelClass)) {
            throw new \InvalidArgumentException(
                \sprintf('Argument $modelClass "%s" is not valid classname.', $modelClass)
            );
        }

        if (false === \is_subclass_of($modelClass, Model::class)) {
            throw new \InvalidArgumentException(
                \sprintf(
                    'Argument $modelClass "%s" must be extended from "%s" class',
                    $modelClass,
                    Model::class
                )
            );
        }

        $this->modelClass = $modelClass;
        $this->connection = $connection;
    }

    /**
     * @return T|Model
     */
    public function createModel(): Model
    {
        return new $this->modelClass;
    }

    /**
     * @param array $condition
     * @param string|null $orderAttribute
     * @param string $orderDirection
     * @param int $limit
     * @param int $offset
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findBy(
        array $condition,
        string $orderAttribute = null,
        string $orderDirection = 'asc',
        int $limit = -1,
        int $offset = 0,
        array $with = []
    ): Collection {
        $query = $this->createQuery();

        $query->where($condition);

        if (null !== $orderAttribute) {
            $query->orderBy($orderAttribute, $orderDirection);
        }

        if (false === empty($with)) {
            $query->with($with);
        }

        $query->limit($limit);
        $query->offset($offset);

        return $query->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function createQuery(): Builder
    {
        return \call_user_func([$this->modelClass, 'query']);
    }

    /**
     * @param array $condition
     * @param string|null $orderAttribute
     * @param string $orderDirection
     * @param int $perPage
     * @param array $with
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(
        array $condition,
        string $orderAttribute = null,
        string $orderDirection = 'asc',
        int $perPage = 20,
        array $with = []
    ): LengthAwarePaginator {
        $query = $this->createQuery();

        $query->where($condition);

        if (null !== $orderAttribute) {
            $query->orderBy($orderAttribute, $orderDirection);
        }

        if (false === empty($with)) {
            $query->with($with);
        }

        return $query->paginate($perPage);
    }

    /**
     * @param array $condition
     * @param string|null $orderAttribute
     * @param string $orderDirection
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Model|T|null
     */
    public function findOneBy(
        array $condition,
        string $orderAttribute = null,
        string $orderDirection = 'asc',
        array $with = []
    ): ?Model {
        $query = $this->createQuery();

        $query->where($condition);

        if (null !== $orderAttribute) {
            $query->orderBy($orderAttribute, $orderDirection);
        }

        if (false === empty($with)) {
            $query->with($with);
        }

        return $query->first();
    }

    /**
     * @param array $condition
     *
     * @return bool
     */
    public function exists(array $condition): bool
    {
        $query = $this->createQuery();

        $query->where($condition);

        return $query->exists();
    }

    /**
     * @param array $condition
     *
     * @return int
     */
    public function count(array $condition): int
    {
        $query = $this->createQuery();

        $query->where($condition);

        return $query->count();
    }

    /**
     * @param array $condition
     * @param string $column
     *
     * @return mixed
     */
    public function max(array $condition, string $column)
    {
        $query = $this->createQuery();

        $query->where($condition);

        return $query->max($column);
    }

    /**
     * @param array $condition
     * @param string $column
     *
     * @return mixed
     */
    public function min(array $condition, string $column)
    {
        $query = $this->createQuery();

        $query->where($condition);

        return $query->min($column);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     *
     * @throws \Throwable
     */
    public function save(Model $model): bool
    {
        return $model->saveOrFail();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }

    /**
     * @param callable $callable
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function transaction(callable $callable)
    {
        return $this->connection->transaction($callable);
    }
}
