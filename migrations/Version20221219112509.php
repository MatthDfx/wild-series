<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219112509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, comment LONGTEXT NOT NULL, rate INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_user (comment_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_ABA574A5F8697D13 (comment_id), INDEX IDX_ABA574A5A76ED395 (user_id), PRIMARY KEY(comment_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_episode (comment_id INT NOT NULL, episode_id INT NOT NULL, INDEX IDX_2ED97ECAF8697D13 (comment_id), INDEX IDX_2ED97ECA362B62A0 (episode_id), PRIMARY KEY(comment_id, episode_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_episode ADD CONSTRAINT FK_2ED97ECAF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_episode ADD CONSTRAINT FK_2ED97ECA362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5F8697D13');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5A76ED395');
        $this->addSql('ALTER TABLE comment_episode DROP FOREIGN KEY FK_2ED97ECAF8697D13');
        $this->addSql('ALTER TABLE comment_episode DROP FOREIGN KEY FK_2ED97ECA362B62A0');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE comment_user');
        $this->addSql('DROP TABLE comment_episode');
    }
}
