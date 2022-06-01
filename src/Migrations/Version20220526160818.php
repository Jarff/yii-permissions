<?php

declare(strict_types=1);

// namespace Your\Namespace\Here;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220526160818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('roles');
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

    public function down(Schema $schema) : void
    {
        $schema->dropTable('roles');
    }
}
