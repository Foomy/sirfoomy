<?php

/**
 * Table row class for the quote model. An instance of this
 * class represents a quote.
 *
 * @category    Foomy
 * @package     Foomy_Model
 * @version     5.0
 * @author      Sascha Schneider <foomy.code@arcor.de>
 *
 * +-----------+---------------------+------+-----+---------------------+----------------+
 * | Field     | Type                | Null | Key | Default             | Extra          |
 * +-----------+---------------------+------+-----+---------------------+----------------+
 * | id        | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created   | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified  | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | quotetext | text                | YES  |     | NULL                |                |
 * | author    | varchar(255)        | YES  |     | NULL                |                |
 * | extra     | varchar(255)        | YES  |     | NULL                |                |
 * +-----------+---------------------+------+-----+---------------------+----------------+
 */

class Foomy_Model_Quote extends Zend_Db_Table_Row_Abstract
{
    protected $_primary = Foomy_Model_Quote_Peer::F_ID;

    /**
     * Returns the database id of the quote.
     *
     * @return int
     */
    public function getId()
    {
        return $this->{Foomy_Model_Quote_Peer::F_ID};
    }// getId()

    /**
     * Returns the creation timestamp in the format "Y.m.d H:i:s".
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->{Foomy_Model_Quote_Peer::F_CREATED};
    }// getCreated()

    /**
     * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
     *
     * @return string
     */
    public function getModified()
    {
        return $this->{Foomy_Model_Qutoe_Peer::F_MODIFIED};
    }// getModified()

    /**
     * Returns the quotetext.
     *
     * @return string
     */
    public function getQuoteText()
    {
        return $this->{Foomy_Model_Quote_Peer::F_QUOTETEXT};
    }// getQuoteText()

    /**
     * Returns the quote authors name.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->{Foomy_Model_Quote_Peer::F_AUTHOR};
    }// getAuthor()

    /**
     * Returns additional information about the quote author.
     *
     * @return string
     */
    public function getExtra()
    {
        return $this->{Foomy_Model_Quote_Peer::F_EXTRA};
    }// getExtra()

    /**
     * Sets the new quotetext, committed in the parameter.
     *
     * @param string $quoteText
     * @return Foomy_Model_Quote
     */
    public function setQuoteText($quoteText)
    {
        $this->{Foomy_Model_Quote_Peer::F_QUOTETEXT} = $quoteText;
        return $this;
    }// setQuoteText()

    /**
     * Sets a new name for the author, committed in the parameter.
     *
     * @param string $author
     * @return Foomy_Model_Quote
     */
    public function setAuthor($author)
    {
        $this->{Foomy_Model_Quote_Peer::F_AUTHOR} = $author;
        return $this;
    }// setAuthor()

    /**
     * Sets new additiona inforamtion about the author.
     *
     * @param string $extra
     * @return Foomy_Model_Quote
     */
    public function setExtra($extra)
    {
        $this->{Foomy_Model_Quote_Peer::F_EXTRA} = $extra;
        return $this;
    }// setExtra()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
