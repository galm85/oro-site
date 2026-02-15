<?php

namespace Gwd\Bundle\ResellerBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;


class GwdResellerBundleInstaller implements Installation
{

    /**
     * @inheritDoc
     */
    public function getMigrationVersion(): string
    {
        return 'v1_0';
    }


    public function up(Schema $schema, QueryBag $queries): void
    {
        $this->createGwdResellerTable($schema);
    }

    protected function createGwdResellerTable(Schema $schema): void
    {
        $table = $schema->createTable('gwd_reseller');

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('address', 'text', ['notnull' => false]);
        $table->addColumn('phone', 'string', ['length' => 50, 'notnull' => false]);
        $table->addColumn('email', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('website', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('description', 'text', ['notnull' => false]);
        $table->addColumn('authorized', 'boolean', ['default' => false]);
        $table->addColumn('status', 'string', ['length' => 20, 'default' => 'active']);
        $table->addColumn('logo_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');

        $table->setPrimaryKey(['id']);

        $table->addIndex(['logo_id'], 'idx_reseller_logo_id');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_attachment_file'),
            ['logo_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );
    }
}