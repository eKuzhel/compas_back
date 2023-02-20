<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\AbstractRepository;
use App\Models\User;
use Illuminate\Database\Connection;

/**
 * Class UserRepository
 * @package App\Repositories
 *
 * @extends AbstractRepository<User>
 */
final class UserRepository extends AbstractRepository
{
    public function __construct(Connection $connection)
    {
        parent::__construct($connection, User::class);
    }
}
