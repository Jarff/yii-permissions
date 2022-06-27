<?php

declare(strict_types=1);

// namespace Your\Namespace\Here;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220526163307 extends AbstractMigration
{
    public function getDescription()
    {
        return '';
    }

    public function up(Schema $schema)
    {
        $table = $schema->createTable('permissions');
        $table->addColumn('id', 'integer', array('autoincrement'=>true));
        $table->addColumn('name', 'string');
        $table->addColumn('guard_name', 'string', ['default' => 'web']);
        $table->addColumn('created_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP'
        ]);
        $table->addColumn('updated_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP'
        ]);

        $table->setPrimaryKey(['id'], 'PRIMARY');
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('permissions');
    }
}
