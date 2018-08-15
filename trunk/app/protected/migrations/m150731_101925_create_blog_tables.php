<?php

class m150731_101925_create_blog_tables extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {

//        $this->getDbConnection()->createCommand("
//            CREATE TABLE {{lookup}}
//            (
//                id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
//                name VARCHAR(128) NOT NULL,
//                code INTEGER NOT NULL,
//                type VARCHAR(128) NOT NULL,
//                position INTEGER NOT NULL
//            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
//        ")->execute();
//
//        $this->getDbConnection()->createCommand("
//            CREATE TABLE {{post}}
//            (
//                id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
//                title VARCHAR(128) NOT NULL,
//                content TEXT NOT NULL,
//                tags TEXT,
//                status INTEGER NOT NULL,
//                create_time INTEGER,
//                update_time INTEGER,
//                author_id INTEGER NOT NULL
//                /*,
//                    CONSTRAINT FK_post_author FOREIGN KEY (author_id)
//                    REFERENCES tbl_users (id) ON DELETE CASCADE ON UPDATE RESTRICT*/
//            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
//        ")->execute();

//        $this->createIndex('author_id', '{{post}}', 'author_id', false);

//        $this->getDbConnection()->createCommand("
//            CREATE TABLE {{comment}}
//            (
//                id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
//                content TEXT NOT NULL,
//                status INTEGER NOT NULL,
//                create_time INTEGER,
//                author VARCHAR(128) NOT NULL,
//                email VARCHAR(128) NOT NULL,
//                url VARCHAR(128),
//                post_id INTEGER NOT NULL,
//                CONSTRAINT FK_comment_post FOREIGN KEY (post_id)
//                    REFERENCES {{post}} (id) ON DELETE CASCADE ON UPDATE RESTRICT
//            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
//        ")->execute();

//        $this->getDbConnection()->createCommand("
//            CREATE TABLE {{tag}}
//            (
//                id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
//                name VARCHAR(128) NOT NULL,
//                frequency INTEGER DEFAULT 1
//            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
//        ")->execute();

        $this->getDbConnection()->createCommand("
            INSERT INTO lookup (name, type, code, position) VALUES ('Draft', 'PostStatus', 1, 1);
        ")->execute();
        $this->getDbConnection()->createCommand("
            INSERT INTO lookup (name, type, code, position) VALUES ('Published', 'PostStatus', 2, 2);
        ")->execute();
        $this->getDbConnection()->createCommand("
            INSERT INTO lookup (name, type, code, position) VALUES ('Archived', 'PostStatus', 3, 3);
        ")->execute();
        $this->getDbConnection()->createCommand("
            INSERT INTO lookup (name, type, code, position) VALUES ('Pending Approval', 'CommentStatus', 1, 1);
        ")->execute();
        $this->getDbConnection()->createCommand("
            INSERT INTO lookup (name, type, code, position) VALUES ('Approved', 'CommentStatus', 2, 2);
        ")->execute();
    }

    public function safeDown()
    {
        $this->dropTable('{{lookup}}');
        $this->dropTable('{{comment}}');
        $this->dropTable('{{post}}');
        $this->dropTable('{{tag}}');
    }
}