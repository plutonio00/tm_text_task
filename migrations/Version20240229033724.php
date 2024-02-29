<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229033724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, quiz_id INT NOT NULL, question_id INT NOT NULL, is_right BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A25853CD175 ON answer (quiz_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE answer_answer_variant (answer_id INT NOT NULL, answer_variant_id INT NOT NULL, PRIMARY KEY(answer_id, answer_variant_id))');
        $this->addSql('CREATE INDEX IDX_15F12FB9AA334807 ON answer_answer_variant (answer_id)');
        $this->addSql('CREATE INDEX IDX_15F12FB954E42191 ON answer_answer_variant (answer_variant_id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_answer_variant ADD CONSTRAINT FK_15F12FB9AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer_answer_variant ADD CONSTRAINT FK_15F12FB954E42191 FOREIGN KEY (answer_variant_id) REFERENCES answer_variant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A25853CD175');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE answer_answer_variant DROP CONSTRAINT FK_15F12FB9AA334807');
        $this->addSql('ALTER TABLE answer_answer_variant DROP CONSTRAINT FK_15F12FB954E42191');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE answer_answer_variant');
    }
}
