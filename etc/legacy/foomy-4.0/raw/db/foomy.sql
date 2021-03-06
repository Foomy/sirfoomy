/** zitate
 */
CREATE TABLE quote (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  modified TIMESTAMP NOT NULL DEFAULT 0,
  deleted BOOLEAN DEFAULT FALSE,
  text TEXT,
  author VARCHAR(255),
  extra VARCHAR(255)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/** benutzer und gruppen
 *
 * Es gibt keine definitive Längenbegrenzung für
 * die E-Mail-Adresse. Da aber eine Überlänge der
 * Adresse zu technischen Problemen führen kann,
 * empfiehlt RFC 2821, dass der local-part maximal
 * 64 Zeichen haben soll. Die Domain soll maximal
 * 255 Zeichen lang sein. Daraus ergibt sich eine
 * Maximallänge von 320 Zeichen einschließlich des @.
 */
CREATE TABLE user (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  modified TIMESTAMP NOT NULL DEFAULT 0,
  deleted BOOLEAN DEFAULT FALSE,
  nickname VARCHAR(30),
  email VARCHAR(255) UNIQUE KEY,
  password VARCHAR(50)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE role (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  modified TIMESTAMP NOT NULL DEFAULT 0,
  name VARCHAR(25) NOT NULL,
  description VARCHAR(255)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE user2role {
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id INT UNSIGNED NOT NULL,
  role_id INT UNSIGNED NOT NULL
} ENGINE=MyISAM DEFAULT CHARSET=utf8;


/** blog
 */
CREATE TABLE blog (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  modified TIMESTAMP NOT NULL DEFAULT 0,
  title VARCHAR(30),
  subtitle VARCHAR(30)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE blogentry (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  modified TIMESTAMP NOT NULL DEFAULT 0,
  deleted BOOLEAN DEFAULT FALSE,
  message VARCHAR(4096),
  headline VARCHAR(50),
  subhead VARCHAR(50)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE blogtag (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  modified TIMESTAMP NOT NULL DEFAULT 0,
  tagname VARCHAR(50)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE blogtag2blogentry (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  blogentry_id INT UNSIGNED NOT NULL,
  blogtag_id INT UNSIGNED NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE link (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created TIMESTAMP NOT NULL DEFAULT NOW(),
  modified TIMESTAMP NOT NULL DEFAULT 0,
  href VARCHAR(255) NOT NULL,
  linktext VARCHAR(255) NOT NULL,
  description VARCHAR(255)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE link2blogentry (
  id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  link_id INT UNSIGNED NOT NULL,
  blogentry_id INT UNSIGNED  NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
