<?php

namespace Somecode\Framework\Console\Commands;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Somecode\Framework\Console\CommandInterface;

class MigrateCommand implements CommandInterface
{
    private string $name = 'migrate';

    private const MIGRATIONS_TABLE = 'migrations';

    public function __construct(
        private Connection $connection
    ) {}

    public function execute(array $parameters = []): int
    {
        // 1. Создать таблицу миграций (migrations), если таблица еще не существует
        $this->createMigrationsTable();

        // 2. Получить $appliedMigrations (миграции, которые уже есть в таблице migrations)
        // 3. Получить $migrationFiles из папки миграций
        // 4. Получить миграции для применения
        // 5. Создать SQL-запрос для миграций, которые еще не были выполнены
        // 6. Добавить миграцию в базу данных
        // 7. Выполнить SQL-запрос

        return 0;
    }

    private function createMigrationsTable(): void
    {
        $schemaManager = $this->connection->createSchemaManager();
        if (! $schemaManager->tablesExist(self::MIGRATIONS_TABLE)) {

            $schema = new Schema;
            $table = $schema->createTable(self::MIGRATIONS_TABLE);
            $table->addColumn('id', Types::INTEGER, [
                'unsigned' => true,
                'autoincrement' => true,
            ]);
            $table->addColumn('migration', Types::STRING);
            $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, [
                'default' => 'CURRENT_TIMESTAMP',
            ]);
            $table->setPrimaryKey(['id']);

            $sqlArray = $schema->toSql($this->connection->getDatabasePlatform());

            $this->connection->executeQuery($sqlArray[0]);

            echo 'Migrations table created!'.PHP_EOL;
        }
        echo 'Nothing to add. Migrations table already exist!'.PHP_EOL;
    }
}
