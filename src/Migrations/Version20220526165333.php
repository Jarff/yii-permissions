<?php

declare(strict_types=1);

// namespace Your\Namespace\Here;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220526165333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable('role_has_permissions');
        $table->addColumn('role_id', 'integer');
        $table->addColumn('permission_id', 'integer');
        
        $table->addForeignKeyConstraint('roles', ['role_id'], ['id'], ['onDelete' => 'CASCADE'], 'role_has_permissions_role_id_foreign');
        $table->addForeignKeyConstraint('permissions', ['permission_id'], ['id'], ['onDelete' => 'CASCADE'], 'role_has_permissions_permission_id_foreign');
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable('roles');
    }
}
