<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211018195917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE customer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE invoice_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE invoice_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE customer (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE invoice (id INT NOT NULL, customer_id INT NOT NULL, number VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_906517449395C3F3 ON invoice (customer_id)');
        $this->addSql('CREATE TABLE invoice_item (id INT NOT NULL, product_id INT NOT NULL, invoice_id INT DEFAULT NULL, quantity INT NOT NULL, price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1DDE477B4584665A ON invoice_item (product_id)');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477B4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE invoice DROP CONSTRAINT FK_906517449395C3F3');
        $this->addSql('ALTER TABLE invoice_item DROP CONSTRAINT FK_1DDE477B2989F1FD');
        $this->addSql('DROP SEQUENCE customer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE invoice_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE invoice_item_id_seq CASCADE');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_item');
    }
}
