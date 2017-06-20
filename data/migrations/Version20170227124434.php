<?php

namespace TuningforkMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Populates role table
 */
class Version20170227124434 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO role (id, name, label) VALUES (1, 'guest', 'Invité');");
        $this->addSql("INSERT INTO role (id, name, label) VALUES (2, 'user', 'Utilisateur');");
        $this->addSql("INSERT INTO role (id, name, label, parent_id) VALUES (3, 'admin', 'Administrateur', 2);");
        $this->addSql("INSERT INTO role (id, name, label, parent_id) VALUES (4, 'membre', 'Membre', 2);");
        $this->addSql("INSERT INTO role (id, name, label, parent_id) VALUES (4, 'moderateur', 'Modérateur', 2);");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM role;");
    }
}
